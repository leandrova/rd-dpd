<?
	$IU="m003/r003/f002/i002";
	//
	$nomeRecurso 		= strtoupper($_POST["nomeRecurso"]);
	//
	if ( ($nomeRecurso == "") )
	{
		$msn="Informe todos os dados.";
	}
	else
	{
		//
		$FUNCOES->cadastro(
					array(
						"campos" 	=> " nomeRecurso, dataCadastro, horaCadastro, usuarioCadastro",
						"tabelas" 	=> " dcd_recursossistemas",
						"values" 	=> " '$nomeRecurso', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
					)
				);
		if($FUNCOES->GetLinhas()>0)
		{
			$msn="Cadastro incluido com sucesso.";
			$IU="m003/r003/f002/i001";
			$FUNCOES->navegacao("eventos","Cadastro","Recurso Sistema",$FUNCOES->GetID());
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>