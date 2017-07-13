<?

$codigoFrente		= "";	If (isset($_POST["codigoFrente"]))		{	$codigoFrente 		= $_POST["codigoFrente"]; 		}
$tipoPlanejamento	= "";	If (isset($_POST["tipoPlanejamento"]))	{	$tipoPlanejamento 	= $_POST["tipoPlanejamento"]; 	}


$FUNCOES->altera(
		array(	"campos" 	=> " tipoPlanejamento = '".$tipoPlanejamento."' ",
				"tabelas" 	=> "dcd_frentes",
				"condicoes" => " codigoFrente='$codigoFrente' "
		)
);
if($FUNCOES->GetLinhas()>0){
	$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
	$IU="m001/r001/f001/i003";
} else {
	$msn="Erro : ".$FUNCOES->GetMysqlError();
}