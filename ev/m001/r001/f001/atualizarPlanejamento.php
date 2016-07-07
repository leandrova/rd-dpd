<?

$codigoFrente		="";	If (isset($_POST["codigoFrente"]))		{	$codigoFrente 		= $_POST["codigoFrente"]; 		}

$FUNCOES->consulta(array ( 
					"campos"	=> " fp.nomeFase, fp.codigoFase, mf.dataMarco, mf.codigoMarco, mf.usuarioCadastro, mf.dataCadastro", 
					"tabelas" 	=> " dcd_fasesprojetos fp left join dcd_marcofrente mf on fp.codigoFase = mf.codigoFase and mf.codigoFrente = $codigoFrente",
					"condicoes"	=> " dataMarco is not null ",
					"ordenacao"	=> " fp.codigoFase, mf.codigoMarco desc "
					)
				);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$listaMP[$obj->codigoFase][]=$obj->dataMarco;
	}
}

$FUNCOES->consulta(array
			(
			"campos" 	=> " codigoFase ",
			"tabelas" 	=> " dcd_fasesprojetos f1 ",
			"ordenacao" => " codigoFase "
			)
		);
		
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$nvDataMarco = $_POST["dataMarco".$obj->codigoFase];
		if ( ($nvDataMarco == "") or (strtoupper($nvDataMarco) == "TBD") ) {
			$nvDataMarco="0000-00-00";
		}  else {
			$nvDataMarco = $FUNCOES->dataInterna($nvDataMarco);
			if ($nvDataMarco == "") { $listaMarcoDtInvalido[$obj->codigoFase]=""; }
		}
		//
		if (isset($listaMP[$obj->codigoFase][0])){
			if ($listaMP[$obj->codigoFase][0]<>$nvDataMarco){
				$alteracao=1;
			} else {
				$alteracao=0;
			}
		} else {
			$alteracao=1;
		}
		//
		if ( ( $alteracao == 1 ) and (!isset($listaMarcoDtInvalido[$obj->codigoFase])) ) {
			$listaMarco[$obj->codigoFase]=$nvDataMarco;
		}
	}
}
/*
echo "<pre>";
print_r($listaMP);
echo "</pre>";

echo "<pre>";
print_r($listaMarco);
echo "</pre>";

echo "<pre>";
print_r($listaMarcoDtInvalido);
echo "</pre>";
*/

if (isset($listaMarco)){
	foreach ($listaMarco as $key => $value){
		$dataMarco = $value;
		// Inclui o que não exite
		$FUNCOES->cadastro(	array(	
								"campos" 	=> " codigoMarco, codigoFrente, codigoFase, dataMarco, dataCadastro, horaCadastro, usuarioCadastro ",
								"tabelas" 	=> " dcd_marcofrente ",
								"values" 	=> " '', '$codigoFrente', '$key', '$value', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
						)
					);
		if($FUNCOES->GetLinhas()>0){
			$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
			$IU="m001/r001/f001/i003";
			$FUNCOES->navegacao("eventos","Cadastro","Planejamento do Projeto","");
		} else {
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
	}
}

if ($msn == ""){
	$msn="Nenhuma alteração foi realizada.";
}

if (isset($listaMarcoDtInvalido)){
	$msn.="<br><br>Algumas Datas informadas estão incorretas, por isso algumas alterações podem não ter sido realizada.<br>Verifique os campos sinalizados em vermelho.";
}

?>