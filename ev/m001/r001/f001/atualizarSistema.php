<?

	$IU="m001/r001/f001/i003";
	//
	$codigoSistemaImpactado	= "";	If (isset($_POST["codigoSistemaImpactado"])){	$codigoSistemaImpactado	= $_POST["codigoSistemaImpactado"];	}
	$codigoFrente			= "";	If (isset($_POST["codigoFrente"]))			{	$codigoFrente 			= $_POST["codigoFrente"]; 			}
	//
	$quantidade				= "";	If (isset($_POST["quantidade".$codigoSistemaImpactado]))			{	$quantidade				= $_POST["quantidade".$codigoSistemaImpactado]; 			}
	$custo					= "";	If (isset($_POST["custo".$codigoSistemaImpactado]))					{	$custo 					= $_POST["custo".$codigoSistemaImpactado]; 					}
	$num_linha_cap			= "";	If (isset($_POST["num_linha_cap".$codigoSistemaImpactado]))			{	$num_linha_cap			= $_POST["num_linha_cap".$codigoSistemaImpactado];			}
	//
	if ( ($codigoSistemaImpactado == "") || ($num_linha_cap == "") || ($quantidade == "") || ($custo == "") )
	{
		$msn="Informe todos os dados para incluir a alocação.<br>[$codigoFrente|$codigoSistemaImpactado|$quantidade|$custo|$num_linha_cap].";
	}
	else{

		$FUNCOES->altera(
				array(	"campos" 	=> " num_linha_cap = '$num_linha_cap', quantidade = '$quantidade', custo = '$custo' ",
						"tabelas" 	=> " dcd_sistemas",
						"condicoes" => " codigoSistema='$codigoSistemaImpactado' "
				)
		);
		
		if($FUNCOES->GetLinhas()>0){
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m001/r001/f001/i003";
		} else {
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}