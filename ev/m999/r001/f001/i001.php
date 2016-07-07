<?
$GLOBALS["MODULOSISTEMA"]="Usu&aacute;rios";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Usu&aacute;rios";
/**/
$busca="";		if (isset($_POST["busca"])) {	$busca=$_POST["busca"];	}
/**/
$listaUsuario[]="
				<table class=\"table table-striped table-condensed\">
				<thead>
				<tr>
					<th>Login</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Telefone</th>
				</tr>
				</thead>
				<tbody>";
if ($busca<>""){
	$FUNCOES->consulta(array("tabelas" => "usuarios","condicoes" => " nome like '%$busca%' or login like '%$busca%' ", "ordenacao" => "nome,login"));
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
		{
			$qnt=$qnt+1;
			$listaUsuario[]="
				<tr style=\"cursor:pointer\" onclick=\"document.aplicacao.codigo.value='$obj->login'; executar('m999/r001/f001/loadBusca','aplicacao')\">
					<td>$obj->login</td>
					<td>$obj->nome</td>
					<td>$obj->email</td>
					<td>$obj->telefone</td>
				</tr>";
		}
	}
}
else
{
			$listaUsuario[]="
				<tr>
					<td colspan=\"4\"><br/></td>
				</tr>";
}
/**/
$listaUsuario[]="
				</tbody>
				</table>";
/**/

if ($FUNCOES->getPermissao(999,1,1,1,$USUARIO))
{
	$listaUsuario[]="
				<table class=\"table table-striped table-condensed\">
				<tr bgcolor=\"#E0E0E0\" style=\"cursor:pointer\" onclick=\"document.aplicacao.codigo.value='novo'; executar('m999/r001/f001/loadBusca','aplicacao')\">
					<td align=\"right\" colspan=4>Novo</td>
				</tr>
				</table>";
}
else
{
	$listaUsuario[]="
				<table class=\"table table-striped table-condensed\">
				<tr bgcolor=\"#E0E0E0\" >
					<td align=\"right\" colspan=4><br/></td>
				</tr>
				</tbody>
				</table>";
}
?>