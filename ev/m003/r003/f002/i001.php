<?
$GLOBALS["MODULOSISTEMA"]="Sistemas";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Recursos de Sistemas";
/**/
$busca="";		if (isset($_POST["busca"])) {	$busca=$_POST["busca"];	}
/**/
$listaRecursos[]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>Nome</th>
				</tr>
				</thead>
				<tbody>";
if ($busca<>""){
	$FUNCOES->consulta(
				array(
					"tabelas" 	=> " dcd_recursossistemas ",
					"condicoes" => " nomeRecurso like '%$busca%' "
				)
			);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
		{
			$qnt=$qnt+1;
			$listaRecursos[]="
				<tr style=\"cursor:pointer\" onclick=\"document.aplicacao.codigoRecurso.value='$obj->codigoRecurso'; executar('m003/r003/f002/loadBusca','aplicacao')\">
					<td>$obj->nomeRecurso</td>
				</tr>";
		}
	}
}
else
{
			$listaRecursos[]="
				<tr>
					<td colspan=\"0\"><br/></td>
				</tr>";
}
/**/
$listaRecursos[]="
				</tbody>
				</table>";
/**/

if ($FUNCOES->getPermissao(3,3,2,1,$USUARIO))
{
	$listaRecursos[]="
				<table class=\"table table-striped table-condensed\">
				<tr bgcolor=\"#E0E0E0\" style=\"cursor:pointer\" onclick=\"document.aplicacao.codigoRecurso.value='novo'; executar('m003/r003/f002/loadRecurso','aplicacao')\">
					<td align=\"right\" colspan=\"0\">Novo</td>
				</tr>
				</table>";
}
else
{
	$listaRecursos[]="
				<table class=\"table table-striped table-condensed\">
				<tr bgcolor=\"#E0E0E0\" >
					<td align=\"right\" colspan=\"0\"><br/></td>
				</tr>
				</tbody>
				</table>";
}
?>