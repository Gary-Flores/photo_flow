<?php
include '../pf_service/pf_session_val.php';
include '../pf_service/pf_data_conn.php';
$array_label = parse_ini_file("../pf_include/lang/labels".$GLOBALS['pf_local_lang'].".ini");
?>
<html>
    <head>
        <title><?php echo $array_label['phases_tittle']; ?></title>
        <style type="text/css">
            @import "../pf_include/css/pf_basic.css";
        </style>
    </head>
    <body>
        <table class="pf_gridtable">
            <thead><tr><th colspan="2">
                <?php echo $array_label['phases_list']; ?>
            </th></tr></thead>
        <?php
            $query_result = getListPhases($_GET['id_phase'], null);
            while($showtablerow = mysql_fetch_array($query_result)) {
                echo "<tr onmouseover=\"this.style.backgroundColor='#dedede';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" >"
                . "<td>".$showtablerow[1]."</td><td>".$showtablerow[2]."</td><tr>\n";
            }
        ?>
        </table>
    </body>
</html>
