<?

$codigoFrente		="";	If (isset($_POST["codigoFrente"]))		{	$codigoFrente 		= $_POST["codigoFrente"]; 		}
$tipoPlanejamento	="";	If (isset($_POST["tipoPlanejamento"]))	{	$tipoPlanejamento 	= $_POST["tipoPlanejamento"]; 	}

$FUNCOES->consulta(array ( 
					"campos"	=> " fp.nomeFase, fp.codigoFase, mf.dataInicioMarco, mf.dataFimMarco, mf.codigoMarco, mf.usuarioCadastro, mf.dataCadastro", 
					"tabelas" 	=> " dcd_fasesprojetos fp left join dcd_marcofrente mf on fp.codigoFase = mf.codigoFase and mf.codigoFrente = $codigoFrente",
					"condicoes"	=> " dataInicioMarco is not null and dataFimMarco is not null ",
					"ordenacao"	=> " fp.codigoFase, mf.codigoMarco desc "
					)
				);
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$listaMP[$obj->codigoFase][]=$obj->dataInicioMarco."#".$obj->dataFimMarco;
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
		$nvDataInicioMarco = $_POST["dataInicioMarco".$obj->codigoFase];
		if ( ($nvDataInicioMarco == "") or (strtoupper($nvDataInicioMarco) == "TBD") ) {
			$nvDataInicioMarco="0000-00-00";
		}  else {
			$nvDataInicioMarco = $FUNCOES->dataInterna($nvDataInicioMarco);
			if ($nvDataInicioMarco == "") { $listaMarcoDtInvalido[$obj->codigoFase]=""; }
		}
		//
		list($LMPdataInicioMarco, $LMPdataFimMarco)  = explode("#",$listaMP[$obj->codigoFase][0]);
		//
		if (isset($listaMP[$obj->codigoFase][0])){
			if ($LMPdataInicioMarco<>$nvDataInicioMarco){
				$alteracao=1;
			} else {
				$alteracao=0;
			}
		} else {
			$alteracao=1;
		}
		//
		$nvDataFimMarco = $_POST["dataFimMarco".$obj->codigoFase];
		if ( ($nvDataFimMarco == "") or (strtoupper($nvDataFimMarco) == "TBD") ) {
			$nvDataFimMarco="0000-00-00";
		}  else {
			$nvDataFimMarco = $FUNCOES->dataInterna($nvDataFimMarco);
			if ($nvDataFimMarco == "") { $listaMarcoDtInvalido[$obj->codigoFase]=""; }
		}
		//
		if (isset($listaMP[$obj->codigoFase][0])){
			if ($LMPdataFimMarco<>$nvDataFimMarco){
				$alteracao2=1;
			} else {
				$alteracao2=0;
			}
		} else {
			$alteracao2=1;
		}
		//

		if ( ( $alteracao == 1 ) and (!isset($listaMarcoDtInvalido[$obj->codigoFase])) ) {
			$listaMarco[$obj->codigoFase] = $nvDataInicioMarco."#".$nvDataFimMarco;
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
		list($dataInicioMarco, $dataFimMarco)  = explode("#",$value);
		// Inclui o que não exite
		$FUNCOES->cadastro(	array(	
								"campos" 	=> " codigoMarco, codigoFrente, codigoFase, dataInicioMarco, dataFimMarco, dataCadastro, horaCadastro, usuarioCadastro ",
								"tabelas" 	=> " dcd_marcofrente ",
								"values" 	=> " '', '$codigoFrente', '$key', '$dataInicioMarco', '$dataFimMarco', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
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