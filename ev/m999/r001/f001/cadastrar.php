<?
	$IU="m999/r001/f001/i002";
	//
	$login = strtoupper($_POST["login"]);
	$senha = strtoupper($_POST["senha"]);
	$senha2 = strtoupper($_POST["senha2"]);
	$nome = strtoupper($_POST["nome"]);
	$email = strtoupper($_POST["email"]);
	$telefone = strtoupper($_POST["telefone"]);
	//
	if ( ($login=="")||($senha=="")||($senha2=="")||($nome=="")||($email=="")||($telefone=="") )
	{
		$msn="Informe todos os dados.";
	}
	elseif($senha<>$senha2)
	{
		$msn="Informe senhas iguais";
	}
	else
	{
		//
		$senha = md5($senha);
		$FUNCOES->cadastro(array("campos" => "login, senha, nome, email, telefone, dataSenha","tabelas" => "usuarios","values" => "'$login','$senha','$nome','$email','$telefone','1980-01-01'"));
		if($FUNCOES->GetLinhas()>0)
		{
			$msn="Cadastro incluido com sucesso.";
			$IU="m999/r001/f001/i001";
			$FUNCOES->navegacao("eventos","Cadastro","Usuario",$FUNCOES->GetID());
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>