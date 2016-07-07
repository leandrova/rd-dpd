<?

	$backupArquivos[]="
				<table class=\"table\">
				<thead>
				<tr>
					<th>Arquivo</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody>";

		$info=get_defined_constants(); 
		if ($info['DIRECTORY_SEPARATOR']=="/") { $system="linux"; } else { $system="windows"; }
		$backupDir = trocadml("Z:/BKP_ARQ_".date("YmdHis"));
		/* copy font */
		/*exec("md ".trocadml("$backupDir"));
		exec("xcopy ".trocadml("D:\DesenvolvimentoPlataformasDigitais")." ".trocadml("$backupDir")." /s /e >> ".trocadml("$backupDir/log_".date("YmdHis").".txt")."");*/
		/**/
		/*exec("zip -r ".trocadml($backupDir.".zip")." ".trocadml($backupDir)."");
		exec("del /s /q ".trocadml($backupDir)."");
		exec("rd /s /q ".trocadml($backupDir)."");*/
		
		exec("zip -r ".trocadml($backupDir.".zip")." ".trocadml("D:\DesenvolvimentoPlataformasDigitais")."");
		
	$backupArquivos[]="
				<tr/>
					<td>$backupDir</td>
					<td><img src=\"../../../images/mini-check.gif\" title=\"Ok\" /></td>
				</tr>";
		
	$backupArquivos[]="
				<tr bgcolor=\"#E0E0E0\" >
					<td align=\"right\" colspan=3>&nbsp;</td>
				</tr>
				</tbody>
				</table>";

?>