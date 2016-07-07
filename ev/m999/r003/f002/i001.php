<?
$GLOBALS["MODULOSISTEMA"]="Restore";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Back-Up's";
/**/
$listaTable[]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>Qnt</th>
					<th>Tabela</th>
					<th>Pasta</th>
				</tr>
				</thead>
				<tbody>";

/**/
$pasta = $FUNCOES->trocadml(getcwd()."/backup");
$hndl=opendir($pasta); $i=0;
while($file=readdir($hndl)) {
if ($file=='.' || $file=='..') continue;
/**/
	if(is_dir($pasta."/".$file)){
		/**/
		$i=$i+1;
		$dia=substr($file,6,2)."/".substr($file,4,2)."/".substr($file,0,4)." ".substr($file,8,2).":".substr($file,10,2).":".substr($file,12,2);
		$listaTable[]="
				<tr style=\"cursor:pointer\" onclick=\"document.aplicacao.codigo.value='$file'; executar('m999/r003/f002/loadBusca','aplicacao')\" >
					<td>$i</td>
					<td>$dia</td>
					<td>$file</td>
				</tr>";
		/**/
	}
/**/
}
/**/
if (!$i){
$listaTable[]="
				<tr>
					<td colspan=\"3\" align=\"center\">Nenhum Back-Up foi encontrado</td>
				</tr>";
}
/**/
$listaTable[]="
				</tbody>
				</table>";
?>