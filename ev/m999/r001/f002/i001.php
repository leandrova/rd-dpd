<?
$GLOBALS["MODULOSISTEMA"]="Permiss&atilde;o";
$GLOBALS["DISCRICAOSISTEMA"]="Lista de Usu&aacute;rios";
/**/
$busca="";		if (isset($_POST["busca"])) {	$busca=$_POST["busca"];		}
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
if ($busca<>"")
{
	$FUNCOES->consulta(array("tabelas" => "usuarios","condicoes" => " nome like '%$busca%'", "ordenacao" => "nome,login"));
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
		{
			$qnt=$qnt+1;
			$listaUsuario[]="
				<tr style=\"cursor:pointer\" onclick=\"document.aplicacao.codigo.value='$obj->login'; executar('m999/r001/f002/loadBusca','aplicacao')\">
					<td>$obj->login</td>
					<td>$obj->nome</td>
					<td>$obj->email</td>
					<td>$obj->telefone</td>
				</tr>";
		}
	}
	else
	{
			$listaUsuario[]="
				<tr>
					<td>1</td>
					<td>nenhum dado encontrado</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>";
	}
}
else
{
			$listaUsuario[]="
				<tr>
					<td>1</td>
					<td colspan=\"3\">Informe os dados da busca</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>";
}
/**/
$listaUsuario[]="
				</tbody>
				</table>";
/**/
?>