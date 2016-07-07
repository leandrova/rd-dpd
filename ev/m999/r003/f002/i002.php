<?
$GLOBALS["MODULOSISTEMA"]="Restore";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Arquivos para Back-Up";
/**/
$codigo=$_POST["codigo"];
/**/
$listaTable[]="
				<p><b>Back-Up $codigo</b></p>

				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>Arquivos</th>
					<th>Importar e Excluir Dados na Base</th>
					<th>Somente Importar</th>
				</tr>
				</thead>
				<tbody>";
/**/
$caminho = $FUNCOES->trocadml(getcwd()."/backup/".$codigo);
$hndl=opendir($caminho);
while($file=readdir($hndl)) {
if ($file=='.' || $file=='..') continue;
	/**/
	$vet=explode(".",$file);
	$tabela=$vet[0];
	/**/
	$listaTable[]="
			<tr>
				<td>$file</td>
				<td><input type=\"radio\" name=\"$tabela\" value=\"1\" /></td>
				<td><input type=\"radio\" name=\"$tabela\" value=\"2\" /></td>
			</tr>";
	/**/
}
$listaTable[]="
				</tbody>
				</table>
				<br/>
				<input type=\"button\" class=\"button\" name=\"gerar\" value=\"Restaurar\" onclick=\"executar('m999/r003/f002/restore','aplicacao')\" />";
?>