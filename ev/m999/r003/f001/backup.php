<?
$IU="m999/r003/f001/i002";
//
$GLOBALS["lista"][]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>Tabela</th>
					<th>Status</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>";

		$info=get_defined_constants(); 
		if ($info['DIRECTORY_SEPARATOR']=="/") { $system="linux"; } else { $system="windows"; }
		$backupDir = $FUNCOES->trocadml(getcwd()."/backup/".date("YmdHis"));
		$FUNCOES->consulta(array("tabelas" => "information_schema.tables","condicoes" => "TABLE_SCHEMA='".$FUNCOES->SISbanco."'"));
		if ($FUNCOES->GetLinhas()>0)
		{ 
			$res=$FUNCOES->GetResultado();
			while ($obj=mysql_fetch_object($res))
			{ 
				//
				if (isset($_POST[$obj->TABLE_NAME])) { if ($_POST[$obj->TABLE_NAME]) { $back=1; } } else { $back=0; }
				
				if ($back)
				{
					$tableName = $obj->TABLE_NAME;
					if ($system=="linux") { exec("mkdir $backupDir"); } else { exec("md $backupDir"); }
					$backupFile = str_replace(chr(92),"/",$backupDir."/".$tableName.".sql");
					$FUNCOES->executaSql("SELECT * INTO OUTFILE '$backupFile' FROM $tableName");
					//
					$GLOBALS["lista"][]="
				<tr/>
					<td>$obj->TABLE_NAME</td>
					<td><img src=\"./images/mini-check.gif\" title=\"Ok\" /></td>
					<td><img src=\"./images/cat_files_16.png\" title=\"Baixar\" alt=\"Baixar\" onclick=\"baixarFile('".($FUNCOES->trocadml($backupFile))."')\" style=\"cursor:hand\"/></td>
				</tr>";
				}
				else
				{
					$GLOBALS["lista"][]="
				<tr/>
					<td>$obj->TABLE_NAME</td>
					<td><img src=\"./images/banlist_16.png\" title=\"N&atilde;o Selecionado\" /></td>
					<td>&nbsp;</td>
				</tr>";
				}
			}
			$FUNCOES->navegacao("eventos","Cadastro","Back-Up","");
		}

$GLOBALS["lista"][]="
				<tr bgcolor=\"#E0E0E0\" >
					<td align=\"right\" colspan=3>&nbsp;</td>
				</tr>
				</tbody>
				</table>";
?>