<?
$GLOBALS["MODULOSISTEMA"]="Modulos";
$GLOBALS["DISCRICAOSISTEMA"]="Gerenciar Modulo";
/**/
$codModulo="";	if (isset($_POST["codModulo"])) { $codModulo=$_POST["codModulo"]; 	} else { $codModulo=""; 	}
$codRotina="";	if (isset($_POST["codRotina"])) { $codRotina=$_POST["codRotina"]; 	} else { $codRotina=""; 	}
$codFuncao="";	if (isset($_POST["codFuncao"])) { $codFuncao=$_POST["codFuncao"]; 	} else { $codFuncao=""; 	}
$modulo="";		if (isset($_POST["modulo"])) 	{ $modulo=$_POST["modulo"]; 		} else { $modulo=""; 		}
$rotina="";		if (isset($_POST["rotina"])) 	{ $rotina=$_POST["rotina"]; 		} else { $rotina=""; 		}
$funcao="";		if (isset($_POST["funcao"])) 	{ $funcao=$_POST["funcao"]; 		} else { $funcao=""; 		}
$loadClass="";	if (isset($_POST["loadClass"])) { $loadClass=$_POST["loadClass"]; 	} else { $loadClass=""; 	}
/**/

/**/
$FUNCOES->consulta(array("tabelas" => "modulos","condicoes" => "codModulo='$codModulo' and codRotina='$codRotina' and codFuncao='$codFuncao'"));
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$modulo=$obj->modulo;
	$rotina=$obj->rotina;
	$funcao=$obj->funcao;
	$codModulo=$obj->codModulo;
	$codRotina=$obj->codRotina;
	$codFuncao=$obj->codFuncao;
	$loadClass=$obj->loadClass;
}
/**/

?>