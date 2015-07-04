<?php
include '../pf_include/pf_main_head.php';
$consult = array();
if (isset($_SESSION['pf_email_info'])) {
    if (isset($_POST['type_operation']) && $_POST['type_operation'] == "send_email") {
        $consult[0] = array('m_from' => $_POST['sm_email_from'],'m_subject' => $_POST['sm_subject'],
            'message' => $_POST['sm_message'], 'sm_file' => $_POST['sm_file'], 'attachment' => $_POST['sm_attachment']);
        $consult[1] = array('e_mail' => $_POST['sm_email_to']);
    } else {
        $consult = $_SESSION['pf_email_info'];
    }
} else {
    $id_flow = $_GET['id_flow'];
    $id_phase = $_GET['id_phase'];
    $id_instance = $_GET['id_instance'];
    $consult = getInfoForMail($id_flow, $id_phase, $id_instance);
    $_SESSION['pf_email_info'] = $consult;
}
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
        
function abrir(param) {
    param = "recibe1.php?pf_file=" + param;
    open(param,'','top=500,left=500,width=800,height=500') ;
//getURL("luz.pdf","_blank");
}
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
                <form method="post" name="form_send_email" action="pf_operation.php" target='_self' enctype="multipart/form-data" >
                    <table class="pf_work_tray">
                        <head>
                            <tr>
                                <td colspan="2"><center>Escriba el texto a guardar</center></td>
                            </tr>
                        </head>
                        <tbody>
                            <tr>
                                <td colspan='2'>
                           <TEXTAREA ROWS='10' COLS='70' NAME='sm_send_text'></TEXTAREA>

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
                                    <input type="button" value='Guardar texto'
                                        class="pf_button" name='btn_send' onclick="document.form_send_email.submit();">
                                </td>
                                    <input type="hidden" name="type_operation" value="send_text">

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
