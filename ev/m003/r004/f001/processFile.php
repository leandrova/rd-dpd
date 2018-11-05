<?
	$IU="m003/r004/f001/i002";
	//
	$nomeArquivo	= $_POST["nomeArquivo"];
	$path 			= "./import/";
	/**/
	$fp = fopen($path.substr($nomeArquivo, 0, -3).'log', 'w');
	/**/
	mysql_query("TRUNCATE dcd_import");
	/**/ 
	$FUNCOES->consulta(
				array(
					"tabelas" 	=> " dcd_tipossistema "
				)
			);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
		{
			$qnt=$qnt+1;
			$tiposSistema[$obj->nomeSistema]=$obj->codigoSistema;
		}
	}
	/**/
	$listaProcess[]="
		<table class=\"table table-striped table-condensed\">
		<thead>
			<tr>
				<th>id_requisicao</th>
				<th>sistema</th>
				<th>horas_planejadas</th>
				<th>mes_ref</th>
				<th>status</th>
			</tr>
		</thead>
		<tbody>";

	if (!file_exists($path.$nomeArquivo)){
		$IU="m003/r004/f001/i001";
		$msn="Não foi possivel identificar o arquivo.";
	} else {
		/* Processando Arquivo */
		$ponteiro = fopen ($path.$nomeArquivo, "r"); $i = 0;

		while (!feof ($ponteiro)) {
			$linha 	= utf8_encode(fgets($ponteiro, 4096));
			$pieces = explode(";", $linha);

			if (isset($tiposSistema[$pieces[5]])){
				$sistema = $tiposSistema[$pieces[5]];	
			} else {
				$sistema = 0;
			}

			if ( ($i > 0) && ($linha <> "") ) {
				/**/
				$FUNCOES->cadastro(
						array(
							"campos" 	=> " id_requisicao, sistema, horas_planejadas, mes_ref, num_linha_cap ",
							"tabelas" 	=> " dcd_import",
							"values" 	=> " '".$pieces[0]."', 
											 '".$sistema."', 
											 '".$pieces[6]."', 
											 '".$FUNCOES->dataInterna("01/".substr($pieces[14]+100,1,2)."/".substr($FUNCOES->dataInterna(substr($pieces[7], 0, 10)),0,4))."',
											 '".$pieces[22]."' "
						)
					);
				/**/
				if($FUNCOES->GetLinhas()>0)
				{
					$status = "OK";
				}
				else
				{
					$status="NOK (".$FUNCOES->GetMysqlError().")";

					$listaProcess[]="
			<tr>
				<td>".$pieces[0]."</td>
				<td>".$pieces[5]."</td>
				<td>".$pieces[6]."</td>
				<td>".substr($pieces[7], 0, 10)."</td>
				<td>".substr($pieces[14]+100,1,2)."/".substr($FUNCOES->dataInterna(substr($pieces[7], 0, 10)),0,4)."</td>
				<td>".$status."</td>
			</tr>";

				}
				/**/
			/**/
			fwrite($fp, $pieces[0].';'.$pieces[5].';'.$pieces[6].';'.substr($pieces[7], 0, 10).';'.substr($pieces[14]+100,1,2)."/".substr($FUNCOES->dataInterna(substr($pieces[7], 0, 10)),0,4).';'.$status);
			/**/
			}
			$i++;
		}
		/**/
		mysql_query("
			delete
			from 	dcd_sistemas
			where 	codigoRecursoSistemas = 3 and 
					codigoFrente in (
            			select 	df.codigoFrente 
            			from 	dcd_frentes df, dcd_import di
            			where 	codigoFrente = df.codigoFrente and
            					df.idFrente = di.id_requisicao
        			)
			");
		/**/ 
		mysql_query("	insert into dcd_sistemas (codigoTipoSistema, codigoFrente, codigoRecursoSistemas, dataAlocacao, quantidade, num_linha_cap)
						select di.sistema, df.codigoFrente, 3, di.mes_ref, di.horas_planejadas, di.num_linha_cap FROM dcd_import di, dcd_frentes df where di.id_requisicao = df.idFrente");
		if (mysql_affected_rows() > 0)
		{ 
			$msn="Processamento realizado com sucesso.";
		} else {
			$msn="Erro : ".$FUNCOES->GetMysqlError();
		}
		/**/
	}

	fclose($fp);

	$listaProcess[]="
		</table>";
?>