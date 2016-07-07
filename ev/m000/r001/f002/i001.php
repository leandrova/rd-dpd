<?

$listaTopMais[]="
	<table style=\"width:100%;\" id=\"tabela\" class=\"table table-striped table-hover table-condensed\">
	<thead style=\"font-size: 14px;\">
		<tr>
			<th style=\"width:90%\">Nome do Projeto</th>
			<th style=\"width:10%\">N&deg; Hist</th>
		</tr>
	</thead>
	<tbody style=\"font-size: 14px;\">";

$FUNCOES->consulta(array
		(
			"campos" 	=> " df.codigoProjeto, df.codigoFrente, df.nomeFrente, count(1) quantidade ",
			"tabelas" 	=> " dcd_frentes df, dcd_historico dh ",
			"condicoes" => " df.codigoRecurso in (select codigoRecurso from dcd_recursos where usuarioRecurso = '$USUARIO') and df.codigoFrente = dh.codigoFrente ",
			"agrupamento" => " df.codigoProjeto, df.codigoFrente, df.nomeFrente ",
			"ordenacao" => " 4 desc ",
			"limite"	=> " 5 "
		)
	);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		if (strlen($obj->nomeFrente)>80) { $ponto="..."; } else { $ponto=""; }
$listaTopMais[]="
		<tr title=\"$obj->nomeFrente\"style=\"cursor: pointer;\" onclick=\"document.aplicacao.codigoProjeto.value='$obj->codigoProjeto'; document.aplicacao.codigoFrente.value='$obj->codigoFrente'; executar('m001/r001/f001/loadFrente','aplicacao')\">
			<td>".substr($obj->nomeFrente,0,80).$ponto."</td>
			<td style=\"text-align:right\">".($obj->quantidade)."</td>
		</tr>";
	}
}
/**/
$listaTopMais[]="
	</tbody>
	</table>";
	
$listaTopFavoritos[]="
	<table style=\"width:100%;\" id=\"tabela\" class=\"table table-striped table-hover table-condensed\">
	<thead style=\"font-size: 14px;\">
		<tr>
			<th style=\"width:90%\">Nome do Projeto</th>
			<th style=\"width:10%\">Ult. Atua.</th>
		</tr>
	</thead>
	<tbody>";

$FUNCOES->consulta(array
		(
			"campos" 	=> " df.codigoProjeto, df.codigoFrente, df.nomeFrente, max(dh.dataHistorico) data ",
			"tabelas" 	=> " dcd_frentes df, dcd_historico dh, dcd_favoritos dfv ",
			"condicoes" => " dfv.usuarioCadastro = '$USUARIO' and df.codigoStatus = 1 and df.codigoFase <> 11 and df.codigoFrente = dfv.codigoFrente and df.codigoFrente = dh.codigoFrente ",
			"agrupamento" => " df.codigoProjeto, df.codigoFrente, df.nomeFrente ",
			"ordenacao" => " 4 desc",
			"limite"	=> " 5 "
		)
	);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		if (strlen($obj->nomeFrente)>80) { $ponto="..."; } else { $ponto=""; }
$listaTopFavoritos[]="
		<tr style=\"cursor: pointer;\" onclick=\"document.aplicacao.codigoProjeto.value='$obj->codigoProjeto'; document.aplicacao.codigoFrente.value='$obj->codigoFrente'; executar('m001/r001/f001/loadFrente','aplicacao')\">
			<td title=\"".$obj->nomeFrente."\">".substr($obj->nomeFrente,0,80).$ponto."</td>
			<td style=\"text-align:right\">".$FUNCOES->dataExterna($obj->data)."</td>
		</tr>";
	}
}
/**/
$listaTopFavoritos[]="
	</tbody>
	</table>";

/* Esforço */

$FUNCOES->consulta(array
		(
			"campos" 	=> " concat(round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100)) produtidadeMes, (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtual, (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturo ",
			"tabelas" 	=> " dcd_recursos r1, usuarios u1, dcd_cargos c1  ",
			"condicoes" => " r1.usuarioRecurso = u1.login and r1.codigoCargo = c1.codigoCargo and codigoRecurso in (select codigoRecurso from dcd_recursos where usuarioRecurso = '$USUARIO')  "
		)
	);
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$horas = $obj->produtidadeMes;
	$horasAtual = substr($obj->esforcoAtual,0,(strlen($obj->esforcoAtual)-4));
	$horasFutura = substr($obj->esforcoFuturo,0,(strlen($obj->esforcoFuturo)-4));
	$dadosAlocacao = "[$horas,$horasAtual,$horasFutura]";
}
else
{
	$horas = 0;
	$horasAtual = 0;
	$horasFutura = 0;
	$dadosAlocacao = 0;
}
/* Projetos */

$FUNCOES->consulta(array
		(
			"campos" 	=> " sp.descricaoStatus, count(1) qntFrentes ",
			"tabelas" 	=> " dcd_frentes df, dcd_statusprojeto sp ",
			"condicoes" => " df.codigoStatus <> 3 and df.codigoStatus = sp.codigoStatus and codigoRecurso in (select codigoRecurso from dcd_recursos where usuarioRecurso = '$USUARIO') and codigoFase <> 11 ",
			"agrupamento" => " sp.descricaoStatus ",
			"ordenacao" => " 1 "
		)
	);
if ($FUNCOES->GetLinhas()>0)
{
	$dadosProjetos = "["; $qnt=0;
	$listaProjetos["Em Andamento"] = 0;
	$listaProjetos["Parada"] = 0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		if ($qnt>0) { $dadosProjetos.=","; }
		$dadosProjetos .= $obj->qntFrentes;
		$listaProjetos[$obj->descricaoStatus]=$obj->qntFrentes;
		$qnt=$qnt+1;
	}
	$dadosProjetos.= ",".($listaProjetos["Em Andamento"]+$listaProjetos["Parada"]);
	$dadosProjetos.= "]";
}
else
{
	$dadosProjetos = 0;
	$listaProjetos["Total"]=0;
	$listaProjetos["Em Andamento"]=0;
	$listaProjetos["Parada"]=0;
}
	
	
?>