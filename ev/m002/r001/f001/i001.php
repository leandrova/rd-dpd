<?
$GLOBALS["MODULOSISTEMA"]="Recursos";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Recursos";
/**/
$listaTabela[]="
				<table class=\"table table-striped table-hover table-condensed\">
				<thead>
				<tr>
					<th>Nome</th>
					<th>Cargo</th>
					<th>Horas M&ecirc;s</th>
					<th>Ocupa&ccedil;&atilde;o Atual</th>
					<th>Ocupa&ccedil;&atilde;o Futura</th>
					<th>N&deg; Frentes</th>
				</tr>
				</thead>
				<tbody>";

$per=0; 
if ($FUNCOES->getPermissao(2,1,1,2,$USUARIO)) { 
	$per=1; $condicao=" and codigoRecurso in (select codigoRecurso from dcd_recursos where statusRecurso = 1) "; 
} else { 
	$condicao = " and codigoRecurso in (select codigoRecurso from dcd_recursos where usuarioRecurso = '$USUARIO') ";
}
$FUNCOES->consulta(array
			(
			"campos" => "r1.codigoRecurso, u1.nome, c1.descricaoCargo, c1.deflatorCargo, 
						(select dadoParametro from dcd_parametros where descricaoParametro='horasMes') horasMes, 
						time_format(concat(round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100),'0000'), '%H:%i:%s') produtidadeMes, 
						(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from 	dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 11 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtual, 
						(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from 	dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 11 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturo, 
						round( ( (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 11 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) / concat(round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100),'0000') )* 100) percentualMes,
						(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from dcd_frentes f1, dcd_memoriaprojetos m1 where	f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtualTotal,
						round( ( (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoFase <> 11 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) / concat(round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100),'0000') )* 100) percentualFuturo,
						(select time_format(sum(m1.horasEsforco), '%H:%i:%s') from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturoTotal, 
						(select count(1) from dcd_frentes where codigoRecurso = r1.codigoRecurso and codigoStatus = 1 and codigoFase <> 11) numeroFrentes ",
			"tabelas" => "dcd_recursos r1, usuarios u1, dcd_cargos c1",
			"condicoes" => "r1.usuarioRecurso = u1.login and r1.codigoCargo = c1.codigoCargo $condicao ",
			"ordenacao" => "c1.descricaoCargo desc, u1.nome"
			)
		);
		
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		if ($obj->percentualMes 	> 100) { $color="red"; } 	else { $color=""; 	}
		if ($obj->percentualFuturo 	> 100) { $color2="red"; } 	else { $color2=""; 	}
		$qnt=$qnt+1;
		$listaTabela[]="
				<tr style=\"cursor:hand\" onclick=\"document.aplicacao.codigoRecurso.value='$obj->codigoRecurso'; executar('m002/r001/f001/loadFrentes','aplicacao')\">
					<td>".($obj->nome)."</td>
					<td>".($obj->descricaoCargo)."</td>
					<td>$obj->produtidadeMes</td>
					<td title=\"Esforço Atual em projetos em Andamento é de: $obj->esforcoAtual\nEsforço Atual em projetos em Andamento e Parados é de: $obj->esforcoAtualTotal \">$obj->esforcoAtual <font style=\"font-size: x-small;color: $color;\">($obj->percentualMes%)</font></td>
					<td>$obj->esforcoFuturo <font style=\"font-size: x-small;color: $color2;\">($obj->percentualFuturo%)</font></td>
					<td>$obj->numeroFrentes</td>
				</tr>";
	}
}
/**/
$listaTabela[]="
				</tbody>
				</table>";
/**/
?>