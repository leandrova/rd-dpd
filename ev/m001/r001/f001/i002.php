<?
$GLOBALS["MODULOSISTEMA"]="Projetos";
$GLOBALS["DISCRICAOSISTEMA"]="Detalhes do Projeto";
/**/

if (!isset($codigoProjeto)) {
	$codigoProjeto		="";	If (isset($_POST["codigoProjeto"])) 	{	$codigoProjeto 	= $_POST["codigoProjeto"]; 	}
}
if (!isset($codigoProjetoPai)) {
	$codigoProjetoPai	=0;		If (isset($_POST["codigoProjetoPai"])) 	{	$codigoProjetoPai 	= $_POST["codigoProjetoPai"]; 	}
}

$nomeProjeto		="";
$descricaoProjeto	="";
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
	$descricaoProjeto 	= $obj->descricao;
	$codigoProjetoPai	= $obj->codigoProjetoPai;
	$GLOBALS["DISCRICAOSISTEMA"]="Detalhes do Projeto $nomeProjeto ";
}
/* Busca Informações do Projeto Pai */
if ($codigoProjetoPai <> 0){
	$FUNCOES->consulta(array
				(
				"tabelas" 	=> " dcd_projetos",
				"condicoes" => " codigoProjeto = $codigoProjetoPai ",
				)
			);
	if ($FUNCOES->GetLinhas()>0)
	{
		$obj=mysql_fetch_object($FUNCOES->GetResultado());
		$nomeProjetoPai 		= $obj->nomeProjeto;
		$codigoProjetoPai		= $obj->codigoProjeto;
		$GLOBALS["DISCRICAOSISTEMA"]="Detalhes do SubProjeto $nomeProjeto [Projeto <a href=\"#\" style=\"font-weight: bold;\" onclick=\"document.aplicacao.codigoProjeto.value='$codigoProjetoPai'; executar('m001/r001/f001/loadDetalhe','aplicacao')\">$nomeProjetoPai</a>]";
		
	}
}
/* Busca Frentes do Projeto */
$listaTabela[]="
				<table id=\"tabela\" class=\"table table-striped table-hover table-condensed\">
				<thead>
				<tr>
					<th style=\"width:20%\">Nome da Frente</th>
					<th style=\"width:25%\">Descri&ccedil;&atilde;o</th>
					<th>Tipo</th>
					<th>Recurso</th>
					<th>Fase</th>
					<th>Esfor&ccedil;o</th>
					<th>OG</th>
				</tr>
				<tr>
					<th><input type=\"text\" id=\"txtColuna1\"></th>
					<th><input type=\"text\" id=\"txtColuna2\"></th>
					<th><input type=\"text\" id=\"txtColuna3\"></th>
					<th><input type=\"text\" id=\"txtColuna4\"></th>
					<th><input type=\"text\" id=\"txtColuna5\"></th>
					<th><input type=\"text\" id=\"txtColuna6\"></th>
					<th><input type=\"text\" id=\"txtColuna7\"></th>
				</tr>
				</thead>
				<tbody>";
				
/* Pesquisando SubProjetos */
$FUNCOES->consulta(array
			(
			"campos" 	=> " p1.codigoProjeto, p1.nomeProjeto, p1.descricao ",
			"tabelas" 	=> " dcd_projetos p1 ",
			"condicoes" => " p1.codigoProjetoPai = $codigoProjeto ",
			"ordenacao" => " p1.nomeProjeto, p1.dataCadastro"
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$qnt=$qnt+1;
		$listaTabela[]="
				<tr style=\"cursor: pointer;\" onclick=\"document.aplicacao.codigoProjeto.value='$obj->codigoProjeto'; document.aplicacao.codigoProjetoPai.value=0; executar('m001/r001/f001/loadDetalhe','aplicacao')\">
					<td><img id=\"pasta$qnt\" src=\"./images/folder_closed.png\" style=\"width:18px;\" /> ".($obj->nomeProjeto)."</td>
					<td>".($obj->descricao)."</td>
					<td> -- // -- </td>
					<td> -- // -- </td>
					<td> -- // -- </td>
					<td> -- // -- </td>
					<td> -- // -- </td>
				</tr>";
		$listaSubProjetos[$obj->codigoProjeto]="";
	}
}

/* Pesquisando Frentes */
$FUNCOES->consulta(array
			(
			"campos" 	=> " p1.nomeProjeto, p1.descricao, f1.codigoFrente, f1.nomeFrente, f1.descricaoFrente, o1.nomeOrigem, r1.usuarioRecurso, f2.nomeFase, m1.horasEsforco, t1.descricaoTipo, f1.codigoFase, s1.esforcoAlocado, s1.descricaoStatus",
			"tabelas" 	=> " dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1",
			"condicoes" => " p1.codigoProjeto = $codigoProjeto and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoStatus = s1.codigoStatus and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase",
			"ordenacao" => " f1.nomeFrente, f1.dataCadastro"
			)
		);
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		/**/
		$comentario = "";
		if ($obj->esforcoAlocado <> 1) 	{ $comentario.="<br/><strong style=\"font-size: 10; color: red;\">[Fentre $obj->descricaoStatus]</strong>"; 	}
		if ($obj->codigoFase == 11) 		{ $comentario.="<br/><strong style=\"font-size: 10; color: red;\">[Fentre Concluida]</strong>"; 				} 
		/**/
		$qnt=$qnt+1;
		$listaTabela[]="
				<tr style=\"cursor: pointer;\" onclick=\"document.aplicacao.codigoFrente.value='$obj->codigoFrente'; executar('m001/r001/f001/loadFrente','aplicacao')\">
					<td>".($obj->nomeFrente).($comentario)."</td>
					<td>".($obj->descricaoFrente)."</td>
					<td>".($obj->nomeOrigem)."</td>
					<td>".($obj->usuarioRecurso)."</td>
					<td>".($obj->nomeFase)."</td>
					<td>".($obj->horasEsforco)."</td>
					<td>".($obj->descricaoTipo)."</td>
				</tr>";
	}
}
$listaTabela[]="
				</tbody>
				</table>";
				
/* Busca permissão para inclusão de novas frente ou subprojetos */
				
if ($FUNCOES->getPermissao(1,1,1,1,$USUARIO))
{
	$listaTabela[]="
				<input type=\"button\" class=\"btn btn-default\" value=\"Nova Frente\" onclick=\"executar('m001/r001/f001/loadNovaFrente','aplicacao')\">
				<input type=\"button\" class=\"btn btn-default\" value=\"Novo SubProjeto\" onclick=\"executar('m001/r001/f001/loadNovo','aplicacao')\">";
}
?>