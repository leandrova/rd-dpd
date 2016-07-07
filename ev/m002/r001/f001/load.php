<?
if ($FUNCOES->getPermissao(2,1,1,2,$USUARIO)) {
	$IU="m002/r001/f001/i001";
} else {
	$IU="m002/r001/f001/i002";
	
	$FUNCOES->consulta(array
			(
			"campos" 	=> "codigoRecurso",
			"tabelas" 	=> "dcd_recursos",
			"condicoes" => "usuarioRecurso  = '$USUARIO' ",
			)
		);
		
	if ($FUNCOES->GetLinhas()>0)
	{
		$obj=mysql_fetch_object($FUNCOES->GetResultado());
		$codigoRecurso = $obj->codigoRecurso;
	}
	else
	{
		$IU="m002/r001/f001/i001";
	}
	
}
?>