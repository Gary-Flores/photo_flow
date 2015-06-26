<?php
if(!isset($_SESSION)) {
	session_start();
}
if ($_SESSION['pf_valid_user'] == '') {
    $l_redirect = 'login.php';
} else {
    $l_redirect = 'pf_content/pf_start_page.php';
}
?>
<html>
    <body onload="document.createElement('form').submit.call(document.getElementById('form_redirect'))">
        <form action="<?php echo $l_redirect; ?>" id="form_redirect" method="post">
        </form>
    </body>
</html>
