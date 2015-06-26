<?php
function validateParamsForm($params) {
    global $array_label;
    $result = array();
    foreach ($params as &$valor) {
        // $valor ==> (VALUE - TYPE - NAME - LENGTH)
        $reg_ex = "";
        switch ($valor[1]) {
            case "text":
                $reg_ex = "/^[\w #;,._\-áéíóúÁÉÍÓÚñÑ]*$/";
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
