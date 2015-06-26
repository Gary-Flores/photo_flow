<?php
include '../pf_service/pf_session_val.php';
include '../pf_service/pf_data_service.php';
$array_label = parse_ini_file("../pf_include/lang/labels".$_SESSION['pf_local_lang'].".ini");
$a_menu = array();
$s_menu = array();
if (!isset($_SESSION['pf_a_menu']) || $_SESSION['pf_a_menu'] == null) {
    $menu = generateMenu ($_SESSION['pf_id_profile'], $_SESSION['pf_id_user']);
    $_SESSION['pf_a_menu'] = $a_menu = $menu['a_menu'];
    $_SESSION['pf_s_menu'] = $s_menu = $menu['s_menu'];
} else {
    $a_menu = $_SESSION['pf_a_menu'];
    $s_menu = updateInstanceWork ($_SESSION['pf_s_menu'], $_SESSION['pf_id_user']);
}
