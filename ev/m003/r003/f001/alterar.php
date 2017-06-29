<?
	$IU="m003/r003/f001/i002";
	//
	$cadastro=1;
	$codigoTipoSistema	= strtoupper($_POST["codigoTipoSistema"]);
	$nomeSistema 		= strtoupper($_POST["nomeSistema"]);
	$codigoTecnologia 	= strtoupper($_POST["codigoTecnologia"]);
	$codigoTipoContrato = strtoupper($_POST["codigoTipoContrato"]);
	//
	if ( ($codigoTipoSistema=="") || ($nomeSistema=="") || ($codigoTecnologia=="") || ($codigoTipoContrato=="") )
	{
		$msn="Informe todos os dados.";
	}
	else
	{
		//
		$FUNCOES->altera(
					array(
						"campos" 		=> " nomeSistema='$nomeSistema', codigoTecnologia='$codigoTecnologia', codigoContrato='$codigoTipoContrato' ",
						"tabelas" 		=> " dcd_tipossistema",
						"condicoes" 	=> " codigoSistema = '$codigoTipoSistema' "
					)
				);
		if($FUNCOES->GetLinhas()>0)
		{
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m003/r003/f001/i002";
			$FUNCOES->navegacao("eventos","Alteracao","Tipos Sistema",$codigoTipoSistema);
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>