<?
$GLOBALS["MODULOSISTEMA"]="Back-Up";
$GLOBALS["DISCRICAOSISTEMA"]="Tabelas para Back-Up";
$FUNCOES->navegacao("navegacao","navegacao","","");
/**/
$listaTable[]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Tabela</th>
					<th>Regitros</th>
				</tr>
				</thead>
				<tbody>";
$FUNCOES->consulta(array("tabelas" => "information_schema.tables","condicoes" => "TABLE_SCHEMA='".$FUNCOES->SISbanco."'"));
if ($FUNCOES->GetLinhas()>0)
{ 
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{ 
		$listaTable[]="
				<tr>
					<td><input type=\"checkbox\" name=\"$obj->TABLE_NAME\" value=\"1\" /></td>
					<td>$obj->TABLE_NAME</td>
					<td>$obj->TABLE_ROWS</td>
				</tr>";
	}
}
$listaTable[]="
				</tbody>
				</table>
				<br/>
				<input type=\"button\" class=\"button\" name=\"gerar\" value=\"Gerar Back-Up\" onclick=\"executar('m999/r003/f001/backup','aplicacao')\" />";


?>
