<?
$GLOBALS["MODULOSISTEMA"]="Registro";
$GLOBALS["DISCRICAOSISTEMA"]="Dados do Registro";
/**/
$dataExpira = $FUNCOES->dataExpira();
$diasExpira = $FUNCOES->difDias($dataExpira,$FUNCOES->DATA);
/**/
$fp = fopen($FUNCOES->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1),'r'); $dadosRegistro="";
if (filesize($FUNCOES->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1)))
{
	$dadosRegistro = fread($fp, filesize($FUNCOES->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1)));
}
?>
