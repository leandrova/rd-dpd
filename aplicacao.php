<?
echo "<!-- secao -->";
ob_start(); 
session_start();//iniciamos a sessão
session_name(session_id()."system");
// Funcao que verifica se o servidor é windows ou linux para colocar / ou \
date_default_timezone_set('America/Sao_Paulo');
/**/
$NOMESISTEMA="Vivo - Canais Digitais";
$DESCRICAOSISTEMA="";
/**/
$USUARIO="";
if(isset($_SESSION["USUARIO"])){
	$USUARIO=$_SESSION["USUARIO"];
}
/**/
echo "<!-- funcoes -->";
include("./ev/lib/js/funcoes.php");
include("./iu/lib/js/funcoes.php");
/**/
echo "<!-- conexao -->";
$FUNCOES = new FUNCOES();
$conexao = $FUNCOES->conexao;
/**/
$msn=""; $evento="";

//include($FUNCOES->trocadml("./iu/lib/debug.php"));
/**/
echo "<!-- validacoes -->";
//Executa os Eventos do Sistema
if ($USUARIO=="")
{
	$MODULOSISTEMA="Login";
	$ROTINASISTEMA="";
	$DISCRICAOSISTEMA="";
	$IU="m000/r001/f001/i001";
}
elseif ($FUNCOES->tempoSenha($USUARIO)>90)
{
	$MODULOSISTEMA="Home";
	$ROTINASISTEMA="";
	$DISCRICAOSISTEMA="Escolha uma op&ccedil;&atilde;o do menu";
	$IU="m999/r001/f001/i003";
}
else
{
	$MODULOSISTEMA="Home";
	$ROTINASISTEMA="";
	$DISCRICAOSISTEMA="Escolha uma op&ccedil;&atilde;o do menu";
	$IU="m000/r001/f002/i001";
}
//
if (isset($_POST["IU"]))	{	$IU=$_POST["IU"];	}
//
echo "<!-- busca eventos -->";
$FUNCOES->USUARIO=$USUARIO;
$FUNCOES->IU=$IU;
// Evento a ser realizado
$diretorio = getcwd();
if(isset($_POST["evento"]) ){
	$evento=$_POST["evento"];
	if( ($evento<>"") & ($USUARIO <> "" or $evento == "lib/login/login") ){
		$evento = "/ev/".$evento.".php";
		echo "<!-- executa evento -->";
		include $FUNCOES->trocadml($diretorio.$evento);
		echo "<!-- termina evento -->";
	}
	$evento="";
}
/**/
echo "<!-- evento -->";
include("./ev/".$IU.".php");

echo "<!-- head -->";
include("./ev/lib/head.php");
include("./iu/lib/head.php");

echo "<!-- topo -->";
include("./ev/lib/topo.php");
include("./iu/lib/topo.php");

echo "<!-- menu -->";
if ($FUNCOES->tempoSenha($USUARIO)<=90) {
include("./ev/lib/menu.php");
include("./iu/lib/menu.php");
}

echo "<!-- breadCrumb -->";
include("./ev/lib/breadCrumb.php");
include("./iu/lib/breadCrumb.php");

echo "<!-- interface -->";
include("./iu/".$IU.".php");

echo "<!-- rodape -->";
include("./ev/lib/rodape.php");
include("./iu/lib/rodape.php");
/**/

ob_end_flush(); 

?>