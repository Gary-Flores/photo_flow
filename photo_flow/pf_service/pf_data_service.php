<?php
/* 
 * This file contains all access to database MySql and all functions to info management.
 * Used for layer service.
 */
include 'pf_data_conn.php';
if(!isset($_SESSION)) {
    session_start();
}
$array_label = parse_ini_file("../pf_include/lang/labels".$_SESSION['pf_local_lang'].".ini");
/**
 * Generate User Menu Assigned by Profile.
 * @param type $id_profile
 * @return type
 */
function generateMenu ($id_profile, $id_user) {
    global $array_label;
    $query_result = getMenu($id_profile);
    $a_menu = array();
    $s_menu = array();
    if (mysql_num_rows($query_result) == 0) {
        array_push($a_menu, array("label" => $array_label['login_no_menu'], "id_group_phase" => 0));
        $a_temp = array("id_group_phase" => "0", "id_phase" => "0", "name" => $array_label['login_no_menu'], "total" => 0, "assigned" => 0);
        array_push($s_menu, $a_temp);
    } else {
        $temp = "";
        while($showtablerow = mysql_fetch_array($query_result)) {
            $phase_label = $showtablerow['label'];
            $a_temp = array(
                "id_group_phase" => $showtablerow['id_group_phase'],
                "id_phase" => $showtablerow['id_phase'],
                "name" => $showtablerow['name'],
                "total" => 0, "assigned" => 0);
            array_push($s_menu, $a_temp);
            if ($phase_label != $temp) {
                $temp = $phase_label;
                array_push($a_menu, array("label" => $showtablerow['label'], "id_group_phase" => $showtablerow['id_group_phase']));
            }
        }
        $s_menu = updateInstanceWork($s_menu, $id_user);
    }
    return array("a_menu" => $a_menu, "s_menu" =>$s_menu);
}
/**
 * Update Actual Instances.
 * @param type $menu
 * @param type $id_user
 * @return array
 */
function updateInstanceWork ($menu, $id_user) {
    $result = array();
    foreach ($menu as &$valor) {
        $valor['total'] =  getInstanceByIdPhase($valor['id_phase']);
        $valor['assigned'] =  getInstanceByIdPhaseAndUser($valor['id_phase'], $id_user);
        array_push($result, $valor);
    }
    return $result;
}
/**
 * Add New Instance Request.
 * @global type $pf_sel_c_instance_total
 * @param type $phase
 * @return type
 */
function addInstanceFlow($id_type, $first_name, $last_name, $e_mail, $phone, $e_date, $e_location, $e_reception, $n_guests) {
    global $array_label;
    $result = "-";
    $id_instance = getNewIdInstance($id_type);
    if(strlen($id_instance) > 5) {
        $step_one = getStepOneFlow($id_type);
        if (is_numeric($step_one) && $step_one > 0) {
            if(addNewInstance($id_instance, $id_type, $step_one)) {
                if (addCustomer($id_instance, $first_name, $last_name, $e_mail, $phone)
                    && addEvent($id_instance, $e_date, $e_location, $e_reception, $n_guests)) {
                    $result = $id_instance;
                } else {
                    $result .= $array_label['msg_error_insert_ins'];
                }
            } else {
                $result .= $array_label['msg_error_insert_ins'];
            }
        } else {
            $result .= $array_label['msg_error_undefined_f'];
        }
    }
    return $result;
}

function getDetailInbox($id_phase, $id_user) {
    $result = array();
    if ($id_user == null) {
        $query_result = getDetailInboxById($id_phase);
    } else {
        $query_result = getDetailInboxByIdUser($id_phase, $id_user);
    }
    return $query_result;
}
