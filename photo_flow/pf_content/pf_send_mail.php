<?php
include '../pf_include/pf_main_head.php';
$consult = array();
if (isset($_SESSION['pf_email_info'])) {
    $consult = $_SESSION['pf_email_info'];
} else {
    $id_flow = $_GET['id_flow'];
    $id_phase = $_GET['id_phase'];
    $id_instance = $_GET['id_instance'];
    $consult = getInfoForMail($id_flow, $id_phase, $id_instance);
    $_SESSION['pf_email_info'] = $consult;
}
$l_mail = $consult[0];
$l_instance = $consult[1];
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-.equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="../pf_include/css/pf_basic.js"></script>
        <style type="text/css">
            @import "../pf_include/css/pf_basic.css";
        </style>
        <script type="text/javascript">
        function redirect(param) {
            document.getElementById('type_operation').value = param;
            document.form_red_start.submit();
        }            
        </script>
        <title><?php echo $array_label['start_pg_title']; ?></title>
    </head>
    <body onload="showDiv('<?php echo isset($show_div_load)?$show_div_load:''; ?>');">
        <div id="templateInfo">
            <div>
                <ul class="navigation">
                    <li class="option"><a href="#"><?php echo $_SESSION["pf_name_user"]; ?></a></li>
                    <li class="option"><a href="#"><?php echo $array_label['nav_search']; ?></a></li>
                    <li class="option"><a href="#"><?php echo $array_label['nav_language']; ?></a></li>
                    <li class="option"><a href="pf_logout.php"><?php echo $array_label['nav_logout']; ?></a></li>
                </ul>
            </div>
    </div>
        <div id="clearance">&nbsp;</div>
        <div>
            <hr class="hr" align="center" width="96%">
        </div>
        <div id="contenedor-mains">
            <div class="pf_column">
                <div class="pf_div_menu" onclick="redirect('dwt_home');">
                    <?php echo $array_label['menu_home']; ?>
                </div>
                <?php
                foreach ($a_menu as &$valor) {
                    echo "<div class='pf_div_menu' onclick=\"redirect('dwt_".$valor['id_group_phase']."');\">".$valor['label']."</div>";
                }
                ?>
                <div class="pf_div_menu" onclick="redirect('dwt_about');">
                    <?php echo $array_label['menu_about']; ?>
                </div>
            </div>
            <div class="pf_column">
                <form method="post" name="form_send_email" action="pf_operation.php" target='_self' enctype="multipart/form-data">
                    <table class="pf_work_tray">
                        <head>
                            <tr>
                                <td colspan="2"><?php echo $array_label['tit_email_form']; ?></td>
                            </tr>
                        </head>
                        <tbody>
                            <tr>
                                <td><?php echo $array_label['lb_from']; ?></td>
                                <td>
                                    <input type="email" name="sm_email_from" size="50" value="<?php echo $l_mail['m_from']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $array_label['lb_email']; ?></td>
                                <td>
                                    <input type="email" name="sm_email_to" size="50" value="<?php echo $l_instance['e_mail']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $array_label['lb_subject']; ?></td>
                                <td>
                                    <input type="text" name="sm_subject" size="50" value="<?php echo $l_mail['m_subject']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $array_label['lb_message']; ?></td>
                                <td>
                                    <textarea cols="50" rows="10" name="sm_message"><?php echo $l_mail['message']; ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $array_label['lb_attachments']; ?></td>
                                <td>

                                    <?php echo $l_mail['attachment']; ?>
                                    <p>Adjuntar archivo: <input type='file' name='archivo1' id='archivo1'></p><p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <div id="sm_message">
                                        <?php
                                        if (isset($_POST['msg_operation'])) {
                                            echo "<p class='alert_messge'>".$_POST['msg_operation']."</p>";
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" name="type_operation" value="send_email">

                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="button" value="<?php echo $array_label['button_send']; ?>"
                                        class="pf_button" name='btn_send' onclick="document.form_send_email.submit();">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
        <form action="pf_start_page.php" name="form_red_start" method="post">
            <input type="hidden" id="type_operation" name="type_operation" value="">
        </form>
    </body>
</html>
