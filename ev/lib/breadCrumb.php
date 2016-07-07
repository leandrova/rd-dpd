<?
if ($FUNCOES->conexao<>""){
$a=explode("/",$GLOBALS["IU"]);
if ( isset($a[0]) & isset($a[1]) & isset($a[2]) ){
$FUNCOES->consulta(	array(	"tabelas" => "modulos",
							"condicoes" => "loadClass like '".$a[0]."/".$a[1]."/".$a[2]."%' ",
							)
					);
if ($FUNCOES->GetLinhas()>0){
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado())){
		
		if ($obj->modulo == $obj->rotina and $obj->rotina = $obj->funcao){
		$breadCrump[]="<li>$obj->modulo</li>";
		} else if ($obj->rotina == $obj->funcao){
		$breadCrump[]="
						<li>$obj->modulo</li>
						<li>$obj->rotina</li>
		";
		} else {
		$breadCrump[]="
						<li>$obj->modulo</li>
						<li>$obj->rotina</li>
                        <li>$obj->funcao</li>
		";
		}
	}
}
}
}
?>
