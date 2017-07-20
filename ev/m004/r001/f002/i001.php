<?
$GLOBALS["MODULOSISTEMA"]=("Relatórios");
$GLOBALS["DISCRICAOSISTEMA"]=("Export Projetos PP's");
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

$path = "./export/";
$diretorio = dir($path);

while($arquivo = $diretorio -> read()){
	if ( ($arquivo <> ".") and ($arquivo <> "..") and ($arquivo <> "index.php") and (substr($arquivo,0,10) == "export_412" ) )
	{
		$lista[substr($arquivo,11,14)]=$arquivo."^".$path;
	}
}
$diretorio->close();

if (isset($lista)){
	$lista = array_reverse($lista);
	foreach ($lista as $key => $value)
	{
		list($arquivo,$path) = explode("^",$value);
		$dataHora = substr($arquivo,17,2)."/".substr($arquivo,15,2)."/".substr($arquivo,11,4)." ".substr($arquivo,19,2).":".substr($arquivo,21,2);
$listaTabela[]="
				<tr>
					<td>$arquivo</td>
					<td>$dataHora</td>
					<td><a href='".$path.$arquivo."'><img src=\"./images/download.png\" name=\"img\" alt=\"Baixar arquivo\"></a></td>
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