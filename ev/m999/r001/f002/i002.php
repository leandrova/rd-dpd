<?
$GLOBALS["MODULOSISTEMA"]="Permiss&atilde;o";
$GLOBALS["DISCRICAOSISTEMA"]="Gerenciar Usu&aacute;rio";
/**/
$codigo="";			if (isset($_POST["codigo"])) { $codigo=$_POST["codigo"]; }
/**/
$FUNCOES->consulta(array("tabelas" => "modulos", "ordenacao" => "codModulo,codRotina,codFuncao"));
if ($FUNCOES->GetLinhas()>0)
{
	$lista[]="
					<table class=\"table table-striped table-condensed\">
					<thead>
					<tr>
						<th>Modulo</th>
						<th>Rotina</th>
						<th>Fun&ccedil;&atilde;o</th>
						<th>N&atilde;o</th>
						<th>Con</th>
						<th>Inc</th>
						<th>Alt</th>
						<th>Exc</th>
					</tr>
					</thead>
					<tbody>";
	$res=$FUNCOES->GetResultado();
	while ($obj=mysql_fetch_object($res))
	{
		if (file_exists("./ev/".$obj->loadClass.".php"))
		{
			if (!$FUNCOES->getPermissao($obj->codModulo,$obj->codRotina,$obj->codFuncao,0,$codigo)) { $opcN ="checked"; } else { $opcN =""; }
			if ($FUNCOES->getPermissao($obj->codModulo,$obj->codRotina,$obj->codFuncao,0,$codigo))  { $opc0 ="checked"; } else { $opc0 =""; }
			if ($FUNCOES->getPermissao($obj->codModulo,$obj->codRotina,$obj->codFuncao,1,$codigo))  { $opc1 ="checked"; } else { $opc1 =""; }
			if ($FUNCOES->getPermissao($obj->codModulo,$obj->codRotina,$obj->codFuncao,2,$codigo))  { $opc2 ="checked"; } else { $opc2 =""; }
			if ($FUNCOES->getPermissao($obj->codModulo,$obj->codRotina,$obj->codFuncao,3,$codigo))  { $opc3 ="checked"; } else { $opc3 =""; }
			$lista[]="
					<tr>
						<td>$obj->modulo</td>
						<td>$obj->rotina</td>
						<td>$obj->funcao</td>
						<td><input type=\"radio\" ".$opcN." name=\"".$obj->codModulo.$obj->codRotina.$obj->codFuncao."permissao\" value=\"nao\"/></td>
						<td><input type=\"radio\" ".$opc0." name=\"".$obj->codModulo.$obj->codRotina.$obj->codFuncao."permissao\" value=\"0\" /></td>
						<td><input type=\"radio\" ".$opc1." name=\"".$obj->codModulo.$obj->codRotina.$obj->codFuncao."permissao\" value=\"1\" /></td>
						<td><input type=\"radio\" ".$opc2." name=\"".$obj->codModulo.$obj->codRotina.$obj->codFuncao."permissao\" value=\"2\" /></td>
						<td><input type=\"radio\" ".$opc3." name=\"".$obj->codModulo.$obj->codRotina.$obj->codFuncao."permissao\" value=\"3\" /></td>
					</tr>";
		}
	}
	$lista[]="</tbody></table>";
}
/**/

?>