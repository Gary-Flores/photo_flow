
<?php
$file=$_GET['pf_file'];
$TYPE=$_GET['pf_type'];
$img=isset($_GET['img'])?$_GET['img']:2;
if(!($img==1)){
header('Content-type: '.$TYPE.'');
readfile($file);

}else{
	echo "<img src=".$file."/>";

}
?> 

