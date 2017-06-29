<?
$GLOBALS["MODULOSISTEMA"]="Sistemas";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Sistemas";
/**/
$busca="";		if (isset($_POST["busca"])) {	$busca=$_POST["busca"];	}
/**/
$listaSistemas[]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>Nome</th>
					<th>Tecnologia</th>
					<th>Tipo Contrato</th>
				</tr>
				</thead>
				<tbody>";
if ($busca<>""){
	$FUNCOES->consulta(
				array(
					"campos"	=> " dts.codigoSistema, dts.nomeSistema, dtt.nomeTecnologia, dtc.tipoContrato ",
					"tabelas" 	=> " dcd_tipossistema dts, dcd_tipostecnologia dtt, dcd_tiposcontrato dtc ",
					"condicoes" => " dts.nomeSistema like '%$busca%' and dts.codigoTecnologia = dtt.codigoTecnologia and dts.codigoContrato = dtc.codigoTipoContrato order by dts.nomeSistema, dtt.nomeTecnologia "
				)
			);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
		{
			$qnt=$qnt+1;
			$listaSistemas[]="
				<tr style=\"cursor:pointer\" onclick=\"document.aplicacao.codigoTipoSistema.value='$obj->codigoSistema'; executar('m003/r003/f001/loadBusca','aplicacao')\">
					<td>$obj->nomeSistema</td>
					<td>$obj->nomeTecnologia</td>
					<td>$obj->tipoContrato</td>
				</tr>";
		}
	}
}
else
{
			$listaSistemas[]="
				<tr>
					<td colspan=\"4\"><br/></td>
				</tr>";
}
/**/
$listaSistemas[]="
				</tbody>
				</table>";
/**/

if ($FUNCOES->getPermissao(3,3,1,1,$USUARIO))
{
	$listaSistemas[]="
				<table class=\"table table-striped table-condensed\">
				<tr bgcolor=\"#E0E0E0\" style=\"cursor:pointer\" onclick=\"document.aplicacao.codigoTipoSistema.value='novo'; executar('m003/r003/f001/loadSistema','aplicacao')\">
					<td align=\"right\" colspan=3>Novo</td>
				</tr>
				</table>";
}
else
{
	$listaSistemas[]="
				<table class=\"table table-striped table-condensed\">
				<tr bgcolor=\"#E0E0E0\" >
					<td align=\"right\" colspan=3><br/></td>
				</tr>
				</tbody>
				</table>";
}
?>