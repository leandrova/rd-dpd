<?
$GLOBALS["MODULOSISTEMA"]="Modulos";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Modulos";
/**/
$listaUsuario[]="
				<table class=\"table table-striped table-hover table-condensed\">
				<thead>
				<tr>
					<th>Modulo</th>
					<th>Rotina</th>
					<th>Fun&ccedil;&atilde;o</th>
					<th>loadClass</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>";

$FUNCOES->consulta(array("tabelas" => "modulos","ordenacao" => "codModulo,codFuncao"));
if ($FUNCOES->GetLinhas()>0)
{
	$qnt=0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		if (file_exists("./ev/".$obj->loadClass.".php"))
		{
			$title="Este modulo est&aacute; finalizado"; $img="<img src=\"./images/mini-check.gif\" name=\"img\" alt=\"$title\" />";
		}
		else
		{
			$title="Este modulo n&atilde;o est&aacute; finalizado"; $img="<img src=\"./images/banlist_16.png\" width=14 heigth=17 name=\"img\" alt=\"$title\"/>";
		}
		/**/
		$qnt=$qnt+1;
		$listaUsuario[]="
				<tr title=\"$title\" style=\"cursor:pointer\" onclick=\"document.aplicacao.codModulo.value='$obj->codModulo'; document.aplicacao.codRotina.value='$obj->codRotina'; document.aplicacao.codFuncao.value='$obj->codFuncao'; executar('m999/r002/f001/loadBusca','aplicacao')\">
					<td>$obj->modulo</td>
					<td>$obj->rotina</td>
					<td>$obj->funcao</td>
					<td>$obj->loadClass</td>
					<td>$img</td>
				</tr>";
	}
}
/**/
$listaUsuario[]="
				</tbody>
				</table>";
/**/
if ($FUNCOES->getPermissao(999,2,1,1,$USUARIO))
{
	$listaUsuario[]="
				<table class=\"table table-striped table-hover table-condensed\">
				<tr bgcolor=\"#E0E0E0\" style=\"cursor:pointer\" onclick=\"executar('m999/r002/f001/loadBusca','aplicacao')\">
					<td align=\"right\" colspan=5>Novo</td>
				</tr>
				</table>";
}
else
{
	$listaUsuario[]="
				<table class=\"table table-striped table-hover table-condensed\">
				<tr bgcolor=\"#E0E0E0\" >
					<td align=\"right\" colspan=5><br/></td>
				</tr>
				</table>";
}
?>