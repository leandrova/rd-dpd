<?
	/**/
	function cadastraPermissao($codModulo,$codRotina,$codFuncao,$per,$usu)
	{
		global $USUARIO,$FUNCOES;
		if ($per=="nao")
		{
			$FUNCOES->deleta(array("tabelas" => "permissao","condicoes" => "codModulo=$codModulo and codRotina=$codRotina and codFuncao=$codFuncao and login='$usu'"));
		}
		else
		{
			$FUNCOES->consulta(array("tabelas" => "permissao","condicoes" => "codModulo=$codModulo and codRotina=$codRotina and codFuncao=$codFuncao and login='$usu'"));
			if ($FUNCOES->GetLinhas()>0)
			{
				$FUNCOES->altera(array("tabelas" => "permissao","campos" => "permissao='$per'", "condicoes" => "codModulo=$codModulo and codRotina=$codRotina and codFuncao=$codFuncao and login='$usu'"));
			}
			else
			{
				$FUNCOES->cadastro(array("tabelas" => "permissao","campos" => "login, codModulo, codRotina, codFuncao, permissao, dataCadastro, horaCadastro, usuarioCadastro", "values" => "'$usu','$codModulo','$codRotina','$codFuncao','$per','$FUNCOES->DATA','$FUNCOES->HORA','$USUARIO'"));
			}
		}
	}
	/**/
	$IU="m999/r001/f002/i001";
	//
	$codigo = strtoupper($_POST["codigo"]);
	//
	$FUNCOES->consulta(array("tabelas" => "modulos","ordenacao" => "codModulo,codRotina,codFuncao"));
	if ($FUNCOES->GetLinhas()>0)
	{
		$msn="Permissao alterada";
		$res=$FUNCOES->GetResultado();
		while ($obj=mysql_fetch_object($res))
		{
			if (isset($_POST[$obj->codModulo.$obj->codRotina.$obj->codFuncao."permissao"]))
			{
				$permissao = $_POST[$obj->codModulo.$obj->codRotina.$obj->codFuncao."permissao"];
				cadastraPermissao($obj->codModulo,$obj->codRotina,$obj->codFuncao,$permissao,$codigo);
			}
			
		}
		$FUNCOES->navegacao("eventos","Alteracao","Permissao",$_POST["codigo"]);
	}
	//
?>