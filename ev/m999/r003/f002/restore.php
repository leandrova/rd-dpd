<?
$IU="m999/r003/f002/i003";
/**/
unset($GLOBALS["lista"]);
$GLOBALS["lista"][]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>Tabela</th>
					<th>Exclus&atilde;o</th>
					<th>Importa&ccedil;&atilde;o</th>
				</tr>
				</thead>
				<tbody>";
/**/
$codigo=$_POST["codigo"];
$caminho = $FUNCOES->trocadml(getcwd()."/backup/".$pasta);
$hndl=opendir($caminho);
while($file=readdir($hndl)) {
if ($file=='.' || $file=='..') continue;
	/**/
	$vet=explode(".",$file);
	$tabela=$vet[0];
	/**/
	if (isset($_POST[$tabela])){
		/* Exclui Dados na base */
		$imgExclui="<img src=\"./images/icon3.png\" title=\"N&atilde;o Selecionado\" />";
		if ($_POST[$tabela]==1){
			$FUNCOES->executaSql("truncate table ".$FUNCOES->SISbanco.".".$tabela."");
			if ($FUNCOES->GetLinhas()<0) { $imgExclui="<img src=\"./images/banlist_16.png\" title=\"".$FUNCOES->GetMysqlError()."\" />"; } else { $imgExclui="<img src=\"./images/mini-check.gif\" title=\"Ok\" />"; }
		}
		$msn.="Tabela ".$tabela." excluida.<br>";
		/**/
		$tableName = $tabela;
		$importFile = str_replace(chr(92),"/",$caminho."/".$file);
		$FUNCOES->executaSql("LOAD DATA INFILE '$importFile' INTO TABLE ".$tableName."");
		if ($FUNCOES->GetLinhas()<0) { $imgImport="<img src=\"./images/banlist_16.png\" title=\"".$FUNCOES->GetMysqlError()."\" />"; } else { $imgImport="<img src=\"./images/mini-check.gif\" title=\"Ok\" />"; }
		/**/
		$msn.="Tabela ".$tableName." carregada.<br>";
		$GLOBALS["lista"][]="
				<tr/>
					<td>$tabela</td>
					<td>$imgExclui</td>
					<td>$imgImport</td>
				</tr>";
		/**/
	}else{
	$GLOBALS["lista"][]="
				<tr/>
					<td>$tabela</td>
					<td><img src=\"./images/icon3.png\" title=\"N&atilde;o Selecionado\" /></td>
					<td><img src=\"./images/icon3.png\" title=\"N&atilde;o Selecionado\" /></td>
				</tr>";
	}
	$FUNCOES->navegacao("eventos","Cadastro","Restore",$codigo);
	/**/
}
/**/
$GLOBALS["lista"][]="
				<tr bgcolor=\"#E0E0E0\" />
					<td align=\"right\" colspan=3>&nbsp;</td>
				</tr>
				</tbody>
				</table>";
?>