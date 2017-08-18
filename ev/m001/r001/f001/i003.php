<?
$GLOBALS["MODULOSISTEMA"]="Projetos";
$GLOBALS["DISCRICAOSISTEMA"]="Detalhes da Frente";
/**/

if (!isset($codigoProjeto)) 	{	$codigoProjeto		="";	If (isset($_POST["codigoProjeto"])) 	{	$codigoProjeto		= $_POST["codigoProjeto"]; 		} }
$codigoFrente		="";	If (isset($_POST["codigoFrente"]))		{	$codigoFrente 		= $_POST["codigoFrente"]; 		}

$nomeProjeto		="";	If (isset($_POST["nomeProjeto"])) 		{	$nomeProjeto 	= $_POST["nomeProjeto"]; 			}
$descricao			="";	If (isset($_POST["descricao"])) 		{	$descricao 		= $_POST["descricao"]; 				}

$idFrente			="";	If (isset($_POST["idFrente"]))			{	$idFrente 		= $_POST["idFrente"]; 				}
$nomeFrente			="";	If (isset($_POST["nomeFrente"]))		{	$nomeFrente 		= $_POST["nomeFrente"]; 		}
$descricaoFrente 	="";	If (isset($_POST["descricaoFrente"]))	{	$descricaoFrente 	= $_POST["descricaoFrente"];	}
$prioridadeFrente	="";	If (isset($_POST["prioridadeFrente"]))	{	$prioridadeFrente 	= $_POST["prioridadeFrente"];	}

$codigoSistema			="";
$codigoRecursoSistemas	="";
$dataAlocacao			="";
$quantidade				="";
$custo 					="";

if (!isset($cadastroSistema))
{
if (isset($_POST["codigoSistema"]))			{	$codigoSistema 			= $_POST["codigoSistema"]; 			}
if (isset($_POST["codigoRecursoSistemas"]))	{	$codigoRecursoSistemas 	= $_POST["codigoRecursoSistemas"];	}
if (isset($_POST["dataAlocacao"]))			{	$dataAlocacao 			= $_POST["dataAlocacao"];			}
if (isset($_POST["quantidade"]))			{	$quantidade 			= $_POST["quantidade"];				}
if (isset($_POST["custo"]))					{	$custo 					= $_POST["custo"];					}
}

$dataHistorico		= $FUNCOES->DataExterna($FUNCOES->DATA);	If (isset($_POST["dataHistorico"]))		{	$dataHistorico 		= $_POST["dataHistorico"];		}
$descricaoHistorico	="";
$codigoFaseHistorico="";
$codigoStatus		="";
$nomeArea			="";
$tipoPlanejamento		="";

if (!isset($cadastro)) 
{
$descricaoHistorico	="";	If (isset($_POST["descricaoHistorico"]))	{	$descricaoHistorico	= $_POST["descricaoHistorico"];	}
$codigoFaseHistorico="";	If (isset($_POST["codigoFaseHistorico"]))	{	$codigoFaseHistorico= $_POST["codigoFaseHistorico"];}
$codigoStatus		="";	If (isset($_POST["codigoStatus"]))			{	$codigoStatus		= $_POST["codigoStatus"];		}
$tipoPlanejamento	="";	If (isset($_POST["tipoPlanejamento"]))		{	$tipoPlanejamento	= $_POST["tipoPlanejamento"];	}
}
/* Busca Frentes do Projeto */
$FUNCOES->consulta(array
			(
			"campos" 	=> "p1.codigoProjeto, p1.nomeProjeto, p1.descricao, p1.codigoProjetoPai, f1.codigoFrente, f1.prioridadeFrente, f1.idFrente, f1.nomeFrente, f1.codigoStatus, f1.codigoOrigem, f1.descricaoFrente, f1.codigoTipoProjeto, o1.nomeOrigem, f1.codigoFase, f1.codigoRecurso, r1.usuarioRecurso, f2.nomeFase, m1.horasEsforco, t1.descricaoTipo, u1.nome nomeRecurso, f1.codigoArea, as1.nomeArea, f1.tipoPlanejamento ",
			"tabelas" 	=> "dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, usuarios u1, dcd_areasolicitante as1",
			"condicoes" => "p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and r1.usuarioRecurso = u1.login and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase and f1.codigoProjeto = $codigoProjeto and f1.codigoFrente = $codigoFrente and f1.codigoArea = as1.codigoArea",
			"ordenacao" => "f1.dataCadastro"
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$nomeProjeto		= $obj->nomeProjeto;
	$descricao			= $obj->descricao;
	if ($idFrente == "") 			{	$idFrente			= ($obj->idFrente); 		}
	if ($nomeFrente == "") 			{	$nomeFrente			= ($obj->nomeFrente); 		}
	if ($descricaoFrente == "") 	{	$descricaoFrente	= ($obj->descricaoFrente);	}
	if ($prioridadeFrente == "") 	{	$prioridadeFrente	= ($obj->prioridadeFrente);	}
	$codigoProjetoPai	= $obj->codigoProjetoPai;
	$codigoTipoProjeto	= $obj->codigoTipoProjeto;
	$nomeTipoProjeto	= ($obj->descricaoTipo);
	$codigoRecurso		= $obj->codigoRecurso;
	$usuarioRecurso		= ($obj->usuarioRecurso);
	$nomeRecurso		= ($obj->nomeRecurso);
	$codigoOrigem		= $obj->codigoOrigem;
	$nomeOrigem			= ($obj->nomeOrigem);
	$codigoFase			= $obj->codigoFase;
	$nomeFase			= ($obj->nomeFase);
	$codigoStatus		= $obj->codigoStatus;
	$codigoArea			= $obj->codigoArea;
	$nomeArea			= $obj->nomeArea;
	$tipoPlanejamento	= $obj->tipoPlanejamento;
}

/* Dados complementares da tela */
$GLOBALS["DISCRICAOSISTEMA"]="Projeto <a href=\"#\" style=\"font-weight: bold;\" onclick=\"executar('m001/r001/f001/loadDetalhe','aplicacao')\">$nomeProjeto</a><br/>Detalhes da Frente <font style=\"font-weight: bold;\">$nomeFrente</font>";

/* Busca Informações do Projeto Se for um SubProjeto */
if ($codigoProjetoPai <> 0){
	$GLOBALS["DISCRICAOSISTEMA"]="SubProjeto <a href=\"#\" style=\"font-weight: bold;\" onclick=\"executar('m001/r001/f001/loadDetalhe','aplicacao')\">$nomeProjeto</a><br/>Detalhes da Frente <font style=\"font-weight: bold;\">$nomeFrente</font>";
}

/* Dados do Recurso alocado para o projeto */
if ( ($FUNCOES->getPermissao(2,1,1,2,$USUARIO)) or ($usuarioRecurso == $USUARIO) ) {
	$GLOBALS["DISCRICAOSISTEMA"] .= "<br/><div style=\"margin-top: 4px;\"><font style=\"font-size: 12px;\">Recurso alocado: <a href=\"#\" onclick=\"document.aplicacao.codigoRecursoFrente.value='$codigoRecurso'; executar('m002/r001/f001/loadFrentes','aplicacao')\">$nomeRecurso</a></font></div>";
} else {
	$GLOBALS["DISCRICAOSISTEMA"] .= "<br/><div style=\"margin-top: 4px;\"><font style=\"font-size: 12px;\">Recurso alocado: $nomeRecurso</font></div>";
}
/* Prepando HTML */
$GLOBALS["DISCRICAOSISTEMA"] = "<div style=\"width:95%; float: left\">".$GLOBALS["DISCRICAOSISTEMA"]."</div>";

/* Verificad se é favorito */
$FUNCOES->consulta(array ( "tabelas" 	=> " dcd_favoritos ", "condicoes" => " codigoFrente = $codigoFrente and usuarioCadastro = '$USUARIO' " ) );
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$GLOBALS["DISCRICAOSISTEMA"] .= "<div style=\"width:5%; float: right; height: 60px\"><img src=\"./images/star_del.png\" style=\"cursor:hand; cursor:pointer; margin-top: 15px; margin-left: 10px\" name=\"img\" alt=\"Desmarcar como Favorito\" onclick=\"executar('m001/r001/f001/favorito','aplicacao')\"></div><br>";
}
else
{
	$GLOBALS["DISCRICAOSISTEMA"] .= "<div style=\"width:5%; float: right; height: 60px\"><img src=\"./images/star_add.png\" style=\"cursor:hand; cursor:pointer; margin-top: 15px; margin-left: 10px\" name=\"img\" alt=\"Marcar como Favorito\" onclick=\"executar('m001/r001/f001/favorito','aplicacao')\"></div><br>";
}
$GLOBALS["DISCRICAOSISTEMA"] .= "<br/>";

/* Dados do Historico */
If (isset($_POST["codigoTipoProjeto"]))	{	$codigoTipoProjeto 	= $_POST["codigoTipoProjeto"];	}
If (isset($_POST["codigoRecurso"]))		{	$codigoRecurso 		= $_POST["codigoRecurso"];		}
If (isset($_POST["codigoOrigem"]))		{	$codigoOrigem 		= $_POST["codigoOrigem"];		}
If (isset($_POST["codigoFase"]))		{	$codigoFase 		= $_POST["codigoFase"];			}
If (isset($_POST["codigoTipoProjeto"]))	{	$codigoTipoProjeto	= $_POST["codigoTipoProjeto"];	}
If (isset($_POST["codigoTipoSistema"]))	{	$codigoTipoSistema	= $_POST["codigoTipoSistema"];	}

/* Buscando Projetos */
$listaProjetos[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( "tabelas" 	=> " dcd_projetos ", "ordenacao" => "codigoProjeto" ) );
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoProjeto == $codigoProjeto) {	$value="selected";	}	else	{	$value="";	}
		if ($obj->codigoProjetoPai <> 0){
			$lista[$obj->codigoProjetoPai][$obj->codigoProjeto]=$obj->nomeProjeto;
		} else {
			$lista[$obj->codigoProjeto][]=$obj->nomeProjeto;
		}
	}
}
/**/
foreach ($lista as $key => $value){
	foreach ($value as $keyy => $valuee){
		if ($keyy == 0){
			If ($key == $codigoProjeto) {	$checked="selected";	}	else	{	$checked="";	}
			$listaProjetos[]="<option $checked value=\"$key\">$valuee</option>"; 
		}else {
			If ($keyy == $codigoProjeto) {	$checked="selected";	}	else	{	$checked="";	}
			$listaProjetos[]="<option $checked value=\"$keyy\">&nbsp;|_ SubProjeto $valuee</option>"; 
		}
	}
}
/**/

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

/* Buscando Recursos */
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
		$statusFaseProjeto[$obj->codigoFase]=$obj->nomeFase;
	}
}
/**/

/* Buscando Tipos de Sistemas */
$listaTiposSistemas[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( 
					"campos" 	=> " dts.codigoSistema, dts.nomeSistema, dtt.nomeTecnologia, dtc.tipoContrato",
					"tabelas" 	=> " dcd_tipossistema dts, dcd_tipostecnologia dtt, dcd_tiposcontrato dtc ",
					"condicoes"	=> " dts.codigoTecnologia = dtt.codigoTecnologia and dts.codigoContrato = dtc.codigoTipoContrato ",
					"ordenacao" => " dts.nomeSistema, dtt.nomeTecnologia "
 					) 
 				);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		If ($obj->codigoSistema == $codigoSistema) {	$value="selected";	}	else	{	$value="";	}
		$listaTiposSistemas[]="<option $value value=\"$obj->codigoSistema\">".($obj->nomeSistema)."</option>"; 
	}
}
/**/

/* Array Tipos de Sistemas */
unset($arrayTiposSistemas); $qnt = 0; 
$FUNCOES->consulta(array ( 
					"campos" 	=> " dts.nomeSistema, dtt.nomeTecnologia, dtc.tipoContrato",
					"tabelas" 	=> " dcd_tipossistema dts, dcd_tipostecnologia dtt, dcd_tiposcontrato dtc ",
					"condicoes"	=> " dts.codigoTecnologia = dtt.codigoTecnologia and dts.codigoContrato = dtc.codigoTipoContrato ",
					"ordenacao" => " dts.nomeSistema, dtt.nomeTecnologia "
 					) 
 				);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$qnt = $qnt+1;
		$arrayTiposSistemas[$qnt]['nomeTecnologia'] = $obj->nomeTecnologia;
		$arrayTiposSistemas[$qnt]['tipoContrato'] 	= $obj->tipoContrato;
	}
}
/**/

/* Buscando Recursos */
$listaRecursosSistemas[]="<option value=\"\"></option>"; 
$FUNCOES->consulta(array ( 
					"tabelas" 	=> " dcd_recursosistemas ",
					"ordenacao" => " nomeRecurso "
 					) 
 				);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		if ($obj->codigoRecursoSistemas == $codigoRecursoSistemas) {	$value="selected";	}	else	{	$value="";	}
		$listaRecursosSistemas[]="<option $value value=\"$obj->codigoRecursoSistemas\">".($obj->nomeRecurso)."</option>"; 
	}
}
/**/

/* Buscando Status */
$statusProjeto[]="";		$statusProjeto[]="Em andamento"; 	$statusProjeto[]="Parado"; 	$statusProjeto[]="Cancelado"; 
foreach ($statusProjeto as $key => $value)
{
	If ($key == $codigoStatus) {	$st="selected";	}	else	{	$st="";	}
	$listaStatusProjetos[]="<option $st value=\"$key\">".$value."</option>"; 
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
		$statusAreaSolicitante[$obj->codigoArea]=$obj->nomeArea;
	}
}
/**/

/* Buscando Marcos do Projeto */
$FUNCOES->consulta(array ( 
					"campos"	=> " fp.nomeFase, fp.codigoFase, mf.dataInicioMarco, mf.dataFimMarco, mf.codigoMarco, mf.usuarioCadastro, mf.dataCadastro", 
					"tabelas" 	=> " dcd_fasesprojetos fp left join dcd_marcofrente mf on fp.codigoFase = mf.codigoFase and mf.codigoFrente = $codigoFrente",
					"ordenacao"	=> " fp.codigoFase, mf.codigoMarco desc "
					)
				);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		if ($obj->dataInicioMarco 	<> "") { $dataInicioMarco	= $FUNCOES->dataExterna($obj->dataInicioMarco); 	} else { $dataInicioMarco 	= "TBD"; }
		if ($obj->dataFimMarco 		<> "") { $dataFimMarco		= $FUNCOES->dataExterna($obj->dataFimMarco); 	} else { $dataFimMarco 		= "TBD"; }
		if ($obj->dataCadastro 		<> "") { $dataCadastro		= $FUNCOES->dataExterna($obj->dataCadastro); } else { $dataCadastro 		= ""; }
		$listaMarcoProjeto[$obj->nomeFase][]=$obj->codigoFase."#".$dataInicioMarco."#".$dataFimMarco."#".$obj->codigoMarco."#".$obj->usuarioCadastro."#".$dataCadastro;
	}
}

$marcoProjeto[]="
	<table class=\"table table-striped table-condensed\">
	<tbody>
	<tr>
		<th style=\"width:20%\">Fase</th>
		<th style=\"width:40%\" colspan=\"2\">Data Inicio</th>
		<th style=\"width:40%\" colspan=\"2\">Data Fim</th>
	</tr>";

$linhas=0;
foreach($listaMarcoProjeto as $key => $value){
	/**/
	$linhas = $linhas+1;
	if ($linhas == 1){
		$marcoProjeto[]="
		<tr>
		";
	}
	list($LMPcodigoFase, $LMPdataInicioMarco, $LMPdataFimMarco, $LMPcodigoMarco, $LMPusuarioCadastro, $LMPdataCadastro)  = explode("#",$listaMarcoProjeto[$key][0]);
	$LMPdataMarcoInicio2="TBD"; $LMPdataMarcoFim2="TBD"; $LMPcodigoMarco2 = ""; $LMPdataInicioMarco2=""; $LMPdataFimMarco2="";
	if (isset($listaMarcoProjeto[$key][1])){
		list($LMPcodigoFase2, $LMPdataInicioMarco2, $LMPdataFimMarco2,$LMPcodigoMarco2, $LMPusuarioCadastro2, $LMPdataCadastro2) = explode("#",$listaMarcoProjeto[$key][1]);
	}
	if ( ($LMPdataInicioMarco2 == "TBD")or ($LMPdataInicioMarco2 == "") )  	{ $LMPdataInicioMarco2="";	} else { $LMPdataInicioMarco2	=" <small title=\"Ajustado por $LMPusuarioCadastro2 em $LMPdataCadastro2 \"><s>($LMPdataInicioMarco2)</s></small> ";}
	if ( ($LMPdataFimMarco2 == "TBD") 	or ($LMPdataFimMarco2 == "") )  	{ $LMPdataFimMarco2="";		} else { $LMPdataFimMarco2		=" <small title=\"Ajustado por $LMPusuarioCadastro2 em $LMPdataCadastro2 \"><s>($LMPdataFimMarco2)</s></small> "; 	}
	if ($LMPcodigoFase == $codigoFase) { $negrito="font-weight: bold"; } else { $negrito=""; }
	if ($LMPdataInicioMarco == "") 	{ $LMPdataInicioMarco="TBD";}
	if ($LMPdataFimMarco == "") 	{ $LMPdataFimMarco="TBD"; 	}
	if (isset($_POST["dataInicioMarco".$LMPcodigoFase])){ $dataInicioMarco 	= $_POST["dataInicioMarco".$LMPcodigoFase]; }
	if (isset($_POST["dataFimMarco".$LMPcodigoFase])) 	{ $dataFimMarco 	= $_POST["dataFimMarco".$LMPcodigoFase]; 	}
	if (isset($listaMarcoDtInvalido[$LMPcodigoFase.'ini'])) { $erro1="border-color: #A94442;"; } else { $erro1=""; }
	if (isset($listaMarcoDtInvalido[$LMPcodigoFase.'fin'])) { $erro2="border-color: #A94442;"; } else { $erro2=""; }
	
	$marcoProjeto[]="
			<td width=\"20%\" style=\"$negrito\">$key</td>
			<td width=\"20%\"><input class=\"form-control\" id=\"data\" style=\"$erro1\" name=\"dataInicioMarco$LMPcodigoFase\" size=\"11\" maxlength=\"10\" type=\"text\" value=\"".$LMPdataInicioMarco."\"></td>
			<td width=\"10%\" style=\"vertical-align: inherit;\">".$LMPdataInicioMarco2."</td>
			<td width=\"20%\"><input class=\"form-control\" id=\"data\" style=\"$erro2\" name=\"dataFimMarco$LMPcodigoFase\" size=\"11\" maxlength=\"10\" type=\"text\" value=\"".$LMPdataFimMarco."\"></td>
			<td width=\"10%\" style=\"vertical-align: inherit;\">".$LMPdataFimMarco2."</td>
		";
	if ($linhas == 1){
		$linhas = 0;
		$marcoProjeto[]="
		</tr>
		<!--tr-->
		";
	}
}

$checkedPlanejado= '';
$checkedPrevisto = 'checked';
if ($tipoPlanejamento){
	$checkedPlanejado = 'checked';
	$checkedPrevisto = '';
}

$marcoProjeto[]="
		<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>
			<div class=\"input-group\" style=\"width: 95%; float: left;\">
				<span class=\"input-group-addon\"><input type=\"radio\" name=\"tipoPlanejamento\" value=\"0\" $checkedPrevisto ></span>
				<span class=\"form-control\">Previsto</span>
				<span class=\"input-group-addon\"><input type=\"radio\" name=\"tipoPlanejamento\" value=\"1\" $checkedPlanejado ></span>
				<span class=\"form-control\">Planejado</span>
			</div>
			<div style=\"float: right; margin-top: 9px;\">
			<img src=\"./images/update.png\" alt=\"Atualizar\" style=\"cursor: pointer;\" onclick=\"executar('m001/r001/f001/atualizarTipoPlanejamento','aplicacao')\">
			</div>
		</td><td>&nbsp;</td>
		</tr>
	</tbody>
	</table>";
/**/

/* Historico do Projeto */ 

$listaHistorico[]="
				<table id=\"tabela\" class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th style=\"width:10%\">Data</th>
					<th style=\"width:70%\">Descri&ccedil;&atilde;o</th>
					<th style=\"width:20%\">Fase</th>
				</tr>
				<tr>
					<th><input type=\"text\" id=\"txtColuna1\"></th>
					<th><input type=\"text\" id=\"txtColuna2\"></th>
					<th><input type=\"text\" id=\"txtColuna3\"></th>
				</tr>
				</thead>
				<tbody>";

$FUNCOES->consulta(array
			(
			"campos" 	=> " dataHistorico, codigoFrente, descricaoHistorico, f1.nomeFase, o1.nomeOrigem, h1.codigoStatus, t1.descricaoTipo, r1.usuarioRecurso, h1.usuarioCadastro, h1.dataCadastro, h1.horaCadastro",
			"tabelas" 	=> " dcd_historico h1 left join dcd_tiposprojeto t1 ON h1.codigoTipoProjeto = t1.codigoTipoProjeto left join dcd_recursos r1 ON h1.codigoRecurso = r1.codigoRecurso left join dcd_origemprojetos o1 ON h1.codigoOrigem = o1.codigoOrigem left join dcd_fasesprojetos f1  ON h1.codigoFase = f1.codigoFase ",
			"condicoes"	=> " h1.codigoFrente = $codigoFrente ",
			"ordenacao" => " h1.dataHistorico desc, h1.horaCadastro desc "
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		if ($obj->nomeFase 		== "") { $nf = $nomeFase;	}	else { $nf = "<b>$obj->nomeFase</b>";	}
		/**/
		if ($obj->nomeFase 		<> "") { $arrayMsn[]="Fase do Projeto"; 	}
		if ($obj->nomeOrigem 	<> "") { $arrayMsn[]="Origem do Projeto"; 	}
		if ($obj->descricaoTipo	<> "") { $arrayMsn[]="Tipo do Projeto"; 	}
		if ($obj->codigoStatus	<> 0 ) { $arrayMsn[]="Status do Projeto"; 	}
		if ($obj->usuarioRecurso<> "") { $arrayMsn[]="Recurso do Projeto"; 	}
		/**/
		$complementoMsn="";
		if (isset($arrayMsn)) {
			$complementoMsn.="<font size=\"2\">[Alterações da Frente: "; $i=0;
			foreach($arrayMsn as $value){ 
				$i=$i+1;
				$complementoMsn .= $value;
				if ($i < count($arrayMsn) ){
					$complementoMsn .= ", ";
				}
			}
			$complementoMsn.=" ]</font>";
			$complementoMsn = "<br><br>".$complementoMsn;
		}
		/**/
		$qnt=$qnt+1;
		$listaHistorico[]="
				<tr title=\"Historico Cadastrado em ".$FUNCOES->DataExterna($obj->dataCadastro)." as $obj->horaCadastro por $obj->usuarioCadastro\">
					<td style=\"vertical-align: middle;\">".$FUNCOES->DataExterna($obj->dataHistorico)."</td>
					<td>".$obj->descricaoHistorico."$complementoMsn</td>
					<td style=\"vertical-align: middle;\">".($nf)."</td>
				</tr>";
		unset($arrayMsn);
	}
}

$listaHistorico[]="
				</table>";

/* */

/* Sistemas do Projeto */ 
$edit = 0;
if ($FUNCOES->getPermissao(1,1,1,2,$USUARIO) & ( ($usuarioRecurso==$USUARIO) or  ($USUARIO=="SUPORTE") or $FUNCOES->getPermissao(1,1,1,3,$USUARIO) ) ) {
	$edit = 1;
}

$listaSistemas[]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th style=\"width:15%\">Recurso</th>
					<th style=\"width:25%\">Sistema</th>
					<th style=\"width:10%\">Alocação</th>
					<th style=\"width:15%\">Quantidade Horas</th>
					<th style=\"width:15%\">Custo</th>
					<th style=\"width:15%\">CAP</th>
					<th style=\"width:5%\">&nbsp</th>
				</tr>
				</thead>
				<tbody>";

$FUNCOES->consulta(array
			(
			"campos" 	=> " ds.codigoSistema, ds.dataAlocacao, dts.nomeSistema, dtt.nomeTecnologia, dtc.tipoContrato, ds.custo, ds.quantidade, drs.nomeRecurso, ds.dataCadastro, ds.horaCadastro, ds.usuarioCadastro, ds.num_linha_cap ",
			"tabelas" 	=> " dcd_sistemas ds, dcd_tipossistema dts, dcd_tipostecnologia dtt, dcd_tiposcontrato dtc, dcd_recursosistemas drs ",
			"condicoes"	=> " ds.codigoFrente = $codigoFrente and ds.codigoRecursoSistemas = drs.codigoRecursoSistemas and ds.codigoTipoSistema = dts.codigoSistema and dts.codigoTecnologia = dtt.codigoTecnologia and dts.codigoContrato = dtc.codigoTipoContrato ",
			"ordenacao" => " ds.dataAlocacao, dts.nomeSistema, dtt.nomeTecnologia "
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$qnt = 0; $custoTT = 0; $horaTT = 0; setlocale(LC_MONETARY,"pt_BR", "ptb");
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		$custoTT = $custoTT + $obj->custo; $horaTT = $horaTT + $obj->quantidade;
		$listaSistemas[]="
				<tr  title=\"Cadastrado em ".$FUNCOES->dataExterna($obj->dataCadastro)." as $obj->horaCadastro por $obj->usuarioCadastro \">
					<td>$obj->nomeRecurso</td>
					<td>$obj->nomeSistema</td>
					<td>".substr($FUNCOES->dataExterna($obj->dataAlocacao), 3)."</td>
					<td style=\"text-align: right;\">".$FUNCOES->formataValor($obj->quantidade)."</td>
					<td style=\"text-align: right;\">R$ ".$FUNCOES->formataValor($obj->custo)."</td>
					<td>".$obj->num_linha_cap."</td>
					<td>".($edit?"<img src=\"./images/banlist_16.png\" style=\"text-align: center; cursor:hand; cursor:pointer;\" name=\"img\" alt=\"Excluir Sistema Impactado\" onclick=\"document.aplicacao.codigoSistemaImpactado.value=".$obj->codigoSistema."; executar('m001/r001/f001/excluirSistema','aplicacao')\">":" ")."</td>
				</tr>";
		/**/
	}
	$listaSistemas[]="
				<tr>
					<td colspan=\"3\">&nbsp;</td>
					<td style=\"text-align: right; font-weight: bold;\">".$FUNCOES->formataValor($horaTT)."</td>
					<td style=\"text-align: right; font-weight: bold;\">R$ ".$FUNCOES->formataValor($custoTT)."</td>
					<td>&nbsp;</td>
				</tr>";
}

if ($edit)
{
	$selectSistemas  	 = "<select class=\"form-control\" name=\"codigoSistema\" onChange=\"carregaSistemas(this.value)\" >";
	if (isset($listaTiposSistemas)){  foreach($listaTiposSistemas as $value) { $selectSistemas .= $value; }	}
	$selectSistemas 	.= "</select>";

	$selectRecursos   	 = "<select class=\"form-control\" name=\"codigoRecursoSistemas\" >";
	if (isset($listaRecursosSistemas)){  foreach($listaRecursosSistemas as $value) { $selectRecursos .= $value; }	}
	$selectRecursos 	.= "</select>";

	$periodosAlocacao 	 = "<select class=\"form-control\" name=\"dataAlocacao\" ><option value=\"\"></option>";
	for ( $mesAtual = -3; $mesAtual < 6; $mesAtual++ ) {
		$mes 		= substr(date('Y-m-d', strtotime($mesAtual.' months', strtotime(date('Y-m-d')))), 0, -2)."01";
		$mesVisual 	= date('m/Y', strtotime($mesAtual.' months', strtotime(date('Y-m-d'))));
		if ($mes == $dataAlocacao) { $value="selected";	} else { $value="";	}
		$periodosAlocacao .= "<option $value value=\"$mes\">".$mesVisual."</option>";
	}
	$periodosAlocacao 	.= "</select>";

	$listaSistemas[]="
			<tr>
				<td>$selectRecursos</td>
				<td>$selectSistemas</td>
				<td>$periodosAlocacao</td>
				<td><input class=\"form-control\" id=\"valor1\" name=\"quantidade\" size=\"11\" maxlength=\"20\" type=\"text\" value=\"$quantidade\"></td>
				<td><input class=\"form-control\" id=\"valor2\" name=\"custo\" size=\"11\" maxlength=\"20\" type=\"text\" value=\"$custo\"></td>
				<td>&nbsp;</td>
				<td><img src=\"./images/mini-check.gif\" style=\"text-align: center; cursor:hand; cursor:pointer;\" name=\"img\" alt=\"Incluir Sistema Impactado\" onclick=\"executar('m001/r001/f001/cadastrarSistema','aplicacao')\"></td>
			</tr>";
}

$listaSistemas[]="
				</table>";

/* */

?>