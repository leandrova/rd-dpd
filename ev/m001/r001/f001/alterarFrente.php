﻿<?
$IU="m001/r001/f001/i003";
$dadosDaFrente="block";		$dadosDoHistorico="none";

$codigoProjeto		="";	If (isset($_POST["codigoProjeto"])) 	{	$codigoProjeto		= $_POST["codigoProjeto"]; 		}
$codigoFrente		="";	If (isset($_POST["codigoFrente"]))		{	$codigoFrente 		= $_POST["codigoFrente"]; 		}

$idFrente			="";	If (isset($_POST["idFrente"]))			{	$idFrente 			= $_POST["idFrente"]; 			}
$nomeFrente			="";	If (isset($_POST["nomeFrente"]))		{	$nomeFrente 		= $_POST["nomeFrente"]; 		}
$prioridadeFrente	="";	If (isset($_POST["prioridadeFrente"]))	{	$prioridadeFrente 	= $_POST["prioridadeFrente"]; 	}
$descricaoFrente 	="";	If (isset($_POST["descricaoFrente"]))	{	$descricaoFrente 	= $_POST["descricaoFrente"];	}

	//
	if ( ($nomeFrente=="") || ($descricaoFrente=="") )
	{
		$msn="Informe todos os dados da Frente do Projeto.<br/><br/>Atenção, os dados da tela podem estar conforme a nova definição, mas ele não foram gravados.";
	}
	else
	{
		//
		$FUNCOES->altera(array(	"campos" => " idFrente = '".$idFrente."', nomeFrente='".addslashes($nomeFrente)."', prioridadeFrente = '".$prioridadeFrente."', descricaoFrente='".addslashes($descricaoFrente)."' ",
								"tabelas" => "dcd_frentes",
								"condicoes" => "codigoProjeto='$codigoProjeto' and codigoFrente='$codigoFrente' "));
		if($FUNCOES->GetLinhas()>0){
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m001/r001/f001/i003";
			$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
		}
		else{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>