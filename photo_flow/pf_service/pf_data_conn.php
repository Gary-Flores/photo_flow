<?php
/* 
 * This file contains all access to database MySql and all functions to info management.
 */
include 'pf_connection.php';
include 'pf_data_query.php';

/**
 * User query the database.
 * @global type $pf_sel_user_access SQL Query
 * @param type $user name
 * @return type array user info
 */
function validateUserAccess($user) {
    global $pf_sel_user_access;
    $l_query = sprintf($pf_sel_user_access, mysql_real_escape_string($user));
    $query_result = mysql_query($l_query);
    return $query_result;
}

/**
 * Generate user menu.
 * @global type $pf_sel_menu_profile SQL Query
 * @param type $profile id
 * @return type array content menu info
 */
function getMenu($profile) {
    global $pf_sel_menu_profile;
    $l_query = sprintf($pf_sel_menu_profile, mysql_real_escape_string($profile));
    $query_result = mysql_query($l_query);
    return $query_result;
}

/**
 * Get Total Instance by Phase.
 * @global type $pf_sel_c_instance_total SQL Query
 * @param type $phase id
 * @return type int total
 */
function getInstanceByIdPhase($phase) {
    global $pf_sel_c_instance_total;
    $l_query = sprintf($pf_sel_c_instance_total, mysql_real_escape_string($phase));
    $query_result = mysql_query($l_query);
    $showtablerow = mysql_fetch_array($query_result);
    return $showtablerow['total'];
}

/**
 * Get Total Instance by Phase.
 * @global type $pf_sel_c_instance_user SQL Query
 * @param type $phase id
 * @param type $user id
 * @return type int total
 */
function getInstanceByIdPhaseAndUser($phase, $user) {
    global $pf_sel_c_instance_user;
    $l_query = sprintf($pf_sel_c_instance_user, mysql_real_escape_string($phase),
        mysql_real_escape_string($user));
    $query_result = mysql_query($l_query);
    $showtablerow = mysql_fetch_array($query_result);
    return $showtablerow['total'];
}

/**
 * Get First Step for Flow
 * @global type $pf_ins_instance
 * @param type $id_flow
 * @return type
 */
function getStepOneFlow($id_flow) {
    global $pf_sel_1step_flow;
    $l_query = sprintf($pf_sel_1step_flow, mysql_real_escape_string($id_flow));
    $query_result = mysql_query($l_query);
    $showtablerow = mysql_fetch_array($query_result);
    return $showtablerow[0];
}

/**
 * Generate New Id For Instance
 * @global type $pf_sel_id_instance
 * @param type $id
 * @return type new instance
 */
function getNewIdInstance($id) {
    global $pf_sel_id_instance;
    $l_query = str_replace('[ID_FLOW]', $id, $pf_sel_id_instance);
    $query_result = mysql_query($l_query);
    $showtablerow = mysql_fetch_array($query_result);
    return $showtablerow['id_ins'];
}

/**
 * Insert New Instance
 * @global type $pf_ins_instance
 * @param type $id_instance
 * @param type $id_flow
 * @param type $step
 * @return type result query
 */
function addNewInstance($id_instance, $id_flow, $step) {
    global $pf_ins_instance;
    $l_query = sprintf($pf_ins_instance, mysql_real_escape_string($id_instance),
        mysql_real_escape_string($id_flow), mysql_real_escape_string($step));
    $query_result = mysql_query($l_query);
    return $query_result;
}

/**
 * Add New Customer.
 * @global type $pf_ins_customer
 * @param type $id_instance
 * @param type $first_name
 * @param type $last_name
 * @param type $e_mail
 * @param type $phone
 * @return type result query
 */
function addCustomer($id_instance, $first_name, $last_name, $e_mail, $phone) {
    global $pf_ins_customer;
    $l_query = sprintf($pf_ins_customer, mysql_real_escape_string($id_instance),
        mysql_real_escape_string($first_name), mysql_real_escape_string($last_name),
        mysql_real_escape_string($e_mail), mysql_real_escape_string($phone));
    $query_result = mysql_query($l_query);
    return $query_result;
}

/**
 * Add New Event.
 * @global type $pf_ins_event
 * @param type $id_instance
 * @param type $e_date
 * @param type $e_location
 * @param type $e_reception
 * @param type $n_guests
 * @return type result query
 */
function addEvent($id_instance, $e_date, $e_location, $e_reception, $n_guests) {
    global $pf_ins_event;
    $l_query = sprintf($pf_ins_event, mysql_real_escape_string($id_instance),
        mysql_real_escape_string($e_date), mysql_real_escape_string($e_location),
        mysql_real_escape_string($e_reception), mysql_real_escape_string($n_guests));
    $l_query = str_replace('[FMT_DATE_HOUR]', '%Y-%m-%d %H:%i', $l_query);
    $query_result = mysql_query($l_query);
    return $query_result;
}

function getDetailInboxById($id_phase) {
    global $pf_sel_phases_id;
    $l_query = sprintf($pf_sel_phases_id, mysql_real_escape_string($id_phase));
    $l_query = str_replace('[FMT_DATE_EVENT]', '%b, %d %Y', $l_query);
    $query_result = mysql_query($l_query);
    return $query_result;
}

function getDetailInboxByIdUser($id_phase, $id_user) {
    global $pf_sel_phases_id_user;
    $l_query = sprintf($pf_sel_phases_id_user, mysql_real_escape_string($id_phase),
        mysql_real_escape_string($id_user));
    $l_query = str_replace('[FMT_DATE_EVENT]', '%b, %d %Y', $l_query);
    $query_result = mysql_query($l_query);
    return $query_result;
}

function getMailInfo($id_flow, $id_phase) {
    global $pf_sel_mail_phase;
    $l_query = sprintf($pf_sel_mail_phase,
        mysql_real_escape_string($id_flow),
        mysql_real_escape_string($id_phase));
    $query_result = mysql_query($l_query);
    return $query_result;
}

function getInstanceById($id_instance) {
    global $pf_sel_ins_info;
    $l_query = sprintf($pf_sel_ins_info, mysql_real_escape_string($id_instance));
    $query_result = mysql_query($l_query);
    return $query_result;
}

/**
 * Catalog function - Return list of flows
 * @global type $pf_sel_list_flow
 * @return array
 */
function getListFlow() {
    global $pf_sel_list_flow;
    $query_result = mysql_query($pf_sel_list_flow);
    $result = array();
    while($showtablerow = mysql_fetch_array($query_result)) {
        array_push($result, array($showtablerow[0], $showtablerow[1]));
    }
    return $result;
}

/**
 * Get Phases List.
 * @global type $pf_sel_list_phases SQL Query
 * @return type phases list
 */
function getPhasesList() {
    global $pf_sel_list_phases;
    $query_result = mysql_query($pf_sel_list_phases);
    return $query_result;
}
