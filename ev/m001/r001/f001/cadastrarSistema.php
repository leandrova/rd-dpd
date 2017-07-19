<?
	$IU="m001/r001/f001/i003";
	//
	$codigoProjeto			= "";	If (isset($_POST["codigoProjeto"])) 		{	$codigoProjeto			= $_POST["codigoProjeto"]; 			}
	$codigoFrente			= "";	If (isset($_POST["codigoFrente"]))			{	$codigoFrente 			= $_POST["codigoFrente"]; 			}
		
	$codigoSistema			= "";	If (isset($_POST["codigoSistema"]))			{	$codigoSistema 			= $_POST["codigoSistema"]; 			}
	$codigoRecursoSistemas	= "";	If (isset($_POST["codigoRecursoSistemas"]))	{	$codigoRecursoSistemas 	= $_POST["codigoRecursoSistemas"]; 	}
	$dataAlocacao			= "";	If (isset($_POST["dataAlocacao"]))			{	$dataAlocacao 			= $_POST["dataAlocacao"]; 			}
	$quantidade				= "";	If (isset($_POST["quantidade"]))			{	$quantidade				= $_POST["quantidade"]; 			}
	$custo					= "";	If (isset($_POST["custo"]))					{	$custo 					= $_POST["custo"]; 					}
	//
	if ( ($codigoFrente == "")||($codigoSistema == "")||($codigoRecursoSistemas == "")||($dataAlocacao == "") )
	{
		$msn="Informe todos os dados para incluir o novo sistema impactado.";
	}else
	{
		//
		$FUNCOES->cadastro(	array(	"campos" 	=> 	"codigoTipoSistema, codigoFrente, codigoRecursoSistemas, dataAlocacao, quantidade, custo, dataCadastro, horaCadastro, usuarioCadastro ",
									"tabelas" 	=> 	"dcd_sistemas ",
									"values" 	=> 	" $codigoSistema, $codigoFrente, $codigoRecursoSistemas, '$dataAlocacao', '".$FUNCOES->limpaValor($quantidade)."', 
													'".$FUNCOES->limpaValor($custo)."', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
								)
							);
		if($FUNCOES->GetLinhas()>0){
			$msn="Novo Sistema Impactado cadastrado com sucesso.";
			$FUNCOES->navegacao("eventos","Cadastro","Sistema Impactado","");
			$cadastroSistema = 1;
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>