<?
	$backup[]="
				<table class=\"table\">
				<thead>
				<tr>
					<th>Tabela</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody>";

		$info=get_defined_constants(); 
		if ($info['DIRECTORY_SEPARATOR']=="/") { $system="linux"; } else { $system="windows"; }
		$backupDir = trocadml("Z:/BKP_SIS_".date("YmdHis"));
		$res = mysql_query("select * from information_schema.tables where TABLE_SCHEMA='".$SISbanco."'");
		$linhas=mysql_affected_rows();
		if ($linhas>0)
		{ 
			while ($obj=mysql_fetch_object($res))
			{ 
				$tableName = $obj->TABLE_NAME;
				$backupDirData = "$backupDir/BKP_DATA";
				exec("md ".trocadml("$backupDir/BKP_DATA")."");
				$backupFile = str_replace(chr(92),"/",$backupDirData."/".$tableName.".sql");
				mysql_query("SELECT * INTO OUTFILE '$backupFile' FROM $tableName");
				//
				$backup[]="
				<tr/>
					<td>$obj->TABLE_NAME</td>
					<td><img src=\"../../../images/mini-check.gif\" title=\"Ok\" /></td>
				</tr>";
			}
		}
		/* copy font */
		exec("md ".trocadml("$backupDir/BKP_FONT"));
		exec("xcopy ".trocadml("D:/EasyPHP-DevServer-14.1VC9/data/localweb")." ".trocadml("$backupDir/BKP_FONT")." /s /e >> ".trocadml("$backupDir/log_".date("YmdHis").".txt")."");
		/**/
		exec("zip -r ".trocadml($backupDir.".zip")." ".trocadml($backupDir)."");
		exec("del /s /q ".trocadml($backupDir)."");
		exec("rd /s /q ".trocadml($backupDir)."");
		
	$backup[]="
				<tr bgcolor=\"#E0E0E0\" >
					<td align=\"right\" colspan=3>&nbsp;</td>
				</tr>
				</tbody>
				</table>";

?>