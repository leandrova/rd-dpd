<?
	$IU="m003/r003/f001/i002";
	//
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
		$FUNCOES->cadastro(
					array(
						"campos" 	=> " nomeSistema, codigoTecnologia, codigoContrato, dataCadastro, horaCadastro, usuarioCadastro",
						"tabelas" 	=> " dcd_tipossistema",
						"values" 	=> " '$nomeSistema','$codigoTecnologia','$codigoTipoContrato', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
					)
				);
		if($FUNCOES->GetLinhas()>0)
		{
			$msn="Cadastro incluido com sucesso.";
			$IU="m003/r003/f001/i001";
			$FUNCOES->navegacao("eventos","Cadastro","Usuario",$FUNCOES->GetID());
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>