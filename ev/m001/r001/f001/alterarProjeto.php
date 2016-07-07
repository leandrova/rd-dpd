<?
$IU="m001/r001/f001/i003";
$dadosDaFrente="block";		$dadosDoHistorico="none";

$codigoProjeto		="";	If (isset($_POST["codigoProjeto"])) 		{	$codigoProjeto		= $_POST["codigoProjeto"]; 		}
$codigoFrente		="";	If (isset($_POST["codigoFrente"])) 			{	$codigoFrente		= $_POST["codigoFrente"]; 		}

$codigoProjetoNovo	="";	If (isset($_POST["codigoProjetoNovo"]))		{	$codigoProjetoNovo 	= $_POST["codigoProjetoNovo"];  }

$dadosDoProjeto = "block";	$dadosDaFrente="none";

	//
	if ( ($codigoProjeto=="")||($codigoProjetoNovo=="") )
	{
		$msn="Informe o Novo Projeto.<br/><br/>Atenção, os dados da tela podem estar conforme a nova definição, mas ele não foram gravados.";
	}
	else if ( $codigoProjeto == $codigoProjetoNovo)
	{
		$msn="Os dados da alteração do projeto não foram alterados, portanto as informações não foram alteradas.";
	}
	else
	{
		//
		$FUNCOES->altera(array(	"campos" 	=> " codigoProjeto='$codigoProjetoNovo' ",
								"tabelas" 	=> " dcd_frentes ",
								"condicoes" => " codigoProjeto='$codigoProjeto' and codigoFrente='$codigoFrente' "));
		if($FUNCOES->GetLinhas()>0){
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m001/r001/f001/i003";
			$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
			$codigoProjeto = $codigoProjetoNovo;
			/**/			
		}
		else{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
		
		
		
	}
?>