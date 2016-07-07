<?
$i=0;
$sql="select mo.modulo as modulo, mo.funcao as funcao, mo.codModulo as codModulo, mo.codFuncao as codFuncao, per.permissao as permissao, mo.loadClass as loadClass
	from modulos as mo, permissao as per
	where per.codModulo=mo.codModulo and per.codFuncao=mo.codFuncao and per.login='".$GLOBALS["USUARIO"]."'
	order by codModulo, codFuncao";
$res=mysql_query($sql); $modulo="";
while ($obj=mysql_fetch_object($res)){
	
	$i=$i+1;

	if ($modulo=="") { 
		$listaMenu[$i]="
		<div class='dbx-box'>
			<h3 class='dbx-handle'>$obj->modulo</h3>
			<div class='dbx-content'>"; 
		$i=$i+1;
	}

	if ($obj->modulo<>$modulo){
		if ($i<>2){
			$listaMenu[$i]="
			</div>
		</div>
		<div class='dbx-box'>
			<h3 class='dbx-handle'>$obj->modulo</h3>
			<div class='dbx-content'>";
			$i=$i+1;
		}
		$modulo=$obj->modulo;
	}

	$listaMenu[$i]="
			<img src='./images/bullet-orange.gif' alt='' style='vertical-align: middle;' /> <a class=\"login_menu_link\" href=\"#\" onclick=\"executar('".$obj->loadClass."','aplicacao')\">$obj->funcao</a><br /><strong></strong>";
}
			$listaMenu[$i+1]="
			</div>
		</div>";

?>