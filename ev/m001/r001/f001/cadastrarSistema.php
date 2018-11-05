<?
	$IU="m001/r001/f001/i003";
	//
	$codigoFrente			= "";	If (isset($_POST["codigoFrente"]))			{	$codigoFrente 			= $_POST["codigoFrente"]; 			}
	//
	$codigoSistema			= "";	If (isset($_POST["codigoSistema"]))			{	$codigoSistema 			= $_POST["codigoSistema"]; 			}
	$codigoRecursoSistemas	= "";	If (isset($_POST["codigoRecursoSistemas"]))	{	$codigoRecursoSistemas 	= $_POST["codigoRecursoSistemas"]; 	}
	$dataAlocacao			= "";	If (isset($_POST["dataAlocacao"]))			{	$dataAlocacao 			= $_POST["dataAlocacao"]; 			}
	$quantidade				= "";	If (isset($_POST["quantidade"]))			{	$quantidade				= $_POST["quantidade"]; 			}
	$custo					= "";	If (isset($_POST["custo"]))					{	$custo 					= $_POST["custo"]; 					}
	$num_linha_cap			= "";	If (isset($_POST["num_linha_cap"]))			{	$num_linha_cap			= $_POST["num_linha_cap"];			}
	//
	if ( ($codigoFrente == "") || ($codigoSistema == "") || ($codigoRecursoSistemas == "") || ($dataAlocacao == "") || ($quantidade == "") || ($custo == "") )
	{
		$msn="Informe todos os dados para incluir a alocação.<br>[$codigoFrente|$codigoSistema|$codigoRecursoSistemas|$dataAlocacao|$quantidade|$custo].";
	}
	else{
		//
		$FUNCOES->cadastro(	array(	"campos" 	=> 	" codigoTipoSistema, 
													  codigoFrente, 
													  codigoRecursoSistemas, 
													  dataAlocacao, 
													  quantidade, 
													  custo, 
													  num_linha_cap, 
													  dataCadastro, 
													  horaCadastro, 
													  usuarioCadastro ",
									"tabelas" 	=> 	" dcd_sistemas ",
									"values" 	=> 	" $codigoSistema, 
													  $codigoFrente, 
													  $codigoRecursoSistemas, 
													  '$dataAlocacao', 
													  '".$FUNCOES->limpaValor($quantidade)."', 
													  '".$FUNCOES->limpaValor($custo)."', 
													  '$num_linha_cap', 
													  '".$FUNCOES->DATA."', 
													  '".$FUNCOES->HORA."', 
													  '".$USUARIO."' "
								)
							);
		if($FUNCOES->GetLinhas()){
			$msn="Novo alocação cadastrado com sucesso.";
			$FUNCOES->navegacao("eventos","Cadastro","Sistema Impactado","");
			$cadastroSistema = 1;
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>