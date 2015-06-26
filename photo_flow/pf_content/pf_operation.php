<?php
include '../pf_service/pf_function_comm.php';
include '../pf_service/pf_data_service.php';
//
?>
<html>
    <body onload="document.form_val_manual.submit()">
    <?php
    if(!isset($_SESSION)) {
        session_start();
    }
    $array_label = parse_ini_file("../pf_include/lang/labels".$_SESSION['pf_local_lang'].".ini");
    $message_om = "";
    switch ($_POST['type_operation']) {
        case "save_manual_operation":
            // VALUE - TYPE - NAME - LENGTH
            $values = array(
                array($_POST['om_type_event'], 'option', $array_label['lb_type_event'],8),
                array($_POST['om_name'], 'text', $array_label['lb_name'], 120),
                array($_POST['om_email'], 'email', $array_label['lb_email'], 60),
                array($_POST['om_phone'], 'phone', $array_label['lb_phone'], 25),
                array($_POST['om_e_date'], 'date', $array_label['lb_e_date'], 10),
                array($_POST['om_e_location'], 'text', $array_label['lb_e_location'], 250),
                array($_POST['om_e_reception'], 'text', $array_label['lb_e_reception'], 250),
                array($_POST['om_n_guests'], 'number', $array_label['lb_n_guests'], 4));
            $l_error = validateParamsForm($values);
            if (count($l_error) > 0) {
                $message_om = $array_label['msg_error_man_ope'].": <ul class=\"alert_messge_list\">";
                for ($x = 0; $x < count($l_error); $x++) {
                    $message_om = $message_om ."<li>".$l_error[$x]."</li>";
                }
                $message_om = $message_om."</ul>";
            } else {
                $message_om = addInstanceFlow($values[0][0], $values[1][0], '',
                    $values[2][0], $values[3][0], $values[4][0], $values[5][0],
                    $values[6][0], $values[7][0]);
                if (substr($message_om, 0, 1) == "-") {
                    $message_om = $array_label['msg_error_man_ope'].": <ul class=\"alert_messge_list\"><li>"
                        .substr($message_om, 1)."</li></ul>";
                } else {
                    $message_om = $array_label['msg_save_man_ope'].'<p>ID: '.$message_om.'</p>';
                }
            }
            echo "<form action='pf_start_page.php' name='form_val_manual' method='post'>";
            echo "<input type='hidden' name='type_operation' value='val_manual_operation'>";
            echo "<input type='hidden' name='om_type_event' value='".$values[0][0]."'>";
            echo "<input type='hidden' name='om_name' value='".$values[1][0]."'>";
            echo "<input type='hidden' name='om_email' value='".$values[2][0]."'>";
            echo "<input type='hidden' name='om_phone' value='".$values[3][0]."'>";
            echo "<input type='hidden' name='om_e_date' value='".$values[4][0]."'>";
            echo "<input type='hidden' name='om_e_location' value='".$values[5][0]."'>";
            echo "<input type='hidden' name='om_e_reception' value='".$values[6][0]."'>";
            echo "<input type='hidden' name='om_n_guests' value='".$values[7][0]."'>";
            echo "<input type='hidden' name='msg_operation' value='".$message_om."'>";
            echo "</form>";
        break;
    }  
    ?>
    </body>
</html>
