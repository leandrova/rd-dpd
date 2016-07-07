<?
	$IU="m999/r002/f001/i002";
	//
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
	}else
	{
		//
		$FUNCOES->cadastro(	array(	"campos" => "modulo, rotina, funcao, codModulo, codRotina, codFuncao, loadClass",
									"tabelas" => "modulos",
									"values" => "'$modulo','$rotina','$funcao','$codModulo','$codRotina','$codFuncao','$loadClass'"));
		if($FUNCOES->GetLinhas()>0){
			$msn="Cadastro incluido com sucesso.";
			$IU="m999/r002/f001/i001";
			$FUNCOES->navegacao("eventos","Cadastro","Modulos","");
		}
		else
		{
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
?>