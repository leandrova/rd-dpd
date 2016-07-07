<?
$GLOBALS["MODULOSISTEMA"]="Projetos";
$GLOBALS["DISCRICAOSISTEMA"]="Incluir Novo Projeto";
/**/

$codigoProjeto		=0;		If (isset($_POST["codigoProjeto"])) {	$codigoProjeto 	= $_POST["codigoProjeto"]; 	}

$nomeProjeto		="";	If (isset($_POST["nomeProjeto"])) 	{	$nomeProjeto 	= $_POST["nomeProjeto"]; 	}
$descricao			="";	If (isset($_POST["descricao"])) 	{	$descricao 		= $_POST["descricao"]; 		}

/* Identificando Sub Projeto */
if ($codigoProjeto <> 0){

	$FUNCOES->consulta(array
						(
							"tabelas" => "dcd_projetos p1",
							"condicoes" => " codigoProjeto = $codigoProjeto ",
						)
					);
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$GLOBALS["DISCRICAOSISTEMA"]="Incluir Novo SubProjeto no Projeto $obj->nomeProjeto ";
}


}
/* */


?>