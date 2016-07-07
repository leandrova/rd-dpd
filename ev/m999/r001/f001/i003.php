<?
$GLOBALS["MODULOSISTEMA"]="Seguran&ccedil;a";
$GLOBALS["DISCRICAOSISTEMA"]="Altera&ccedil;&atilde;o de Senha";
$FUNCOES->navegacao("eventos","Consulta","Altera Senha",$USUARIO);
/**/
$login=$USUARIO;
$nome="";
$email="";
$telefone="";
/**/
$FUNCOES->consulta(array("tabelas" => "usuarios","condicoes" => " login='$USUARIO' "));
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$login=$obj->login;
	$nome=$obj->nome;
	$email=$obj->email;
	$telefone=$obj->telefone;
}
/**/
?>