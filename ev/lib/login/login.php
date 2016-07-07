<?
	$login=$_POST["login"];
	$senha=md5(strtoupper($_POST["senha"]));
	$data=date('y/m/d');
	$hora=getdate();  $hora=($hora['hours'].':'.$hora['minutes']); 
	//
	if (($login=="")or($senha=="")){
		$msn="Aten&ccedil;&atilde;o, informe o usuario e a senha.";
	}
	else{
		$sql="Select * from usuarios where login='$login' and senha='$senha'";
		$res=mysql_query($sql);
		$linhas=mysql_affected_rows();
	   	if ($linhas>0){
				$sql="Select * from permissao where login='$login'";
				$res=mysql_query($sql);
				$linhas=mysql_affected_rows();
			   	if ($linhas>0){
			        $login=strtoupper($login);
					$res=mysql_query("INSERT INTO usuariohistorico (login, dataLogin, horaLogin) VALUES('$login','$data','$hora')");
					//
					if(mysql_affected_rows()>0){
						$_SESSION["USUARIO"]=$login;
						?>
						<form method="POST" action="<? echo $action ?>" name="aplicacao">
						<script>document.location='index.php';</script>
						</form>
						<?
					}
					else{
						$msn="Erro : ".mysql_error();
					}
				}else{
					$msn="Erro: O seu usu&aacute;rio n&atilde;o possui permiss&atilde;o aos modulos do sistema.";
				}
		}
		else{
			$msn="Erro: Verifique seu usuario ou senha..";
		}
	}

?>