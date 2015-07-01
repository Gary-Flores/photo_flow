<?php
function validateParamsForm($params) {
    global $array_label;
    $result = array();
    foreach ($params as &$valor) {
        // $valor ==> (VALUE - TYPE - NAME - LENGTH)
        $reg_ex = "";
        switch ($valor[1]) {
            case "text":
                $reg_ex = "/^[\w #;,._\-<\/>!áéíóúÁÉÍÓÚñÑ]*$/";
                break;
            case "email":
                $reg_ex = "/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/";
                break;
            case "number":
                $reg_ex = "/^[0-9]*$/";
                break;
            case "phone":
                $reg_ex = "/[0-9|\+]{0,2}[0-9\- ]*$/";
                break;
            case "option":
                if ($valor[0] == 0) {
                    array_push($result, $array_label['msg_error_unselected'].' ['.$valor[2].']');
                }
                break;
            case "s_file":
                        switch ("s_file") {
                            case UPLOAD_ERR_OK:
                                break;
                            case UPLOAD_ERR_INI_SIZE:
                                array_push($result, $array_label['lb_file_error_php.ini']);
                                break;
                            case UPLOAD_ERR_FORM_SIZE:
                            array_push($result, $array_label['lb_f_size']);
                                break;
                            case UPLOAD_ERR_PARTIAL:
                            array_push($result, $array_label['lb_f_e_update']);
                                break;
                            case UPLOAD_ERR_NO_FILE:
                            array_push($result, $array_label['lb_f_size']);
                                break;
                            case UPLOAD_ERR_NO_TMP_DIR:
                            array_push($result, $array_label['lb_f_e_f_tmp']);
                                break;
                            case UPLOAD_ERR_CANT_WRITE:
                            array_push($result, $array_label['lb_f_e_w_d']);
                                break;
                            case UPLOAD_ERR_EXTENSION:
                            array_push($result, $array_label['lb_f_s_e']);
                                break;

                            default:
                            array_push($result, $array_label['lb_u_u_e']);
                                break;
                        }
        }
        if ($reg_ex != "") {
            if (!preg_match($reg_ex,$valor[0])) {
                array_push($result, $array_label['msg_error_field_start']." [".$valor[2]."] ".$array_label['msg_error_field_invalid']);
            }
            if (strlen($valor[0]) == 0) {
                array_push($result, $array_label['msg_error_field_start']." [".$valor[2]."] ".$array_label['msg_error_length_0']);
            }
            if (strlen($valor[0]) > $valor[3]) {
                array_push($result, $array_label['msg_error_field_start']." [".$valor[2]."] ".$array_label['msg_error_length_pass']);
            }
        }

    }
    return $result;
}
