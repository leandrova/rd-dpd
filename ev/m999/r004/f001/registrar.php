<?
$IU="m999/r004/f001/i001";
//
$registro=$_POST["registro"]; 
$fp = fopen($FUNCOES->trocadml("./install/serial.key"), "w");
fwrite($fp, $registro);
fclose($fp);
$msn="Sistema registrado com sucesso.";
?>