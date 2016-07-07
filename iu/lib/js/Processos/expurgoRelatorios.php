<?

	$expurgoRelatorio[]="
				<table class=\"table\">
				<thead>
				<tr>
					<th>Arquivo</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody>";

$path = "../../../export/"; $qnt=0;
$diretorio = dir($path);

 while($arquivo = $diretorio -> read()){

	if (substr($arquivo,-4) == "xlsx" )
	{
	$qnt=$qnt+1;
	$dataHora = substr($arquivo,17,2)."/".substr($arquivo,15,2)."/".substr($arquivo,11,4)." ".substr($arquivo,19,2).":".substr($arquivo,21,2);
$expurgoRelatorio[]="
				<tr>
					<td>$arquivo</td>
					<td><img src=\"../../../images/mini-check.gif\" title=\"Ok\" /></td>
				</tr>";
				unlink($path.$arquivo);
	}
}
if ($qnt == 0){
$expurgoRelatorio[]="
				<tr>
					<td colspan=2>Nenhum arquivo para ser excluido</td>
				</tr>";
}
$diretorio -> close();
$expurgoRelatorio[]="			
				</tbody>
				</table>";

?>