<?php
/* 
 * Validate session.
 */
session_start();
if ($_SESSION['pf_valid_user'] == '') {
    header("Location: /photo_flow/index.php");
}
