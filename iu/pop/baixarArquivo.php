<?php
$file = base64_decode($_GET['file']); 

if (file_exists($file)) {

header("Content-Type: application/save");
header("Content-Length:".filesize($file)); 
header('Content-Disposition: attachment; filename="' . $file . '"');
header("Content-Transfer-Encoding: binary");header('Expires: 0'); 
header('Pragma: no-cache'); 

$fp = fopen("$file", "r"); 
fpassthru($fp); 
fclose($fp); 

echo "<h1>Aguarde</h1>";

}else{
echo "<h1>Audio n&atilde;o encontrado</h1>";
}

?>
