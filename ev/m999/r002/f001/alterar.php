<?
	$IU="m999/r002/f001/i002";
	/**/
	$codModuloOrig=$_POST["codModuloOrig"];
	$codRotinaOrig=$_POST["codRotinaOrig"];
	$codFuncaoOrig=$_POST["codFuncaoOrig"];
	/**/
	$codModulo=$_POST["codModulo"];
	$codRotina=$_POST["codRotina"];
	$codFuncao=$_POST["codFuncao"];
	$modulo=$_POST["modulo"];
	$rotina=$_POST["rotina"];
	$funcao=$_POST["funcao"];
	$loadClass=$_POST["loadClass"];
	//
	if ( ($codModulo=="")||($codRotina=="")||($codFuncao=="")||($modulo=="")||($rotina=="")||($funcao=="")||($loadClass=="") )
	{
		$msn="Informe todos os dados.";
	}
	else
	{
		//
		$FUNCOES->altera(array(	"campos" => "codModulo='$codModulo', codRotina='$codRotina', codFuncao='$codFuncao',modulo='$modulo',rotina='$rotina',funcao='$funcao', loadClass='$loadClass'",
								"tabelas" => "modulos",
								"condicoes" => "codModulo='$codModuloOrig' and codRotina='$codRotinaOrig' and codFuncao='$codFuncaoOrig'"));
		if($FUNCOES->GetLinhas()>0){
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m999/r002/f001/i001";
			$FUNCOES->navegacao("eventos","Alteracao","Modulos","");
		}
		else{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>