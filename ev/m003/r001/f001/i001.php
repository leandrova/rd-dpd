<?
$GLOBALS["MODULOSISTEMA"]=utf8_decode("Configurações");
$GLOBALS["DISCRICAOSISTEMA"]=utf8_encode("Memória de Cálculo");
/**/
/* Busca Horas */
$FUNCOES->consulta(array
			(
			"campos"	=> " m1.codigoOrigem, m1.codigoTipoProjeto, m1.codigoFase, m1.horasEsforco ",
			"tabelas" 	=> " dcd_memoriaprojetos m1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f1 ",
			"condicoes"	=> " m1.codigoOrigem = o1.codigoOrigem and m1.codigoTipoProjeto = t1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase ",
			"ordenacao" => " m1.codigoOrigem, m1.codigoTipoProjeto, m1.codigoFase"
			)
		);
		
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$listaHorasEsforco["O".$obj->codigoOrigem."T".$obj->codigoTipoProjeto."F".$obj->codigoFase]=$obj->horasEsforco;
	}
}

/* Monta Tabela */
$listaTabela[]="
				<table id=\"tabela\" class=\"table table-striped  table-condensed\">
				<thead>
				<tr>
					<td>Origem</td>
					<td>Tipo</td>";
/* Buscandos Fases do projeto */
$FUNCOES->consulta(array
			(
			"tabelas" 	=> " dcd_fasesprojetos ",
			"ordenacao" => " codigoFase"
			)
		);
		
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$listaFases[$obj->codigoFase]=$obj->nomeFase;
		$listaTabela[]="<td>".($obj->nomeFase)."</td>";
	}
}
$listaTabela[]="
				</tr>
				</thead>
				<tbody>";
/* Buscando as Origens dos Projetos */
		
$FUNCOES->consulta(array
			(
			"campos" 	=> " codigoOrigem, codigoTipoProjeto, nomeOrigem, descricaoTipo ",
			"tabelas" 	=> " dcd_origemprojetos o1, dcd_tiposprojeto f1 ",
			"ordenacao" => " codigoOrigem, codigoTipoProjeto "
			)
		);
		
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		$listaTabela[]="
				<tr>
					<td>".($obj->nomeOrigem)."</td>
					<td>".($obj->descricaoTipo)."</td>";
		
		foreach ( $listaFases as $key => $value){
			if (isset($listaHorasEsforco["O".$obj->codigoOrigem."T".$obj->codigoTipoProjeto."F".$key])){
			$listaTabela[]="
					<td align=\"center\"><input style=\"width:inherit\" type=\"text\" name=\"O".$obj->codigoOrigem."T".$obj->codigoTipoProjeto."F".$key."\" size=\"5\" value=".$listaHorasEsforco["O".$obj->codigoOrigem."T".$obj->codigoTipoProjeto."F".$key]." ></td>";		
			} else {
			$listaTabela[]="
					<td align=\"center\"><input style=\"width:inherit\" type=\"text\" name=\"O".$obj->codigoOrigem."T".$obj->codigoTipoProjeto."F".$key."\" size=\"5\" value=\"00:00:00\" ></td>";					
			}
		}

					
		$listaTabela[]="
				</tr>";
				
	}
}
/**/
$listaTabela[]="
				</tbody>
				</table>";
/**/
?>