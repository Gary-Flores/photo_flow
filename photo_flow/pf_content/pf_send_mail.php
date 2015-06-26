<?php
include '../pf_include/pf_main_head.php';
include '../pf_include/pf_send_email_datos.php';

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
            <FORM class="pf_mail" method="post" action="pf_send_mail.php">
                <h2 >Ingrese su nombre <br/></h2><input name="pf_nombre_email" value=<?php echo "$nombre_mail" ?> type="text" size="35">
                <h2>Ingrese su email <br/></h2><input name="pf_email_email" value=<?php echo "$mail_mail" ?> type="text" size="35">
                <h2>Ingrese el titulo de su mensaje <br/></h2>
                <TEXTAREA NAME="pf_mensaje_email_TITLE" ROWS="3" COLS="40" ><?php echo "$titulo_mensaje_mail" ?></TEXTAREA>

                <h2>Ingrese su mensaje </h2>
                
                <TEXTAREA NAME="pf_mensaje_email_CONTENT" ROWS="8" COLS="40"><?php echo "$mensaje_email" ?></TEXTAREA>
                <br/><center><input type="Submit" name="pf_enviar_datos_email_boton" value="Enviar informacion" style="background-color:#4BAA06;padding:0.5em;margin:1em;border-radius:8px;font-size:24px;input:hover{background-color:#ffff;}">
</center>
                </FORM> 

            </div>
        </div>
        <form action="pf_start_page.php" name="form_red_start" method="post">
            <input type="hidden" id="type_operation" name="type_operation" value="">
        </form>
    </body>
</html>
