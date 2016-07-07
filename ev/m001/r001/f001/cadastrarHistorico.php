<?
	$IU="m001/r001/f001/i003";
	$incluirHistorico="block";		$dadosDoHistorico="none";
	//
	$codigoProjeto			="";	If (isset($_POST["codigoProjeto"])) 		{	$codigoProjeto		= $_POST["codigoProjeto"]; 							}
	$codigoFrente			="";	If (isset($_POST["codigoFrente"]))			{	$codigoFrente 		= $_POST["codigoFrente"]; 							}
	
	$dataHistorico			="";	If (isset($_POST["dataHistorico"])) 		{	$dataHistorico 		= $FUNCOES->dataInterna($_POST["dataHistorico"]); 	}
	$descricaoHistorico		="";	If (isset($_POST["descricaoHistorico"])) 	{	$descricaoHistorico	= $_POST["descricaoHistorico"]; 					}
	$codigoTipoProjeto		="";	If (isset($_POST["codigoTipoProjeto"])) 	{	$codigoTipoProjeto 	= $_POST["codigoTipoProjeto"]; 						}
	$codigoRecurso			="";	If (isset($_POST["codigoRecurso"])) 		{	$codigoRecurso 		= $_POST["codigoRecurso"]; 							}
	$codigoOrigem			="";	If (isset($_POST["codigoOrigem"])) 			{	$codigoOrigem 		= $_POST["codigoOrigem"]; 							}
	$codigoFase				="";	If (isset($_POST["codigoFase"])) 			{	$codigoFase 		= $_POST["codigoFase"]; 							}
	$codigoStatus			="";	If (isset($_POST["codigoStatus"])) 			{	$codigoStatus 		= $_POST["codigoStatus"]; 							}
	$codigoArea				="";	If (isset($_POST["codigoArea"])) 			{	$codigoArea 		= $_POST["codigoArea"]; 							}

	$codigoTipoProjetoOrig	="";	If (isset($_POST["codigoTipoProjetoOrig"]))	{	$codigoTipoProjetoOrig 	= $_POST["codigoTipoProjetoOrig"]; 				}
	$codigoRecursoOrig		="";	If (isset($_POST["codigoRecursoOrig"])) 	{	$codigoRecursoOrig 		= $_POST["codigoRecursoOrig"]; 					}
	$codigoOrigemOrig		="";	If (isset($_POST["codigoOrigemOrig"])) 		{	$codigoOrigemOrig 		= $_POST["codigoOrigemOrig"]; 					}
	$codigoFaseOrig			="";	If (isset($_POST["codigoFaseOrig"])) 		{	$codigoFaseOrig 		= $_POST["codigoFaseOrig"]; 					}
	$codigoStatusOrig		="";	If (isset($_POST["codigoStatusOrig"]))		{	$codigoStatusOrig		= $_POST["codigoStatusOrig"];					}
	$codigoAreaOrig			="";	If (isset($_POST["codigoAreaOrig"]))		{	$codigoAreaOrig			= $_POST["codigoAreaOrig"];						}
	/**/
	//
	if ($dataHistorico==""){
		$msn = "Ops! Data não informada ou invalida.";
	} else if ( ($descricaoHistorico=="")||($codigoTipoProjeto=="")||($codigoRecurso=="")||($codigoOrigem=="")||($codigoFase=="")||($codigoStatus=="") )
	{
		$msn="Informe todos os dados.";
	}else
	{
		/* Validando se o dado foi alterado, e se foi a frente será alterada */
		if ($codigoTipoProjeto 	== $codigoTipoProjetoOrig)	{	
			$codigoTipoProjeto 	= " ''"; 		
		} else {
			$FUNCOES->altera(	array(	"campos" 	=> " codigoTipoProjeto = '$codigoTipoProjeto' ",
										"tabelas" 	=> " dcd_frentes ",
										"condicoes" => " codigoProjeto = $codigoProjeto and codigoFrente = $codigoFrente "
									)
								);
			if($FUNCOES->GetLinhas()>0){
				$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
			} else {
				$msn .= "<br>Erro : ".$FUNCOES->GetMysqlError();
			}
		};
		/* Validando se o dado foi alterado, e se foi a frente será alterada */
		if ($codigoRecurso 		== $codigoRecursoOrig) 		{	
			$codigoRecurso 		= " ''";
		} else {
			$FUNCOES->altera(	array(	"campos" 	=> " codigoRecurso = '$codigoRecurso'",
										"tabelas" 	=> " dcd_frentes ",
										"condicoes" => " codigoProjeto = $codigoProjeto and codigoFrente = $codigoFrente "
									)
								);
			if($FUNCOES->GetLinhas()>0){
				$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
			} else {
				$msn .= "<br>Erro : ".$FUNCOES->GetMysqlError();
			}
		}
		/* Validando se o dado foi alterado, e se foi a frente será alterada */
		if ($codigoOrigem 		== $codigoOrigemOrig) 		{	
			$codigoOrigem 		= " ''";
		} else {
			$FUNCOES->altera(	array(	"campos" 	=> " codigoOrigem = '$codigoOrigem'",
										"tabelas" 	=> " dcd_frentes ",
										"condicoes" => " codigoProjeto = $codigoProjeto and codigoFrente = $codigoFrente "
									)
								);
			if($FUNCOES->GetLinhas()>0){
				$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
			} else {
				$msn .= "<br>Erro : ".$FUNCOES->GetMysqlError();
			}
		}
		/* Validando se o dado foi alterado, e se foi a frente será alterada */
		if ($codigoFase 		== $codigoFaseOrig) 		{
			$codigoFase 		= " ''";
		} else {
			$FUNCOES->altera(	array(	"campos" 	=> " codigoFase = '$codigoFase'",
										"tabelas" 	=> " dcd_frentes ",
										"condicoes" => " codigoProjeto = $codigoProjeto and codigoFrente = $codigoFrente "
									)
								);
			if($FUNCOES->GetLinhas()>0){
				$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
			} else {
				$msn .= "<br>Erro : ".$FUNCOES->GetMysqlError();
			}
		}
		/* Validando se o dado foi alterado, e se foi a frente será alterada */
		if ($codigoStatus 	== $codigoStatusOrig)	{	
			$codigoStatus 	= " ''"; 		
		} else {
			$FUNCOES->altera(	array(	"campos" 	=> " codigoStatus = '$codigoStatus' ",
										"tabelas" 	=> " dcd_frentes ",
										"condicoes" => " codigoProjeto = $codigoProjeto and codigoFrente = $codigoFrente "
									)
								);
			if($FUNCOES->GetLinhas()>0){
				$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
			} else {
				$msn .= "<br>Erro : ".$FUNCOES->GetMysqlError();
			}
		};
		/* Validando se o dado foi alterado, e se foi a frente será alterada */
		if ($codigoArea 	== $codigoAreaOrig)	{	
			$codigoArea 	= " ''"; 		
		} else {
			$FUNCOES->altera(	array(	"campos" 	=> " codigoArea = '$codigoArea' ",
										"tabelas" 	=> " dcd_frentes ",
										"condicoes" => " codigoProjeto = $codigoProjeto and codigoFrente = $codigoFrente "
									)
								);
			if($FUNCOES->GetLinhas()>0){
				$FUNCOES->navegacao("eventos","Alteracao","Frente do Projeto","");
			} else {
				$msn .= "<br>Erro : ".$FUNCOES->GetMysqlError();
			}
		};
		/**/
		$FUNCOES->cadastro(	array(	"campos" 	=> " codigoHistorico, codigoFrente, dataHistorico, descricaoHistorico, codigoTipoProjeto, codigoRecurso, codigoOrigem, codigoFase, codigoStatus, dataCadastro, horaCadastro, usuarioCadastro",
									"tabelas" 	=> " dcd_historico ",
									"values" 	=> " '', $codigoFrente, '$dataHistorico', '".addslashes($descricaoHistorico)."', $codigoTipoProjeto, $codigoRecurso, $codigoOrigem, $codigoFase, $codigoStatus, '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
								)
							);
		if($FUNCOES->GetLinhas()>0){
			$msn="Cadastro incluido com sucesso.";
			$IU="m001/r001/f001/i003";
			$FUNCOES->navegacao("eventos","Cadastro","Historico do Projeto","");
			$cadastro=1;
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>