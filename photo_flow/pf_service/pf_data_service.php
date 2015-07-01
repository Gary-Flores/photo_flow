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

function getInfoForMail($id_flow, $id_phase, $id_instance) {
    $result = array();
    $res_mail = getMailInfo($id_flow, $id_phase);
    while($row = mysql_fetch_array($res_mail)) {
        array_push($result, array('id_flow'=>$row['id_flow'], 'id_phase'=>$row['id_phase'],
            'm_from'=>$row['m_from'], 'm_subject'=>$row['m_subject'], 'message'=>$row['message'],
            'format'=>$row['format'], 'attachment'=>$row['attachment']));
    }
    $res_inst = getInstanceById($id_instance);
    while($row = mysql_fetch_array($res_inst)) {
        array_push($result, array('id_instance'=>$row['id_instance'], 'name'=>$row['name'],
            'e_mail'=>$row['e_mail'], 'phone'=>$row['phone'], 'status'=>$row['status'],
            'e_date'=>$row['e_date'], 'e_location'=>$row['e_location'],
            'e_reception'=>$row['e_reception'], 'n_guests'=>$row['n_guests']));
    }
    return $result;
}

/*function sendMail($message_from,$message_to,$message_subject,$message_message) {
$msg_enviado="No se pudo enviar";
$mensaje='<div style="background-color:#226;padding:10px;">
<h1 style="background-color:#910;color:#fff;">mensaje de prueba para '.$message_to.'</h1>
<img src="http://www.mancera.org/wp-content/uploads/2011/03/php_y_mysql-500x270.png" width="288" height="100">
<h2 style="color:#fff;">'.$message_subject.'</h2>
<h2 style="color:#fff;">'.$message_message.'</h2></div>';
$cabeceras="MIME-Version:1.0\r\n";
$cabeceras.="Content-type:text/html; charset=utf-8\r\n";
$cabeceras.="From:Company<".$message_from."\r\n>";
if(mail($message_to,"Email en formato html",$mensaje,$cabeceras)){
$msg_enviado= "Mensaje enviado satisfactoriamente";}
else{
$msg_enviado= "Mensaje no enviado satisfactoriamente";

}

    return "".$msg_enviado;
}*/
function tal(){

    header('Content-type: application/pdf');
    readfile('luz.pdf');
}
function form_mail($sPara, $sAsunto, $sTexto, $sDe)
{
$bHayFicheros = 0;
$sCabeceraTexto = "";
$sAdjuntos = "";
if ($sDe)$sCabeceras = "From:".$sDe."\n";
else $sCabeceras = "";
$sCabeceras .= "MIME-version: 1.0\n";
foreach ($_POST as $sNombre => $sValor)
$sTexto = $sTexto."<br/>".$sValor;
foreach ($_FILES as $vAdjunto)
{
if ($bHayFicheros == 0)
{
$bHayFicheros = 1;
$sCabeceras .= "Content-type: multipart/mixed;";
$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";
$sCabeceraTexto = "----_Separador-de-mensajes_--\n";
$sCabeceraTexto .= "Content-type: text/html;charset=utf-8\n";
$sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";
$sTexto = $sCabeceraTexto.$sTexto;
}
if ($vAdjunto["size"] > 0 & $vAdjunto["size"] <5000000)
{
$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
$sAdjuntos .= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n";;
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";
$oFichero = fopen($vAdjunto["tmp_name"], 'r');
$sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"]));
$sAdjuntos .= chunk_split(base64_encode($sContenido));
fclose($oFichero);
}else{
    return 0;
}
}
if ($bHayFicheros)
$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";
$bHayFicheros = 0;

return(mail($sPara, $sAsunto, $sTexto, $sCabeceras));
}