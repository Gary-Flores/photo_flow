<?php
include 'pf_service/pf_data_conn.php';
if (isset($_SESSION['pf_local_lang'])) {
    $array_label = parse_ini_file("pf_include/lang/labels".$_SESSION['pf_local_lang'].".ini");
} else {
    $array_label = parse_ini_file("pf_include/lang/labels.ini");
}

$l_load = '';
$id_operation = '';
if (isset($_POST['id_operation'])) {
    $id_operation = $_POST['id_operation'];
}
if ($id_operation == 'login') {
    $l_load = "document.createElement('form').submit.call(document.getElementById('form_redirect'))";
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $array_label['login_title']; ?></title>
    <style type="text/css">
        @import "pf_include/css/pf_basic.css";
    </style>
</head>
<body onload="<?php echo $l_load; ?>">
    <?php
    if ($id_operation == '' || $_POST['id_operation'] == 'redirect') {
    ?>
    <div class="pf_logindiv">
        <div align="center">
            <form action="login.php" method="post">
                <table class="pf_logintable">
                    <tr>
                        <td colspan="2" align="center">
                            <img src="pf_include/img/logo_pf.gif" alt="Powered by Luz Pura">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo $array_label['login_user']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input name="user" type="text" size="25">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo $array_label['login_pass']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input name="pass" type="password" size="25">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="alert_messge">
                            <?php
                                if (isset($_POST['message'])) {
                                    echo $_POST['message'];
                                }
                            ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="remember"><?php echo $array_label['login_remember']; ?>
                        </td>
                        <td>
                            <input type="submit" value="<?php echo $array_label['login_log_in']; ?>" class="pf_button">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id_operation" value="login">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
    } elseif ($id_operation == 'login') {
   /** 
    * Validate User Access
    * 
    *  - User not exist
    *  - Password don't match
    *  - User is Inactivate
    *  - User & Password are correct!
    */
    $p_user = $_POST['user'];
    $p_pass = $_POST['pass'];
    $p_remember = isset($_POST['remember'])?$_POST['remember']:'';
    $l_message = '';
    $l_redirect = 'login.php';
    $query_result = validateUserAccess($p_user);
    if (mysql_num_rows($query_result) == 0) {
        // User doesn't exist
        $l_message = $array_label['login_msg_invalid'];
    } else {
        $showtablerow = mysql_fetch_array($query_result);
        if ($showtablerow['password'] != $p_pass) {
            // Password don't match
            $l_message = $array_label['login_msg_invalid'];
        } elseif ($showtablerow['status'] == 0) {
            // User is inactive
            $l_message = $array_label['login_msg_inactivate'];
        } else {
            session_start();
            $_SESSION['pf_valid_user'] = $showtablerow['access'];
            $_SESSION["pf_id_user"] = $showtablerow['id_user'];
            $_SESSION["pf_id_profile"] = $showtablerow['id_profile'];
            $_SESSION["pf_local_lang"] = $showtablerow['default_lang'];
            $_SESSION["pf_name_user"] = $showtablerow['name'];
            $l_redirect = 'pf_content/pf_start_page.php';
            /*
            if($p_remember) {
                $year = time() + 31536000;
                setcookie('remember_me', $p_user, $year);
            } elseif(!$p_remember) {
                if(isset($_COOKIE['remember_me'])) {
                    $past = time() - 100;
                    setcookie(remember_me, gone, $past);
                }
            }
            */
        }
    }
    ?>
    <form action="<?php echo $l_redirect; ?>" id="form_redirect" method="post">
        <input type="hidden" name="id_operation" value="redirect">
        <input type="hidden" name="message" value="<?php echo $l_message; ?>">
    </form>
    <?php
    }
    ?>
</body>
