<?
	$IU="m003/r003/f002/i002";
	//
	$cadastro=1;
	$codigoRecurso		= strtoupper($_POST["codigoRecurso"]);
	$nomeRecurso 		= strtoupper($_POST["nomeRecurso"]);
	//
	if ( ($codigoRecurso == "") || ($nomeRecurso == "") )
	{
		$msn="Informe todos os dados.";
	}
	else
	{
		//
		$FUNCOES->altera(
					array(
						"campos" 		=> " nomeRecurso='$nomeRecurso' ",
						"tabelas" 		=> " dcd_recursossistemas",
						"condicoes" 	=> " codigoRecurso = '$codigoRecurso' "
					)
				);
		if($FUNCOES->GetLinhas()>0)
		{
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m003/r003/f002/i002";
			$FUNCOES->navegacao("eventos","Alteracao","Recurso Sistema",$codigoRecurso);
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>