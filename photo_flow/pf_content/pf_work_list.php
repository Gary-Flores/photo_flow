<?php
include '../pf_include/pf_main_head.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                <table class="pf_gridtable">
                    <thead><tr><th colspan="7">
                        <?php echo $array_label['inbox_title']; ?>
                    </th></tr></thead>
                <?php
                $user = null;
                if ($_GET['type'] == 1) {
                    $user = $_SESSION["pf_id_user"];
                }
                $result = getDetailInbox($_GET['id_phase'], $user);
                while($showtablerow = mysql_fetch_array($result)) {
                    echo
                      "<tr onmouseover=\"this.style.backgroundColor='#dedede';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" >"
                    . "<td>".$showtablerow['id_instance']."</td><td>".$showtablerow['e_date']."</td>"
                    . "<td>".$showtablerow['e_location']."</td><td>".$showtablerow['c_name']."</td><td>".$showtablerow['e_mail']."</td>"
                    . "<td>".$showtablerow['phone']."</td><td><a href='pf_send_mail.php'><img src='http://www.smart-list.com/images/mega-ad/mail_imag.png' width=30 heigth=30></img></a></td><tr>\n";
                }
                ?>
                    <tfoot>
                        <tr><td colspan='7' align='center'>
                            <input type="button" value="<?php echo $array_label['button_back']; ?>"
                                class="pf_button" onclick="redirect('dwt_<?php echo $_GET['id_group_phase']; ?>');">
                        </td></tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <form action="pf_start_page.php" name="form_red_start" method="post">
            <input type="hidden" id="type_operation" name="type_operation" value="">
        </form>
    </body>
</html>
