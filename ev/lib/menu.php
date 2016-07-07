<?
$i=0;
$FUNCOES->consulta(	array(	"campos" => "Distinct(rotina) as rotina, mo.modulo as modulo, mo.funcao as funcao, mo.codModulo as codModulo, mo.codRotina as codRotina, mo.codFuncao as codFuncao, mo.loadClass",
							"tabelas" => "modulos as mo, permissao as per",
							"condicoes" => "per.codModulo=mo.codModulo and per.codRotina=mo.codRotina and per.codFuncao=mo.codFuncao and per.login='".$GLOBALS["USUARIO"]."'",
							"ordenacao" => "codModulo, codRotina, codFuncao"
							)
					);
if ($FUNCOES->GetLinhas()>0){
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado())){
		
		if ( (isset($listaMenu[$obj->modulo][$obj->rotina])) ){
			$listaMenuI[$obj->modulo][$obj->rotina]["qnt"]=1+$listaMenuI[$obj->modulo][$obj->rotina]["qnt"];
		}else{
			$listaMenuI[$obj->modulo][$obj->rotina]["qnt"]=1;
		}
		if ($obj->rotina<>$obj->funcao){
			$listaMenuI[$obj->modulo][$obj->rotina]["qnt"]=2;
		}
		$listaMenu[$obj->modulo][$obj->rotina][$obj->funcao]=$obj->loadClass;
	}
}

?>