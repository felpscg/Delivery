<?php 
header('Content-Type: text/html; charset=utf-8');
$nometemp = $_FILES['img']["tmp_name"];
$nometemp = $_FILES['img']["tmp_name"];
$tipo = $_FILES['img']["type"];
//$image['size']>200000){
	
$nomereal=$_FILES["img"]["name"];
copy($nometemp,$nomereal); 
    $data   = fopen($nomereal, 'r');
    $size   = filesize($nomereal);
    $contents= fread($data, $size);
	fclose($data);
    $imagestring =  base64_encode($contents);
	
	$imagedecode = base64_decode($imagestring);
	echo "<img src='data:$tipo;base64,$imagestring'/>";
	echo $tipo;
	echo $imagestring;
unlink($nomereal);
?>