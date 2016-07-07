<?
	$IU="m999/r001/f001/i001";
	//
	$codigo = strtoupper($_POST["codigo"]);
	//
	$FUNCOES->deleta(array("tabelas" => "usuarios","condicoes" => "login='$codigo'"));
    $erro=$FUNCOES->GetMysqlError();
	if ($erro=="")
	{
		$msn="Exclus&atilde;o realizada";
		$FUNCOES->deleta(array("tabelas" => "permissao","condicoes" => "login='$codigo'"));
		$FUNCOES->deleta(array("tabelas" => "usuariohistorico","condicoes" => "login='$codigo'"));
		$FUNCOES->navegacao("eventos","Exclusao","Usuario",$codigo);
	}
    else
	{
		$msn="Erro: $erro";
	}
?>