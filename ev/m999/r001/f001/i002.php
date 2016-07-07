<?
$GLOBALS["MODULOSISTEMA"]="Usu&aacute;rios";
$GLOBALS["DISCRICAOSISTEMA"]="Gerenciar Usu&aacute;rio";
/**/
if (isset($_POST["login"])) 	{ $login=$_POST["login"]; 		} else { $login=""; 	}
if (isset($_POST["senha"])) 	{ $senha=$_POST["senha"]; 		} else { $senha=""; 	}
if (isset($_POST["nome"])) 		{ $nome=$_POST["nome"]; 		} else { $nome="";  	}
if (isset($_POST["email"])) 	{ $email=$_POST["email"]; 		} else { $email="";		}
if (isset($_POST["telefone"])) 	{ $telefone=$_POST["telefone"]; } else { $telefone="";	}
/**/
$codigo="";		if (isset($_POST["codigo"])) { $codigo=$_POST["codigo"]; }
/**/
if ($codigo<>"novo")
{
	$FUNCOES->consulta(array("tabelas" => "usuarios","condicoes" => "login='$codigo'"));
	if ($FUNCOES->GetLinhas()>0)
	{
		$obj=mysql_fetch_object($FUNCOES->GetResultado());
		$usuario=$obj->login;
		if ($login=="") $login=$obj->login;
		if ($senha=="") $senha=$obj->senha;
		if ($nome=="") $nome=$obj->nome;
		if ($email=="") $email=$obj->email;
		if ($telefone=="") $telefone=$obj->telefone;
	}
}
/**/
?>