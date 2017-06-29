<?
$GLOBALS["MODULOSISTEMA"]="Sistemas";
$GLOBALS["DISCRICAOSISTEMA"]="Gerenciar Recurso de Sistemas";
/**/
if (isset($_POST["codigoRecurso"]))		{ $codigoRecurso=$_POST["codigoRecurso"]; 	} else { $codigoRecurso=""; 	}
if (isset($_POST["nomeRecurso"])) 		{ $nomeRecurso=$_POST["nomeRecurso"]; 		} else { $nomeRecurso=""; 		}
/**/
if ($codigoTipoSistema<>"novo")
{
	$FUNCOES->consulta(array("tabelas" => "dcd_recursossistemas","condicoes" => " codigoRecurso='$codigoRecurso' "));
	if ($FUNCOES->GetLinhas()>0)
	{
		$obj=mysql_fetch_object($FUNCOES->GetResultado());
		$nomeRecurso 		= $obj->nomeRecurso;
	}

}
/**/
?>
