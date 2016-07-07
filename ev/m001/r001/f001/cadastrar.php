<?
	$IU="m001/r001/f001/i001b";
	//
	$nomeProjeto		="";	If (isset($_POST["nomeProjeto"])) 		{	$nomeProjeto 		= $_POST["nomeProjeto"]; 		}
	$descricao			="";	If (isset($_POST["descricao"])) 		{	$descricao 			= $_POST["descricao"]; 			}
	$codigoProjeto		=0;		If (isset($_POST["codigoProjeto"])) 	{	$codigoProjeto 	= $_POST["codigoProjeto"]; 			}
	//
	if ($codigoProjeto == "") { $codigoProjeto=0; } /* É um Projeto Novo, sem Pai */
	//
	if ( ($nomeProjeto=="")||($descricao=="") )
	{
		$msn="Informe todos os dados.";
	}else
	{
		//
		$FUNCOES->cadastro(	array(	"campos" => "codigoProjeto, codigoProjetoPai, nomeProjeto, descricao, dataCadastro, horaCadastro, usuarioCadastro",
									"tabelas" => "dcd_projetos ",
									"values" => "'', $codigoProjeto, '".addslashes($nomeProjeto)."', '".addslashes($descricao)."', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
								)
							);
		if($FUNCOES->GetLinhas()>0){
			$msn="Cadastro incluido com sucesso.";
			$IU="m001/r001/f001/i002";
			if ($codigoProjeto <> 0){
				$codigoProjetoPai = $FUNCOES->GetID();
			} else { 
				$codigoProjeto = $FUNCOES->GetID();
			}
			$FUNCOES->navegacao("eventos","Cadastro","Projeto","");
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>