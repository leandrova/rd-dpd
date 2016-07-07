<?

$FUNCOES->consulta(array
			(
			"campos" 	=> " codigoOrigem, codigoTipoProjeto, codigoFase, (select 	horasEsforco from dcd_memoriaprojetos m1 where m1.codigoOrigem = o1.codigoOrigem and m1.codigoTipoProjeto = t1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase) horasEsforco ",
			"tabelas" 	=> " dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f1 ",
			"ordenacao" => " codigoOrigem, codigoTipoProjeto, codigoFase "
			)
		);
		
if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$listaHorasEsforco[$obj->codigoOrigem.";".$obj->codigoTipoProjeto.";".$obj->codigoFase]=$obj->horasEsforco;
	}
}

foreach ($listaHorasEsforco as $key => $value){

	list($codigoOrigem,$codigoTipoProjeto,$codigoFase) = explode(";",$key);
	
	if (isset($_POST["O".$codigoOrigem."T".$codigoTipoProjeto."F".$codigoFase])){
		$horasEsforco = $_POST["O".$codigoOrigem."T".$codigoTipoProjeto."F".$codigoFase];
		if ($horasEsforco <> $listaHorasEsforco[$key]){
			/* */
			if ($listaHorasEsforco[$key] == ""){
				/* Inclui o que não exite */
				$FUNCOES->cadastro(	array(	"campos" 	=> " codigoMemoria, codigoOrigem, codigoTipoProjeto, codigoFase, horasEsforco, dataCadastro, horaCadastro, usuarioCadastro ",
											"tabelas" 	=> " dcd_memoriaprojetos ",
											"values" 	=> " '', '$codigoOrigem', '$codigoTipoProjeto', '$codigoFase', '$horasEsforco', '".$FUNCOES->DATA."', '".$FUNCOES->HORA."', '".$USUARIO."' "
								)
							);
				if($FUNCOES->GetLinhas()>0){
					$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
					$IU="m003/r001/f001/i001";
					$FUNCOES->navegacao("eventos","Cadastro","Frente do Projeto","");
				} else {
					$msn="Erro : ".$FUNCOES->GetMysqlError();
				}
				/* */
			} else {
				/* Altera o que existe */
				$FUNCOES->altera(array(	"campos" 	=> " horasEsforco='".$horasEsforco."' ",
										"tabelas" 	=> " dcd_memoriaprojetos ",
										"condicoes" => " codigoOrigem = $codigoOrigem and codigoTipoProjeto= $codigoTipoProjeto and codigoFase = $codigoFase "));
				if($FUNCOES->GetLinhas()>0){
					$msn="Altera&ccedil;&atilde;o realizada com sucesso.";
					$IU="m003/r001/f001/i001";
					$FUNCOES->navegacao("eventos","Alteracao","Memória de Cálculo","");
				} else {
					$msn="Erro : ".$FUNCOES->GetMysqlError();
				}
			}
			/* */
		} else {
			/* */
		}
	}
}

if ($msn == ""){
	$msn="Nenhuma alteração foi realizada.";
}

?>