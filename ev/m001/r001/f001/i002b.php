<?
$GLOBALS["MODULOSISTEMA"]="Projetos";
$GLOBALS["DISCRICAOSISTEMA"]="Incluir Nova Frente";
/**/

$codigoProjeto		="";	If (isset($_POST["codigoProjeto"])) 	{	$codigoProjeto		= $_POST["codigoProjeto"]; 		}
$codigoFrente		="";	If (isset($_POST["codigoFrente"]))		{	$codigoFrente 		= $_POST["codigoFrente"]; 		}

$idFrente			="";	If (isset($_POST["idFrente"]))			{	$idFrente 			= $_POST["idFrente"]; 			}
$nomeFrente			="";	If (isset($_POST["nomeFrente"]))		{	$nomeFrente 		= $_POST["nomeFrente"]; 		}
$descricaoFrente 	="";	If (isset($_POST["descricaoFrente"]))	{	$descricaoFrente 	= $_POST["descricaoFrente"];	}
$codigoTipoProjeto	="";	If (isset($_POST["codigoTipoProjeto"]))	{	$codigoTipoProjeto 	= $_POST["codigoTipoProjeto"];	}
$codigoRecurso		="";	If (isset($_POST["codigoRecurso"]))		{	$codigoRecurso 		= $_POST["codigoRecurso"];		}
$codigoOrigem		="";	If (isset($_POST["codigoOrigem"]))		{	$codigoOrigem 		= $_POST["codigoOrigem"];		}
$codigoFase			="";	If (isset($_POST["codigoFase"]))		{	$codigoFase 		= $_POST["codigoFase"];			}
$codigoArea			="";	If (isset($_POST["codigoArea"]))		{	$codigoArea 		= $_POST["codigoArea"];			}

/* Busca Informações do Projeto */
$FUNCOES->consulta(array
			(
			"tabelas" 	=> " dcd_projetos",
			"condicoes" => " codigoProjeto = $codigoProjeto ",
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$nomeProjeto 		= $obj->nomeProjeto;
	$codigoProjetoPai	= $obj->codigoProjetoPai;
	if ($codigoProjetoPai <> 0) {
		$GLOBALS["DISCRICAOSISTEMA"]="Incluir Nova Frente do SubProjeto $nomeProjeto ";
	} else { 
		$GLOBALS["DISCRICAOSISTEMA"]="Incluir Nova Frente do Projeto $nomeProjeto ";
	}
}
/* Buscando Tipos de Projetos */
$listaTiposProjetos[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( "tabelas" 	=> "dcd_tiposprojeto" ) );
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoTipoProjeto == $codigoTipoProjeto) {	$value="selected";	}	else	{	$value="";	}
		$listaTiposProjetos[]="<option $value value=\"$obj->codigoTipoProjeto\">".($obj->descricaoTipo)."</option>"; 
	}
}
/**/

/* Buscando Tipos de Projetos */
$listaRecursos[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( "tabelas" 	=> "dcd_recursos" ) );
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoRecurso == $codigoRecurso) {	$value="selected";	}	else	{	$value="";	}
		$listaRecursos[]="<option $value value=\"$obj->codigoRecurso\">".($obj->usuarioRecurso)."</option>"; 
	}
}
/**/

/* Buscando Origem do Projeto */
$listaOrigemProjetos[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( "tabelas" 	=> "dcd_origemprojetos" ) );
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoOrigem == $codigoOrigem) {	$value="selected";	}	else	{	$value="";	}
		$listaOrigemProjetos[]="<option $value value=\"$obj->codigoOrigem\">".($obj->nomeOrigem)."</option>"; 
	}
}
/**/

/* Buscando Fase do Projeto */
$listaFasesProjetos[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( "tabelas" 	=> "dcd_fasesprojetos" ) );
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoFase == $codigoFase) {	$value="selected";	}	else	{	$value="";	}
		$listaFasesProjetos[]="<option $value value=\"$obj->codigoFase\">".($obj->nomeFase)."</option>"; 
	}
}
/**/

/* Buscando Area Solicitante */
$listaAreaSolicitante[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( "tabelas" 	=> "dcd_areasolicitante" ) );
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		if ($obj->codigoArea <> 1){
			if ($obj->codigoArea == $codigoArea) {	$value="selected";	}	else	{	$value="";	}
			$listaAreaSolicitante[]="<option $value value=\"$obj->codigoArea\">".($obj->nomeArea)."</option>"; 
		}
	}
}
/**/

?>