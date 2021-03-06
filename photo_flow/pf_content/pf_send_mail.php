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
                                <td>
                                    <?php echo $array_label['lb_attachments']; ?>
                                </td>
                                <td>
                                <form action='recibe1.php' method="GET">
                                    <?php 
                                    $att=explode(";", $l_mail['attachment']);
                                    for ($i=0; $i <sizeof($att) ; $i++) { 
                                    $ext=explode(".",$att[$i]);
                                    $pf_file_show;
                                    $pf_file_type;
                                    if($ext[1]=='jpg' || $ext[1]=='jpeg' || $ext[1]=='jpe'|| $ext[1]=='gif'|| $ext[1]=='png'|| $ext[1]=='bmp'|| $ext[1]=='ico'|| $ext[1]=='svg'|| $ext[1]=='svgz'|| $ext[1]=='tiff'|| $ext[1]=='ai'|| $ext[1]=='drw'|| $ext[1]=='pct'|| $ext[1]=='psp'|| $ext[1]=='xcf' || $ext[1]=='psd' || $ext[1]=='raw'){
                                        $pf_file_show='image.png';
                                        $pf_file_type='image/'.$ext[1]."&img=1";
                                    }else{
                                    switch ($ext[1]) {
                                        case 'pdf':
                                            $pf_file_show='pdf.png';
                                            $pf_file_type='application/pdf';
                                            break;
                                        case 'zip':
                                            $pf_file_show='zip.jpg';
                                           $pf_file_type='application/zip';
                                            break;
                                        case 'rar':
                                        $pf_file_show='rar.jpg';
                                        $pf_file_type='application/octet-stream';
                                        break;
                                        case 'ppt':
                                            $pf_file_show='ppt.png';
                                            $pf_file_type='application/vnd.ms-powerpoint';
                                            break;
                                        case 'pptx':
                                            $pf_file_type='application/vnd.openxmlformats-officedocument.presentationml.presentation';
                                            $pf_file_show='pptx.png';
                                            break;
                                        case 'doc':
                                        $pf_file_show='doc.jpg';
                                        $pf_file_type='application/msword';
                                        break;
                                        case 'docx':
                                        $pf_file_type='application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                                            $pf_file_show='docx.jpg';
                                            break;
                                        case 'docm':
                                        $pf_file_type='application/vnd.ms-word.document.macroenabled.12';
                                            $pf_file_show='docm.png';
                                            break;
                                        case 'xls':
                                        $pf_file_type='application/vnd.ms-excel';
                                        $pf_file_show='xls.jpg';
                                        break;
                                        case 'xlsx':
                                        $pf_file_type='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                                            $pf_file_show='xlsx.jpg';
                                            break;
                                        case 'xlsm':
                                        $pf_file_type='application/vnd.ms-excel.sheet.macroenabled.12';
                                            $pf_file_show='xlsm.png';
                                            break;
                                        case 'txt':
                                        $pf_file_type='text/plain';
                                        $pf_file_show='txt.jpg';
                                        break;
                                        case 'csv':
                                        $pf_file_type='application/vnd.ms-excel';
                                            $pf_file_show='csv.png';
                                            break;
                                        case 'html':
                                        $pf_file_type='text/html';
                                            $pf_file_show='html.jpg';
                                            break;
                                        default:
                                        $pf_file_type='';
                                            $pf_file_show='file.png';
                                            break;
                                    }
                                        }
                                        echo "<div style=\"padding:1.2em; display:inline;\"><img src=\"../pf_include/img/".$pf_file_show."\" width=30px heigth=30px style=\"margin-bottom:-1em;\";/><a href=\"#\" onclick=\"abrir('".trim($att[$i])."&pf_type=".$pf_file_type."');\">$ext[0]</a></div>&nbsp;&nbsp;";
                                    
                                    }
                                         

                                        
                                       
                                    ?>
                                    </form>
                                    <input type="hidden" name="sm_attachment" value="<?php echo $l_mail['attachment']; ?>">
                                    <p>
                                        <?php
                                           // echo "F".$l_mail['sm_file'];
                                            //if (isset($l_mail['sm_file']) && $l_mail['sm_file'] != "") {
                                               
                                     //           echo "<input type='file' accept='.csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/plain,image/*,text/html,.pdf' value=".$l_mail['sm_file'].">";
                                            //} else {
                                    echo "<br/>";

                                                echo "<intput type='hidden' name='MAX_FILE_SIZE' value='5000000'>";
                                                echo "<input type='file' accept='.csv,application/vnd.ms-excel,
                                                application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                                                text/plain,image/*,text/html,.pdf,application/zip,application/msword,
                                                .ppt,.pptx,.xls,.xlsx,doc,.docx,.zip,.rar,.docm,.xls,.xlsm' name='sm_file'>";
                                            //}
                                        ?>
                                       
                                    </p>
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
