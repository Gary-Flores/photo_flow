<?php
include '../pf_include/pf_main_head.php';
$show_div_load = "dwt_home";
if (isset($_POST['type_operation']) && $_POST['type_operation'] == "val_manual_operation") {
    $show_div_load = "dwt_manual";
} elseif (isset($_POST['type_operation']) && $_POST['type_operation'] != '') {
   $show_div_load = $_POST['type_operation']; 
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="../pf_include/css/pf_basic.js"></script>
        <script type="text/javascript">
        <?php
        $dwt = "";
        foreach ($a_menu as &$valor) {
            $dwt = $dwt."'dwt_".$valor['id_group_phase']."',";
        }
        echo "var divs = [".$dwt."'dwt_home', 'dwt_manual', 'dwt_about'];";
        ?>
        function showDiv(param) {
            hideDivWorkTray();
            document.getElementById(param).style.display = 'block';
        }
        function hideDivWorkTray() {
            for(var i = 0; i < divs.length; i++) {
                document.getElementById(divs[i]).style.display = 'none';
            }
        }
        </script>
        <style type="text/css">
            @import "../pf_include/css/pf_basic.css";
        </style> 
        <title><?php echo $array_label['start_pg_title']; ?></title>
    </head>
    <body onload="showDiv('<?php echo $show_div_load; ?>');">
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
                <div class="pf_div_menu" onclick="showDiv('dwt_home');">
                    <?php echo $array_label['menu_home']; ?>
                </div>
                <?php
                foreach ($a_menu as &$valor) {
                    echo "<div class='pf_div_menu' onclick=\"showDiv('dwt_".$valor['id_group_phase']."');\">".$valor['label']."</div>";
                }
                ?>
                <div class="pf_div_menu" onclick="showDiv('dwt_about');">
                    <?php echo $array_label['menu_about']; ?>
                </div>
            </div>
            <div class="pf_column">
                <div id="dwt_home"><table class="pf_message">
                    <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
                    <tr><td align="center"><?php echo $array_label['start_home_msg']; ?></td></tr>
                    <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
                    <tr><td><a onclick="showDiv('dwt_manual');" class="pf_link">&nbsp;<?php echo $array_label['start_ope_manual']; ?></a></td></tr>
                    <tr><td>&nbsp;</td>
                </table></div>
            <?php
            $temp = -1;
            foreach ($s_menu as &$valor) {
                // Define If Number of Instance > 0 To Create Link
                $l_assigned = $valor['assigned'];
                if ($valor['assigned'] > 0) {
                    $l_assigned = "<a href='pf_work_list.php?id_phase=".$valor['id_phase']."&type=1&id_group_phase=".$valor['id_group_phase']."'>".$valor['assigned']."</a>";
                    //$l_assigned = "<a href='pf_send_mail.php?id_phase=".$valor['id_phase']."&type=1&id_group_phase=".$valor['id_group_phase']."'>".$valor['assigned']."</a>";
                }
                $l_total = $valor['total'];
                if ($valor['total'] > 0) {
                    $l_total = "<a href='pf_work_list.php?id_phase=".$valor['id_phase']."&type=0&id_group_phase=".$valor['id_group_phase']."'>".$valor['total']."</a>";
                    //$l_total = "<a href='pf_send_mail.php?id_phase=".$valor['id_phase']."&type=0&id_group_phase=".$valor['id_group_phase']."'>".$valor['total']."</a>";
                }
                // Create Table to Display Work Tray
                if ($temp != $valor['id_group_phase']) {
                    if ($temp != -1) {
                        echo "</table></div>";
                    }
                    echo "\n<div id='dwt_".$valor['id_group_phase']."'><table class='pf_work_tray'>";
                    echo "<thead><tr><td colspan='3' align='center'>".$array_label['inbox_title']."</td></tr>";
                    echo "<tr><td align='center' width='60%'>".$array_label['inbox_phase']."</td><td align='center' width='20%'>"
                        .$array_label['inbox_assigned']."</td><td align='center' width='20%'>".$array_label['inbox_total']."</td></tr></thead>";
                    echo "<tr><td align='left'>".$valor['name']."</td><td>".$l_assigned."</td><td>".$l_total."</td></tr>";
                    $temp = $valor['id_group_phase'];
                } else {
                    echo "<tr><td align='left'>".$valor['name']."</td><td>".$l_assigned."</td><td>".$l_total."</td></tr>";
                }
            }
            if ($temp != -1) {
                echo "</table></div>";
            }
            include 'pf_op_manual.php';
            ?>
                <div id="dwt_about"><table class="pf_message">
                    <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
                    <tr><td align="center"><?php echo $array_label['about_msg']; ?></td></tr>
                    <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
                </table></div>
            </div>
        </div>
        <form action="pf_work_list.php" name="form_list_work" method="post">
            <input type="hidden" name="id_phase">
            <input type="hidden" name="id_group_phase">
            <input type="hidden" name="type_operation">
        </form>
    </body>
</html>
