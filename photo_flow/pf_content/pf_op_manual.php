<div id="dwt_manual">
    <form action="pf_operation.php" id="form_op_manual" name="form_op_manual" method="post">
        <table class="pf_work_tray">  
            <thead><tr><td align="center" colspan="2"><?php echo $array_label['start_ope_manual']; ?></td></tr></thead>
            <tbody>
                <tr>
                    <td align='left' width='30%'><?php echo $array_label['lb_type_event']; ?>:</td>
                    <td align='left' width='70%'>
                        <select name="om_type_event">
                            <option value="0">-- <?php echo $array_label['select_option']; ?> --</option>
                         <?php
                        $list_e = getListFlow();
                        $default_sel = 0;
                        if (isset($_POST['om_type_event'])) {
                            $default_sel = $_POST['om_type_event'];
                        }
                        foreach ($list_e as &$valor) {
                            $sel = '';
                            if ($valor[0] == $default_sel) {
                                $sel = ' selected';
                            }
                            echo '<option value="'.$valor[0].'"'.$sel.'>'.$valor[1].'</option>';
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>

                    <td align='left' width='30%'><?php echo $array_label['lb_name']; ?>:</td>
                    <td align='left' width='70%'><input type="text" name="om_name" size="50" value="<?php echo isset($_POST['om_name'])? $_POST['om_name']:''; ?>"></td>
                </tr>
                <tr>
                    <td align='left'><?php echo $array_label['lb_email']; ?>:</td>
                    <td align='left'><input type="email" name="om_email" size="50" value="<?php echo isset($_POST['om_email'])?$_POST['om_email']:''; ?>"></td>
                </tr>
                <tr>
                    <td align='left'><?php echo $array_label['lb_phone']; ?>:</td>
                    <td align='left'><input type="tel" name="om_phone" size="20" value="<?php echo isset($_POST['om_phone'])?$_POST['om_phone']:''; ?>"></td>
                </tr>
                <tr>
                    <td align='left'><?php echo $array_label['lb_e_date']; ?>:</td>
                    <td align='left'><input type="date" name="om_e_date" value="<?php echo isset($_POST['om_e_date'])?$_POST['om_e_date']:''; ?> "></td>
                </tr>
                <tr>
                    <td align='left'><?php echo $array_label['lb_e_location']; ?>:</td>
                    <td align='left'><input type="text" name="om_e_location" size="50" value="<?php echo isset($_POST['om_e_location'])?$_POST['om_e_location']:''  ; ?>"></td>
                </tr>
                <tr>
                    <td align='left'><?php echo $array_label['lb_e_reception']; ?>:</td>
                    <td align='left'><input type="text" name="om_e_reception" size="50" value="<?php echo isset($_POST['om_e_reception'])?$_POST['om_e_reception']:''; ?>"></td>
                </tr>
                <tr>
                    <td align='left'><?php echo $array_label['lb_n_guests']; ?>:</td>
                    <td align='left'><input type="text" name="om_n_guests" size="20" value="<?php echo isset($_POST['om_n_guests'])?$_POST['om_n_guests']:''; ?>"></td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <div id="om_message">
                            <?php
                            if (isset($_POST['msg_operation'])) {
                                echo "<p class='alert_messge'>".$_POST['msg_operation']."</p>";
                            }
                            ?>
                        </div>
                        <input type="hidden" name="type_operation" value="save_manual_operation">
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td align="center" colspan="2">
                        <input type="button" value="<?php echo $array_label['button_home']; ?>" class="pf_button" onclick="showDiv('dwt_home', 'om_');">
                        <input type="button" value="<?php echo $array_label['button_new']; ?>" class="pf_button" onclick="clearForm('om_');">
                        <input type="submit" value="<?php echo $array_label['button_save']; ?>" class="pf_button">
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
