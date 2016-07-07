<?
	$IU="m999/r001/f001/i002";
	//
	$cadastro=1;
	$codigo= strtoupper($_POST["codigo"]);
	$login = strtoupper($_POST["login"]);
	$senha = strtoupper($_POST["senha"]);
	$senha2 = strtoupper($_POST["senha2"]);
	$nome = strtoupper($_POST["nome"]);
	$email = strtoupper($_POST["email"]);
	$telefone = strtoupper($_POST["telefone"]);
	//
	if (($senha=="")&($senha2==""))
	{
		$valida=0; $alteraSenha="";
	}else
	{
		if($senha<>$senha2)
		{
			$msn="Informe senhas iguais";
			$valida=1;
		}
		else
		{
			$valida=0;
			$senha = md5($senha);
			$alteraSenha=", senha='$senha'";
		}
	}
	//
	if ( ($login=="")||($nome=="")||($email=="")||($telefone=="") )
	{
		$msn="Informe todos os dados.";
	}
	elseif($valida)
	{
		$msn="Informe senhas iguais";
	}
	else
	{
		//
		$senha = md5($senha);
		$FUNCOES->altera(array("campos" => "login='$login', nome='$nome', email='$email', telefone='$telefone' $alteraSenha","tabelas" => "usuarios","condicoes" => "login='$codigo'"));
		if($FUNCOES->GetLinhas()>0)
		{
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m999/r001/f001/i001";
			$FUNCOES->navegacao("eventos","Alteracao","Usuario",$codigo);
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>