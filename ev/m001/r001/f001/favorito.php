<?
	$IU="m001/r001/f001/i003";
	//
	$codigoFrente		="";	If (isset($_POST["codigoFrente"]))		{	$codigoFrente 		= $_POST["codigoFrente"]; 		}
	//
	$FUNCOES->consulta(array ( "tabelas" 	=> " dcd_favoritos ", "condicoes" => " codigoFrente = $codigoFrente and usuarioCadastro = '$USUARIO' " ) );
	if($FUNCOES->GetLinhas()>0){
		$FUNCOES->deleta(	array(	
								"tabelas" 	=> " dcd_favoritos ",
								"condicoes" => " codigoFrente = '$codigoFrente' and usuarioCadastro = '".$USUARIO."' "
							)
						);
	}
	else
	{
		$FUNCOES->cadastro(	array(	
								"campos" 	=> " codigoFrente, dataCadastro, horaCadastro, usuarioCadastro",
								"tabelas" 	=> " dcd_favoritos ",
								"values" 	=> " '$codigoFrente', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
							)
						);
	}

?>