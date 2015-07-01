
<?php
$file=$_GET['pf_file'];
$type=$_GET['pf_type'];
	header('Content-type:'.$type);
readfile($file);
?> 

