<?
	$IU="m001/r001/f001/i003";
	//
	$codigoProjeto			="";	If (isset($_POST["codigoProjeto"])) 			{	$codigoProjeto			= $_POST["codigoProjeto"]; 			}
	$codigoFrente			="";	If (isset($_POST["codigoFrente"]))				{	$codigoFrente 			= $_POST["codigoFrente"]; 			}

	$codigoSistemaImpactado	="";	If (isset($_POST["codigoSistemaImpactado"])) 	{	$codigoSistemaImpactado	= $_POST["codigoSistemaImpactado"]; }
	//
	if ( ($codigoSistemaImpactado=="") )
	{
		$msn="Não foi possivel identificar o Sistema Impactado a ser excluido.";
	}else
	{
		//
		$FUNCOES->deleta(
			array(
				"tabelas" 	=> "dcd_sistemas",
				"condicoes" => "codigoSistema = '$codigoSistemaImpactado'"
			)
		);
	    $erro=$FUNCOES->GetMysqlError();
		if ($erro=="")
		{
			$msn="Exclus&atilde;o realizada";
			$FUNCOES->navegacao("eventos", "Exclusao", "Sistema Impactado", $codigoSistemaImpactado);
		}
	    else
		{
			$msn="Erro: $erro";
		}
		//
	}
?>