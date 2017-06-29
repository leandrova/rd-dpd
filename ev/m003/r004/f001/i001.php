<?
$GLOBALS["MODULOSISTEMA"]=("Import Esforço/Custo");
$GLOBALS["DISCRICAOSISTEMA"]=("Import Esforço/Custo");
/**/
/* Monta Tabela */
$listaTabela[]="
				<table id=\"tabela\" class=\"table table-striped  table-condensed\">
				<thead>
				<tr>
					<td>Arquivos</td>
					<td>Data Geração</td>
					<td>&nbsp;</td>
				</tr>
				</thead>
				<tbody>";

$path = "./import/";
$diretorio = dir($path);

while($arquivo = $diretorio -> read()){
	if ( ($arquivo <> ".") and ($arquivo <> "..") and ($arquivo <> "index.php") and (substr($arquivo,-3) == "csv" ) )
	{
		$lista[]=$arquivo."^".$path;
	}
}
$diretorio->close();

if (isset($lista)){
	$lista = array_reverse($lista);
	foreach ($lista as $key => $value)
	{
		list($arquivo,$path) = explode("^",$value);
		$arquivoLog = substr($arquivo, 0, -4).".log";
		$dataHora = substr($arquivo,22,2)."/".substr($arquivo,20,2)."/".substr($arquivo,16,4)." ".substr($arquivo,25,2).":".substr($arquivo,27,2);

		if (file_exists($path.$arquivoLog)){
			$td = "<td><a href='".$path.$arquivoLog."' style=\"cursor:hand\"><img src=\"./images/archive.png\" name=\"img\" alt=\"Baixar arquivo de log\"></a></td>";
		} else {
			$td = "<td><a style=\"cursor:hand\"><img src=\"./images/process.png\" name=\"img\" alt=\"Processar Arquivo\" onclick=\"document.aplicacao.nomeArquivo.value='".$arquivo."'; executar('m003/r004/f001/processFile','aplicacao')\"></a></td>";
		}

$listaTabela[]="
				<tr>
					<td>$arquivo</td>
					<td>$dataHora</td>
					$td
				</tr>";
	}
} else {
$listaTabela[]="
				<tr>
					<td colspan=3>Nenhum arquivo disponivel</td>
				</tr>";
}
		
$listaTabela[]="			
				</tbody>
				</table>";
?>