<?
$GLOBALS["MODULOSISTEMA"]="Frentes do Recurso";
$GLOBALS["DISCRICAOSISTEMA"]="Lista Frentes";
/**/
if (!isset($codigoRecurso)) 	{
$codigoRecurso		="";	If (isset($_POST["codigoRecurso"])) 	{	$codigoRecurso 	= $_POST["codigoRecurso"]; 	}
}

if (isset($_POST["codigoRecursoFrente"])){
	if ($_POST["codigoRecursoFrente"]<>"") { $codigoRecurso 	= $_POST["codigoRecursoFrente"];}
}

$filtro		="";	If (isset($_POST["filtro"])) 		{	$filtro 	= $_POST["filtro"]; 	}
/**/

/**/
$FUNCOES->consulta(
			array ( 
				"tabelas" 	=> " dcd_recursos, usuarios ", 
				"condicoes"	=> " login = usuarioRecurso and codigoRecurso = $codigoRecurso "
			) 
		);
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$nomeRecurso = $obj->nome;
}
$GLOBALS["DISCRICAOSISTEMA"] .= " do Recurso $nomeRecurso ";

/* Dados de Capacidade */
$FUNCOES->consulta(array
			(
			"campos" 	=> "r1.codigoRecurso, 
							u1.nome, 
							c1.descricaoCargo, 
							c1.deflatorCargo, 
							(select dadoParametro from dcd_parametros where descricaoParametro='horasMes') horasMes, 
							time_format(concat(round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100),'0000'), '%H:%i:%s') produtidadeMes, 
							(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from 	dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 10 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtual, 
							(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from 	dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 10 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturo, 
							round( ( (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 10 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) / concat(round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100),'0000') )* 100) percentualMes,
							(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from dcd_frentes f1, dcd_memoriaprojetos m1 where	f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtualTotal,
							round( ( (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 10 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) / concat(round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100),'0000') )* 100) percentualFuturo,
							(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturoTotal, 
							(select count(1) from dcd_frentes where codigoRecurso = r1.codigoRecurso and codigoFase <> 10) numeroFrentes",
			"tabelas" 	=> "dcd_recursos r1, usuarios u1, dcd_cargos c1",
			"condicoes" => "r1.usuarioRecurso = u1.login and r1.codigoCargo = c1.codigoCargo and codigoRecurso = $codigoRecurso "
			)
		);
		
if ($FUNCOES->GetLinhas()>0)
{
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	if ($obj->percentualMes 	> 100) { $color="red"; 	} else { $color=""; 	}
	if ($obj->percentualFuturo 	> 100) { $color2="red"; } else { $color2=""; 	}
	$GLOBALS["DISCRICAOSISTEMA"] .= "<br><font style=\"font-size: 12px;\">Ocupação Atual: $obj->esforcoAtual</font><font style=\"font-size: 12px;color: $color;\"> ($obj->percentualMes%)</font>&nbsp;<font style=\"font-size: 12px;\">Ocupação Futura: $obj->esforcoFuturo</font><font style=\"font-size: 12px;color: $color2;\"> ($obj->percentualFuturo%)</font>";
}

/* Tipos de Filtro */
$filtroQuery="";
if (is_array($filtro))	{
	foreach ($filtro as $key => $value){
		$filtroBusca[$value]="";
		if (count($filtro)>1) { $condicao=" or "; } else { $condicao=" and "; }
		if ($value == 1 or $value == 2 or $value == 3){ /* "Em andamento" "Parada" "Cancelada" */
			if ($filtroQuery<>""){
				$filtroQuery.= " $condicao f1.codigoStatus = $value ";
			} else{
				$filtroQuery.= " f1.codigoStatus = $value ";
			}
		}
		if ($value == 9){ /* "Concluido" */
			if ($filtroQuery<>""){
				$filtroQuery.= " $condicao f1.codigoFase = 10 "; 
			} else{
				$filtroQuery.= " f1.codigoFase = 10 "; 
			}
		}
	}
} else {
	$filtroQuery=" f1.codigoStatus = 1 ";
	$filtroBusca[1]="";
}
if (count($filtro)>1) {
	If (!isset($filtroBusca[9])) {
		$filtroQuery = " and ( $filtroQuery ) and f1.codigoFase <> 10 ";
	}else {
		$filtroQuery = " and ( $filtroQuery ) ";
	}
} elseif (count($filtro)==1){
	If (!isset($filtroBusca[9])) {
		$filtroQuery = " and $filtroQuery and f1.codigoFase <> 10 ";
	} else {
		$filtroQuery = " and $filtroQuery ";
	}
}

/* Buscando Tipos de Projetos */
$qnt=0;
$FUNCOES->consulta(array ( "tabelas" 	=> " dcd_statusprojeto " ) );
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{	
		$qnt = $qnt+1;
		If (isset($filtroBusca[$obj->codigoStatus])) {	$checked="checked";	}	else	{	$checked="";	}
		$listaFiltro[]="&nbsp;<input $checked type=\"checkbox\" name=\"filtro[]\" id=\"radio$qnt\" value=\"$obj->codigoStatus\" class=\"css-checkbox\" /><label for=\"radio$qnt\" class=\"css-label radGroup2\">$obj->descricaoStatus</label>";
	}
}
If (isset($filtroBusca[9])) {	$checked="checked";	}	else	{	$checked="";	}
$qnt=$qnt+1; $listaFiltro[]="&nbsp;<input $checked type=\"checkbox\" name=\"filtro[]\" id=\"radio$qnt\" value=\"9\" class=\"css-checkbox\" /><label for=\"radio$qnt\" class=\"css-label radGroup2\">Concluido</label>";
/**/
/* Busca Frentes do Projeto */
$listaTabela[]="
				<table id=\"tabela\" class=\"table table-striped table-hover table-condensed\">
				<thead>
				<tr>
					<th style=\"width:10%\">Nome do Projeto</th>
					<th style=\"width:20%\">Nome da Frente</th>
					<th>Tipo</th>
					<th>Fase</th>
					<th>Esfor&ccedil;o</th>
					<th>OG</th>
					<th>Ult.Atua.</th>
					<th>Release</th>
				</tr>
				<tr>
					<th><input type=\"text\" id=\"txtColuna1\"></th>
					<th><input type=\"text\" id=\"txtColuna2\"></th>
					<th><input type=\"text\" id=\"txtColuna3\"></th>
					<th><input type=\"text\" id=\"txtColuna4\"></th>
					<th><input type=\"text\" id=\"txtColuna5\"></th>
					<th><input type=\"text\" id=\"txtColuna6\"></th>
					<th><input type=\"text\" id=\"txtColuna7\"></th>
					<th><input type=\"text\" id=\"txtColuna8\"></th>
				</tr>
				</thead>
				<tbody>";
$FUNCOES->consulta(array
			(
			"campos" 	=> "p1.codigoProjeto, 
							p1.codigoProjetoPai, 
							p1.nomeProjeto, 
							p1.descricao, 
							f1.codigoStatus, 
							s1.esforcoAlocado, 
							s1.descricaoStatus, 
							f1.codigoFrente, 
							f1.prioridadeFrente, 
							f1.idFrente, 
							f1.nomeFrente, 
							f1.descricaoFrente, 
							o1.nomeOrigem, 
							r1.usuarioRecurso, 
							f2.nomeFase, 
							m1.horasEsforco, 
							t1.descricaoTipo,
							f1.codigoFase,
							(select max(dataHistorico) from dcd_historico where	codigoFrente = f1.codigoFrente) ultimaAtualizacao,
							(select dataInicioMarco from dcd_marcofrente where codigoFrente = f1.codigoFrente and codigoFase = 8 order by codigoMarco desc limit 1) dataRelease ",
			"tabelas" 	=> " dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1 ",
			"condicoes" => " f1.codigoRecurso = $codigoRecurso $filtroQuery and f1.codigoStatus = s1.codigoStatus and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase",
			"ordenacao" => " 20, p1.nomeProjeto, f1.nomeFrente, f1.dataCadastro"
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		$comentario = ""; $prio = "";
		if ($obj->esforcoAlocado <> 1) 		{ $comentario	.=" <strong style=\"font-size: 10; color: red;\">[Fentre $obj->descricaoStatus]</strong>"; 	}
		if ($obj->codigoFase == 10) 		{ $comentario	.=" <strong style=\"font-size: 10; color: red;\">[Fentre Concluida]</strong>"; 				} 
		if ($obj->prioridadeFrente > 0 	) 	{ $prio 		 ="&nbsp<font style='font-weight: bold;'>#".$obj->prioridadeFrente."</font>"; 		}
		$qnt=$qnt+1;
		if (isset($somaEsforço[$obj->nomeFase])) { $somaEsforço[$obj->nomeFase] = $somaEsforço[$obj->nomeFase] + $obj->horasEsforco; } else { $somaEsforço[$obj->nomeFase] = $obj->horasEsforco+0; }
		if ($obj->codigoProjetoPai <> 0 ) { $icone="<img src=\"./images/folder_closed.png\" style=\"width:18px;\">&nbsp;"; } else { $icone=""; }
		$listaTabela[]="
				<tr style=\"cursor: pointer;\" onclick=\"document.aplicacao.codigoProjeto.value='$obj->codigoProjeto'; document.aplicacao.codigoFrente.value='$obj->codigoFrente'; executar('m001/r001/f001/loadFrente','aplicacao')\">
					<td>$icone".($obj->nomeProjeto)."</td>
					<td>".($obj->idFrente)." - ".($obj->nomeFrente)."$prio<br>$comentario</td>
					<td>".($obj->nomeOrigem)."</td>
					<td>".($obj->nomeFase)."</td>
					<td>".($obj->horasEsforco)."</td>
					<td>".($obj->descricaoTipo)."</td>
					<td>".($FUNCOES->DataExterna($obj->ultimaAtualizacao))."</td>
					<td>".($FUNCOES->DataExterna($obj->dataRelease))."</td>
				</tr>";
	}
}
$listaTabela[]="
				</tbody>
				</table>";

/* Monta Totalizadores */
$listaTotalizadores[]="
		<table class=\"table table-striped table-condensed\">
		<tbody>";

$FUNCOES->consulta(array
			(
			"campos" 	=> " f2.nomeFase, time_format(sum(m1.horasEsforco), '%H:%i:%s') somaEsforco ",
			"tabelas" 	=> " dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1  ",
			"condicoes" => " f1.codigoRecurso = $codigoRecurso $filtroQuery and f1.codigoStatus = s1.codigoStatus and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase group by f2.nomeFase",
			"ordenacao" => " m1.codigoFase "
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		$listaTotalizadores[]="
				<tr>
					<td>".($obj->nomeFase)."</td>
					<td align=\"right\">".($obj->somaEsforco)."</td>
				</tr>";
	}
}

$FUNCOES->consulta(array
			(
			"campos" 	=> " time_format(sum(m1.horasEsforco), '%H:%i:%s') somaEsforco ",
			"tabelas" 	=> " dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1  ",
			"condicoes" => " f1.codigoRecurso = $codigoRecurso $filtroQuery and f1.codigoStatus = s1.codigoStatus and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase",
			"ordenacao" => " m1.codigoFase "
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		$listaTotalizadores[]="
				<tr>
					<td><b>Total Geral do Esforço</b></td>
					<td align=\"right\"><b>".($obj->somaEsforco)."</b></td>
				</tr>";
	}
}
$listaTotalizadores[]="
		</tbody>
		</table>";
?>