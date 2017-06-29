<?
$IU="m001/r001/f001/i002b";
//
$codigoProjeto		="";	If (isset($_POST["codigoProjeto"])) 	{	$codigoProjeto		= $_POST["codigoProjeto"]; 		}

$idFrente			="";	If (isset($_POST["idFrente"]))			{	$idFrente 		= $_POST["idFrente"]; 				}
$nomeFrente			="";	If (isset($_POST["nomeFrente"]))		{	$nomeFrente 		= $_POST["nomeFrente"]; 		}
$prioridadeFrente	="";	If (isset($_POST["prioridadeFrente"]))	{	$prioridadeFrente 	= $_POST["prioridadeFrente"]; 	}
$descricaoFrente 	="";	If (isset($_POST["descricaoFrente"]))	{	$descricaoFrente 	= $_POST["descricaoFrente"];	}
$codigoTipoProjeto	="";	If (isset($_POST["codigoTipoProjeto"]))	{	$codigoTipoProjeto 	= $_POST["codigoTipoProjeto"];	}
$codigoRecurso		="";	If (isset($_POST["codigoRecurso"]))		{	$codigoRecurso 		= $_POST["codigoRecurso"];		}
$codigoOrigem		="";	If (isset($_POST["codigoOrigem"]))		{	$codigoOrigem 		= $_POST["codigoOrigem"];		}
$codigoFase			="";	If (isset($_POST["codigoFase"]))		{	$codigoFase 		= $_POST["codigoFase"];			}
$codigoArea			="";	If (isset($_POST["codigoArea"]))		{	$codigoArea 		= $_POST["codigoArea"];			}
	//
	if ( ($nomeFrente=="")||($descricaoFrente=="")||($codigoTipoProjeto=="")||($codigoRecurso=="")||($codigoOrigem=="")||($codigoFase=="")||($codigoArea=="") )
	{
		$msn="Informe todos os dados.";
	}else
	{
		//
		$FUNCOES->cadastro(	array(	"campos" => "codigoProjeto, codigoFrente, idFrente, nomeFrente, prioridadeFrente, descricaoFrente, codigoTipoProjeto, codigoRecurso, codigoOrigem, codigoFase, dataCadastro, horaCadastro, usuarioCadastro, codigoArea",
									"tabelas" => "dcd_frentes ",
									"values" => " $codigoProjeto, '', '$idFrente', '".addslashes($nomeFrente)."', '".$prioridadeFrente."', '".addslashes($descricaoFrente)."', '$codigoTipoProjeto', '$codigoRecurso', '$codigoOrigem', '$codigoFase', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."', '$codigoArea' "
								)
							);
		if($FUNCOES->GetLinhas()>0){
			$msn="Cadastro incluido com sucesso.";
			$IU="m001/r001/f001/i002";
			$FUNCOES->navegacao("eventos","Cadastro","Frente do Projeto","");
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>