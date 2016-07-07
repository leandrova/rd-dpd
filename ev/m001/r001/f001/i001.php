<?
$GLOBALS["MODULOSISTEMA"]="Projetos";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Projetos";
/**/
$buscaProjeto	="";	If (isset($_POST["buscaProjeto"])) 	{	$buscaProjeto 	= $_POST["buscaProjeto"]; 	}
$tipoBusca		="";	If (isset($_POST["tipoBusca"])) 	{	$tipoBusca 		= $_POST["tipoBusca"]; 		}
/**/
if ($tipoBusca == "" or $tipoBusca == "projeto" ){

	$listaTabela[]="
				<table id=\"tabela\" class=\"table table-striped table-hover table-condensed\">
				<thead>
				<tr>
					<th style=\"width:30%\">Nome do Projeto</th>
					<th style=\"width:60%\">Descri&ccedil;&atilde;o</th>
					<th style=\"width:10%\">N&deg; Frentes</th>
				</tr>
				<tr>
					<th><input type=\"text\" id=\"txtColuna1\"></th>
					<th><input type=\"text\" id=\"txtColuna2\"></th>
					<th><input type=\"text\" id=\"txtColuna3\"></th>
				</tr>
				</thead>
				<tbody>";

	/* Verifica se o usuário logado possui projetos; caso não possua habilita todos os projetos */
	$FUNCOES->consulta(array
			(
			"tabelas" 	=> " dcd_frentes ",
			"condicoes" => " codigoRecurso in (select codigoRecurso from dcd_recursos where usuarioRecurso = '$USUARIO') "
			)
		);
	if ($FUNCOES->GetLinhas()>0)
	{
		$condicao = " codigoProjetoPai = 0 and codigoProjeto in (select 	codigoProjeto from dcd_frentes where codigoRecurso in (select codigoRecurso from dcd_recursos where usuarioRecurso = '$USUARIO')) ";
	} else {
		$condicao = " codigoProjetoPai = 0 and codigoProjeto is not null ";
	}
	
	if ($buscaProjeto <> ""){
		$condicao = " upper(nomeProjeto) like upper('%$buscaProjeto%') ";
	}
				
	$FUNCOES->consulta(array
			(
			"campos" 	=> " *, (select count(1) from dcd_frentes f1 where f1.codigoProjeto = p1.codigoProjeto) frentes",
			"tabelas" 	=> " dcd_projetos p1",
			"condicoes" => " $condicao ",
			"ordenacao" => " nomeProjeto"
			)
		);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
		{
			/**/
			$qnt=$qnt+1;
			if ($obj->codigoProjetoPai <> 0) { $subProjeto="<img id=\"pasta$qnt\" src=\"./images/folder_closed.png\" style=\"width:18px;\" /> "; } else { $subProjeto=""; }
			$listaTabela[]="
				<tr style=\"cursor: pointer;\" onclick=\"document.aplicacao.codigoProjeto.value='$obj->codigoProjeto'; document.aplicacao.codigoProjetoPai.value='$obj->codigoProjetoPai'; executar('m001/r001/f001/loadDetalhe','aplicacao')\">
					<td>$subProjeto".($obj->nomeProjeto)."</td>
					<td>".($obj->descricao)."</td>
					<td>".($obj->frentes)."</td>
				</tr>";
		}
	}
	/**/
	$listaTabela[]="
				</tbody>
				</table>";
	/**/
	if ($FUNCOES->getPermissao(1,1,1,2,$USUARIO))
	{
		$listaTabela[]="
				<input type=\"button\" class=\"btn btn-default\" value=\"Novo Projeto\" onclick=\"executar('m001/r001/f001/loadNovo','aplicacao')\">";
	}
	else
	{
		$listaTabela[]="";
	}
} elseif ($tipoBusca == "frente") {

	$listaTabela[]="
				<table id=\"tabela\" class=\"table table-striped table-hover table-condensed\">
				<thead>
				<tr>
					<th style=\"width:20%\">Nome do Projeto</th>
					<th style=\"width:20%\">Nome da Frente</th>
					<th>Tipo</th>
					<th>Fase</th>
					<th>Esfor&ccedil;o</th>
					<th>OG</th>
					<th>Recurso</th>
				</tr>
				<tr>
					<th><input type=\"text\" id=\"txtColuna1\"></th>
					<th><input type=\"text\" id=\"txtColuna2\"></th>
					<th><input type=\"text\" id=\"txtColuna3\"></th>
					<th><input type=\"text\" id=\"txtColuna4\"></th>
					<th><input type=\"text\" id=\"txtColuna6\"></th>
					<th><input type=\"text\" id=\"txtColuna7\"></th>
					<th><input type=\"text\" id=\"txtColuna8\"></th>
				</tr>
				</thead>
				<tbody>";

	$condicao = " r1.codigoRecurso in (select codigoRecurso from dcd_recursos where usuarioRecurso = '$USUARIO') ";
	if ($buscaProjeto <> ""){
		$condicao = " ( upper(nomeProjeto) like upper('%$buscaProjeto%') or upper(nomeFrente) like upper('%$buscaProjeto%') )";
	}

	$FUNCOES->consulta(array
			(
			"campos" 	=> " p1.codigoProjeto, p1.codigoProjetoPai, p1.nomeProjeto, p1.descricao, s1.descricaoStatus, f1.codigoFrente, f1.nomeFrente, f1.descricaoFrente, o1.nomeOrigem, r1.usuarioRecurso, f2.nomeFase, m1.horasEsforco, t1.descricaoTipo ",
			"tabelas" 	=> " dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1  ",
			"condicoes" => " $condicao and f1.codigoStatus = s1.codigoStatus and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase  ",
			"ordenacao" => " p1.nomeProjeto, f1.nomeFrente, f1.dataCadastro"
			)
		);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
		{
			/**/
			if ($obj->codigoProjetoPai <> 0 ) { $icone="<img src=\"./images/folder_closed.png\" style=\"width:18px;\">&nbsp;"; } else { $icone=""; }
			$qnt=$qnt+1;
			$listaTabela[]="
				<tr style=\"cursor: pointer;\" onclick=\"document.aplicacao.codigoProjeto.value='$obj->codigoProjeto'; document.aplicacao.codigoFrente.value='$obj->codigoFrente'; executar('m001/r001/f001/loadFrente','aplicacao')\">
					<td>$icone".($obj->nomeProjeto)."</td>
					<td>".($obj->nomeFrente)."</td>
					<td>".($obj->nomeOrigem)."</td>
					<td>".($obj->nomeFase)."</td>
					<td>".($obj->horasEsforco)."</td>
					<td>".($obj->descricaoTipo)."</td>
					<td>".($obj->usuarioRecurso)."</td>
				</tr>";
		}
	}
	/**/
	$listaTabela[]="
				</tbody>
				</table>";
	/**/
} else {
	$listaTabela[]="<h5>Desculpe mas não foi possivel identificar o tipo de busca!</h5>";
}
?>