<?
	$IU="m999/r001/f001/i003";
	//
	$novasenha = strtoupper($_POST["novasenha"]);
	$novasenha2 = strtoupper($_POST["novasenha2"]);
	//
	if (($novasenha=="")&($novasenha2==""))
	{
		$msn="Informe a nova senha";
	}
	elseif($novasenha<>$novasenha2)
	{
		$msn="Informe senhas iguais";
	}
	else
	{
		//
		$senha = md5(strtoupper($_POST["novasenha"]));
		//
		$FUNCOES->consulta(array("tabelas" => "usuarios","condicoes" => "senha='$senha' and login='$USUARIO'"));
		if ($FUNCOES->GetLinhas()>0)
		{
			$msn="Informe uma senha diferente da antiga";	
		}
		else
		{
			$FUNCOES->altera(array("campos" => "senha='$senha', dataSenha='$FUNCOES->DATA'", "tabelas" => "usuarios","condicoes" => "login='$USUARIO'"));
			$res=mysql_query($FUNCOES->GetResultado());
			if($FUNCOES->GetLinhas()>0)
			{
				?><script>document.location='index.php'</script><?
				$FUNCOES->navegacao("eventos","Alteracao","Senha",$USUARIO);
			}
			else
			{
				$msn="Erro : ".$FUNCOES->GetMysqlError();
			}
		}
	}
?>