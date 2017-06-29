<?
$GLOBALS["MODULOSISTEMA"]="Sistemas";
$GLOBALS["DISCRICAOSISTEMA"]="Gerenciar Sistemas";
/**/
if (isset($_POST["codigoTipoSistema"]))		{ $codigoTipoSistema=$_POST["codigoTipoSistema"]; 	} else { $codigoTipoSistema=""; 	}
if (isset($_POST["nomeSistema"])) 			{ $nomeSistema=$_POST["nomeSistema"]; 				} else { $nomeSistema=""; 			}
if (isset($_POST["codigoTecnologia"])) 		{ $codigoTecnologia=$_POST["codigoTecnologia"]; 	} else { $codigoTecnologia=""; 		}
if (isset($_POST["codigoTipoContrato"])) 	{ $codigoTipoContrato=$_POST["codigoTipoContrato"]; } else { $codigoTipoContrato="";  	}
/**/
if ($codigoTipoSistema<>"novo")
{
	$FUNCOES->consulta(array("tabelas" => "dcd_tipossistema","condicoes" => " codigoSistema='$codigoTipoSistema' "));
	if ($FUNCOES->GetLinhas()>0)
	{
		$obj=mysql_fetch_object($FUNCOES->GetResultado());
		$nomeSistema 		= $obj->nomeSistema;
		$codigoTecnologia 	= $obj->codigoTecnologia;
		$codigoTipoContrato 	= $obj->codigoContrato;
	}

}
/**/
/* Buscando Tipos de Sistemas */
$FUNCOES->consulta(array ( "tabelas" => " dcd_tipostecnologia dtt", "ordenacao" => " dtt.nomeTecnologia ") );
if ($FUNCOES->GetLinhas()>0)
{
	$listaTiposTecnologia[]="<select class=\"form-control\" name=\"codigoTecnologia\">";
	$listaTiposTecnologia[]="<option value=\"\"></option>"; 
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoTecnologia == $codigoTecnologia) {	$value="selected";	}	else	{	$value="";	}
		$listaTiposTecnologia[]="<option $value value=\"$obj->codigoTecnologia\">".($obj->nomeTecnologia)."</option>"; 
	}
	$listaTiposTecnologia[]="</select>";
}

/* Buscando Tipos de Contratos */
$FUNCOES->consulta(array ( "tabelas" => " dcd_tiposcontrato", "ordenacao" => " tipoContrato "));
if ($FUNCOES->GetLinhas()>0)
{
	$listaTiposContrato[]="<select class=\"form-control\" name=\"codigoTipoContrato\">";
	$listaTiposContrato[]="<option value=\"\"></option>"; 
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoTipoContrato == $codigoTipoContrato) {	$value="selected";	}	else	{	$value="";	}
		$listaTiposContrato[]="<option $value value=\"$obj->codigoTipoContrato\">".($obj->tipoContrato)."</option>"; 
	}
	$listaTiposContrato[]="</select>";
}

?>
