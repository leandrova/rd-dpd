<?
	$IU="m999/r002/f001/i002";
	//
	$codModulo=$_POST["codModulo"];
	$codRotina=$_POST["codRotina"];
	$codFuncao=$_POST["codFuncao"];
	//
	$FUNCOES->deleta(array("tabelas" => "modulos","condicoes" => "codModulo='$codModulo' and codRotina='$codRotina' and codFuncao='$codFuncao'"));
    $erro=$FUNCOES->GetMysqlError();
	if ($erro=="")
	{
		$IU="m999/r002/f001/i001";
		$msn="Exclus&atilde;o realizada";
		$FUNCOES->navegacao("eventos","Exclusao","Modulos","");
	}
    else
	{
		$msn="Erro: $erro";
	}
?>