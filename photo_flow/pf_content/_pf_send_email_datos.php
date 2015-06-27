<?php
$pf_base_user_mail="photo_flow";
$pf_tabla_user_mail="pf_email_config";
$user_db_mail = mysql_connect("localhost", "root", "" );
$msg_enviado='';
mysql_select_db($pf_tabla_user_mail, $user_db_mail);
$arreglo_datos_email=array();
$sql="SELECT * FROM pf_email_config  where id_flow=1;";
$resultado=mysql_query($sql);
while ($row = mysql_fetch_assoc($resultado)) {
foreach ($row as $key => $value) {
array_push($arreglo_datos_email,$value);
}
}
$a=count($arreglo_datos_email);
 $nombre_mail="$arreglo_datos_email[2]";
 $mail_mail="$arreglo_datos_email[2]";
 $mensaje_mail="$arreglo_datos_email[3]";
 $mensaje_email="$arreglo_datos_email[4]";
 $titulo_mensaje_mail="$arreglo_datos_email[3]";
$resultado = mysql_query($sql);
$campos = mysql_num_fields($resultado);
$filas = mysql_num_rows($resultado);

if ($resultado) {
//	echo "yes";
}else{

//	echo "No";
}
if(isset($_POST['pf_enviar_datos_email_boton'])){
$NOMBRE=isset($_POST['pf_nombre_email'])?$_POST['pf_nombre_email']:'Servidor';
$EMAIL=isset($_POST['pf_email_email'])?$_POST['pf_email_email']:'ivan@localhost.com';
$TITULO_MENSAJE=isset($_POST['pf_mensaje_email_TITLE'])?$_POST['pf_mensaje_email_TITLE']:'Error con envio de mensaje';
$MSG=isset($_POST['pf_mensaje_email_TITLE'])?$_POST['pf_nombre_email']:'Arreglar de inmediato';
$mensaje1=isset($_POST['pf_mensaje_email_CONTENT'])?$_POST['pf_mensaje_email_CONTENT']:'Usuario no contactado';
$mensaje='<div style="background-color:#226;padding:10px;">
<h1 style="background-color:#910;color:#fff;">mensaje de prueba para '.$NOMBRE.'</h1>
<img src="http://www.mancera.org/wp-content/uploads/2011/03/php_y_mysql-500x270.png" width="288" height="100">
<h2 style="color:#fff;">'.$TITULO_MENSAJE.'</h2>
<h2 style="color:#fff;">'.$MSG.'</h2>
<h2 style="color:#fff;">'.$mensaje1.'</h2></div>';
$cabeceras="MIME-Version:1.0\r\n";
$cabeceras.="Content-type:text/html; charset=utf-8\r\n";
$cabeceras.="From:Yo mismo!!!<correo@remitente.com\r\n>";
if(mail($EMAIL,"Email en formato html",$mensaje,$cabeceras)){
$msg_enviado= "<center><h1 style='background-color:#C7B99C;padding:0.4em;font-size:11px;padding:1em;border-radius:14px;box-shadow:2px,2px,2px,black;'>Mensaje enviado exitosamente</h1></center>";}
else{
$msg_enviado= "<h1 style='background-color:#C7B99C;padding:0.4em;font-size:11px;'>Mensaje NO enviado</h1>";
}
}

mysql_close($user_db_mail);
?>
