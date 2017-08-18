<?

/** Include PHPExcel */
require_once './iu/lib/js/PHPExcel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Canais Digitais Relatórios")
							 ->setLastModifiedBy("Canais Digitais - Relatórios")
							 ->setTitle("Export Projetos PP's")
							 ->setSubject("Export de todos os projetos PP's registrados no sistema.")
							 ->setDescription("Export de todos os projetos PP's registrados no sistema.")
							 ->setKeywords("Canais Digitais")
							 ->setCategory("Diretorio Infraestrutura e Desenvolvimento");

$sharedStyleTitulo 	= new PHPExcel_Style();
$sharedStyleTitulo2 = new PHPExcel_Style();
$sharedStyleLinha1 	= new PHPExcel_Style();
$sharedStyleLinha2 	= new PHPExcel_Style();
$sharedStyleBranco 	= new PHPExcel_Style();

$sharedStyleTitulo->applyFromArray(
	array(
		'fill' 	=> array(
					'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					'color'		=> array('rgb' => 'DFF0D8')
				),
		/*'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),*/
		'borders' => array(
					'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') )
				)
		 )
	);

$sharedStyleTitulo2->applyFromArray(
	array(
		'font'  => array(
	        'size'  => 20
	     ),
		'fill' 	=> array(
					'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					'color'		=> array('rgb' => 'DFF0D8')
				),
		/*'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),*/
		'borders' => array(
					'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') )
				)
		 )
	);

$sharedStyleBranco->applyFromArray(
	array(
		'borders' => array(
					'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') )
				)
		 )
	);
	
$sharedStyleLinha1->applyFromArray(
	array(
		'fill' 	=> array(
					'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					'color'		=> array('rgb' => 'F5F5F5')
				),
		'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_BOTTOM,
				),
		'borders' => array(
					'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') )
				)
		 )
	);

$sharedStyleLinha2->applyFromArray(
	array(
		'fill' 	=> array(
					'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					'color'		=> array('rgb' => 'FFFFFF')
				),
		'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
		'borders' => array(
					'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') )
				)
		 )
	);
	
// Abara de Entregas

$objPHPExcel->setActiveSheetIndex(0);

$FUNCOES->consulta(array
			(
			"campos" 	=> " 	p1.codigoProjeto, 
								p1.nomeProjeto, 
								f1.codigoFrente, 
								p1.descricao, 
								s1.descricaoStatus, 
								f1.prioridadeFrente, 
								f1.idFrente, 
								f1.nomeFrente, 
								f1.descricaoFrente, 
								o1.nomeOrigem, 
								r1.usuarioRecurso, 
								f2.nomeFase, 
								(select  dataInicioMarco from dcd_marcofrente mf where mf.codigoFase = f2.codigoFase and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataIniFase, 
								(select  dataFimMarco from dcd_marcofrente mf where mf.codigoFase = f2.codigoFase and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataFimFase, 
								descricaoTipo, 
								(select  dataInicioMarco from dcd_marcofrente mf where mf.codigoFase = 8 and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataFimProjeto, 
								as1.nomeArea,
								(select  sum(quantidade) from dcd_sistemas ds where ds.codigoFrente = f1.codigoFrente) quantidadeJornadas,
        						(select  sum(custo) from dcd_sistemas ds where ds.codigoFrente = f1.codigoFrente) custoJornadas,
        						f1.tipoPlanejamento ",
			"tabelas" 	=> " 	dcd_projetos p1, 
								dcd_frentes f1, 
								dcd_origemprojetos o1, 
								dcd_tiposprojeto t1, 
								dcd_fasesprojetos f2, 
								dcd_recursos r1, 
								dcd_memoriaprojetos m1, 
								dcd_statusprojeto s1, 
								dcd_areasolicitante as1  ",
			"condicoes"	=> " 	f1.codigoStatus = s1.codigoStatus and 
								p1.codigoProjeto = f1.codigoProjeto and 
								f1.codigoOrigem = o1.codigoOrigem and 
								f1.codigoTipoProjeto = t1.codigoTipoProjeto and 
								f1.codigoFase = f2.codigoFase and 
								f1.codigoRecurso = r1.codigoRecurso and 
								m1.codigoOrigem = f1.codigoOrigem and 
								m1.codigoTipoProjeto = f1.codigoTipoProjeto and 
								m1.codigoFase = f1.codigoFase and 
								f1.codigoArea = as1.codigoArea and 
								p1.nomeProjeto <> 'TESTE' and 
								f2.codigoFase <> 10 and 
								f1.codigoStatus = 1 and
								f1.codigoOrigem = 3 ",
			"ordenacao" => " 	16, 
								f1.prioridadeFrente, 
								o1.nomeOrigem, 
								f1.nomeFrente, 
								f1.dataCadastro "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	$tpStyle=0; $linha=0; $dataRelease = "";
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$linha=$linha+1; $dataFimProjetoTT = $obj->dataFimProjeto;
		if ($dataFimProjetoTT == ''){ $dataFimProjetoTT = "0000-00-00"; }

		if ($dataRelease <> $dataFimProjetoTT)
		{
		$dataRelease = $dataFimProjetoTT;
		if ($dataFimProjetoTT <> "0000-00-00"){ 
			$status = "Projetos da Release ".$FUNCOES->dataExterna($obj->dataFimProjeto); 
		} else { 
			$status = "Projetos a serem planejados "; 
		}
		$objPHPExcel->getActiveSheet()->setCellValue("A".$linha, $status);
		$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleTitulo2, "A".$linha.":M".$linha);
		$objPHPExcel->getActiveSheet()->getStyle("A".$linha.":M".$linha)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells("A".$linha.":M".$linha);
		$linha=$linha+1;
		$objPHPExcel->getActiveSheet()->setCellValue("A".$linha, 'Prioridade');
		$objPHPExcel->getActiveSheet()->setCellValue("B".$linha, 'Codigo');
		$objPHPExcel->getActiveSheet()->setCellValue("C".$linha, 'Projeto');
		$objPHPExcel->getActiveSheet()->setCellValue("D".$linha, 'Origem');
		$objPHPExcel->getActiveSheet()->setCellValue("E".$linha, 'Projeto');
		$objPHPExcel->getActiveSheet()->setCellValue("F".$linha, 'Release');
		$objPHPExcel->getActiveSheet()->setCellValue("G".$linha, 'Status');
		$objPHPExcel->getActiveSheet()->setCellValue("H".$linha, 'Fase');
		$objPHPExcel->getActiveSheet()->setCellValue("I".$linha, 'Planejamento');
		$objPHPExcel->getActiveSheet()->setCellValue("J".$linha, 'Historico');
		$objPHPExcel->getActiveSheet()->setCellValue("K".$linha, 'Analista');
		$objPHPExcel->getActiveSheet()->setCellValue("L".$linha, 'Jornadas');
		$objPHPExcel->getActiveSheet()->setCellValue("M".$linha, 'Custo');
		$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleTitulo, "A".$linha.":M".$linha."");
		$objPHPExcel->getActiveSheet()->getStyle("A".$linha.":M".$linha)->getFont()->setBold(true);
		$linha=$linha+1;
		}

		$objPHPExcel->getActiveSheet()->setCellValue("A".$linha, ($obj->prioridadeFrente > 0) ? $obj->prioridadeFrente : '') ;
		$objPHPExcel->getActiveSheet()->setCellValue("B".$linha, $obj->idFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$linha, $obj->nomeFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$linha, str_replace(chr(10),'', str_replace(chr(13),'',$obj->nomeOrigem) ) );

		$objPHPExcel->getActiveSheet()->setCellValue("E".$linha, $obj->nomeProjeto);

		if ($obj->dataFimProjeto <> null) { $dataFimProjeto = $FUNCOES->dataExterna($obj->dataFimProjeto); } else { $dataFimProjeto = "TBD"; }
		$objPHPExcel->getActiveSheet()->setCellValue("F".$linha, $dataFimProjeto);

		if ( ($obj->dataFimProjeto <> null) and ($obj->dataFimProjeto <> '0000-00-00') ) { 
			$tipoPlanejamento = ($obj->tipoPlanejamento) ? 'Planejado' : 'Previsto'; 
		} else { 
			$tipoPlanejamento = ""; 
		}

		$objPHPExcel->getActiveSheet()->setCellValue("G".$linha, $tipoPlanejamento);

		$objPHPExcel->getActiveSheet()->setCellValue("H".$linha, $obj->nomeFase);

		/* Buscando Planejamento */
		$res1 = mysql_query("
				select fp.nomeFase, fp.codigoFase, mf.dataInicioMarco, mf.dataFimMarco, mf.codigoMarco, mf.usuarioCadastro, mf.dataCadastro
				from dcd_fasesprojetos fp left join dcd_marcofrente mf on fp.codigoFase = mf.codigoFase and mf.codigoFrente = $obj->codigoFrente
				order by fp.codigoFase, mf.codigoMarco
			");
		$linhass=mysql_affected_rows(); $planejamento=""; unset($listPlanejamento);
		if ($linhass>0)
		{ 
			while ($objj=mysql_fetch_object($res1))
			{ 
				if ( ($objj->dataInicioMarco <> '0000-00-00') or ($objj->dataFimMarco <> '0000-00-00') )
				{
					if ($planejamento <> "") { $planejamento.="\n"; }
					$listPlanejamento[$objj->codigoFase]['nomeFase'] 		= $objj->nomeFase;
					$listPlanejamento[$objj->codigoFase]['dataInicioMarco'] = $FUNCOES->dataExterna($objj->dataInicioMarco);
					$listPlanejamento[$objj->codigoFase]['dataFimMarco'] 	= $FUNCOES->dataExterna($objj->dataFimMarco);
				}
			}
		}
		
		foreach ($listPlanejamento as $key => $value) {
			if ($planejamento <> "") { $planejamento.="\n"; }
			if ( ($listPlanejamento[$key]['dataInicioMarco'] <> "") or ($listPlanejamento[$key]['dataFimMarco'] <> "") ){
				$planejamento .= $listPlanejamento[$key]['nomeFase']." = ".$listPlanejamento[$key]['dataInicioMarco']." ".$listPlanejamento[$key]['dataFimMarco'];
			}
		}

		$objPHPExcel->getActiveSheet()->setCellValue("I".$linha, ($planejamento));

		/* Buscando Historico */
		$res1 = mysql_query("
				select	*
				from 	dcd_historico
				where	codigoFrente = $obj->codigoFrente
				order by dataHistorico desc
			");
		$linhass=mysql_affected_rows(); $historico="";
		if ($linhass>0)
		{ 
			while ($objj=mysql_fetch_object($res1))
			{ 
				if ($historico <> "") { $historico.="\n"; }
				$historico.=$FUNCOES->dataExterna($objj->dataHistorico)." - ".(strip_tags(html_entity_decode(($objj->descricaoHistorico))));
			}
		}
		$objPHPExcel->getActiveSheet()->setCellValue("J".$linha, utf8_encode($historico));
		
		$objPHPExcel->getActiveSheet()->setCellValue("K".$linha, $obj->usuarioRecurso);

		$objPHPExcel->getActiveSheet()->setCellValue("L".$linha, $FUNCOES->formataValor($obj->quantidadeJornadas/8));

		$objPHPExcel->getActiveSheet()->setCellValue("M".$linha, "R$ ".$FUNCOES->formataValor($obj->custoJornadas));


		/* Aplicando Style e Tamanho */
		if ($tpStyle == 0) { 
			$tpStyle=1;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha1, "A".$linha.":M".$linha."");
		} else { 
			$tpStyle=0;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha2, "A".$linha.":M".$linha."");
		}
		$objPHPExcel->getActiveSheet()->getRowDimension($linha)->setRowHeight(30);
	}
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Status Release');

/* Aplicando Alinhamento */
$objPHPExcel->getActiveSheet()->getStyle("A1:M".$linha)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

/* Aplicando Quebra de Linha */
$objPHPExcel->getActiveSheet()->getStyle("A1:M".$linha)->getAlignment()->setWrapText(true);

// Largura e Altura das Linhas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);

// Aba de Projetos

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nome Projeto');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Descricao');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Codigo');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Nome Frente');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Descricao Frente');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Origem');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Area');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Recurso');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Fase');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Plan. Ini Fase');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Plan. Fim Fase');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Tipo');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Historico');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Plan. Fim Projeto');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'Planejamento');


$FUNCOES->consulta(array
			(
			"campos" 	=> "p1.codigoProjeto, 
							p1.nomeProjeto, 
							f1.codigoFrente, 
							p1.descricao, 
							s1.descricaoStatus, 
							f1.idFrente, 
							f1.nomeFrente, 
							f1.descricaoFrente, 
							o1.nomeOrigem, 
							r1.usuarioRecurso, 
							f2.nomeFase, 
							(select  dataInicioMarco from dcd_marcofrente mf where mf.codigoFase = f2.codigoFase and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataIniFase, 
							(select  dataFimMarco from dcd_marcofrente mf where mf.codigoFase = f2.codigoFase and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataFimFase, 
							descricaoTipo, 
							(select  dataInicioMarco from dcd_marcofrente mf where mf.codigoFase = 8 and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataFimProjeto, 
							as1.nomeArea,
							f1.tipoPlanejamento ",
			"tabelas" 	=> "dcd_projetos p1, 
							dcd_frentes f1, 
							dcd_origemprojetos o1, 
							dcd_tiposprojeto t1, 
							dcd_fasesprojetos f2, 
							dcd_recursos r1, 
							dcd_memoriaprojetos m1, 
							dcd_statusprojeto s1, 
							dcd_areasolicitante as1  ",
			"condicoes"	=> "f1.codigoStatus = s1.codigoStatus and 
							p1.codigoProjeto = f1.codigoProjeto and 
							f1.codigoOrigem = o1.codigoOrigem and 
							f1.codigoTipoProjeto = t1.codigoTipoProjeto and 
							f1.codigoFase = f2.codigoFase and 
							f1.codigoRecurso = r1.codigoRecurso and 
							m1.codigoOrigem = f1.codigoOrigem and 
							m1.codigoTipoProjeto = f1.codigoTipoProjeto and 
							m1.codigoFase = f1.codigoFase and 
							f1.codigoArea = as1.codigoArea and
							f1.codigoOrigem = 3 and 
							f1.codigoStatus = 1 ",
			"ordenacao" => "p1.nomeProjeto, 
							f1.nomeFrente, 
							f1.dataCadastro "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	$tpStyle=0; $linha=1;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		if ($obj->nomeFase == "Concluido") { $obj->descricaoStatus = $obj->nomeFase; }
		$linha=$linha+1;
		$objPHPExcel->getActiveSheet()->setCellValue("A".$linha, $obj->nomeProjeto);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$linha, $obj->descricao);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$linha, $obj->idFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$linha, $obj->nomeFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("E".$linha, $obj->descricaoFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("F".$linha, $obj->descricaoStatus);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$linha, str_replace(chr(10),'', str_replace(chr(13),'',$obj->nomeOrigem) ) );
		$objPHPExcel->getActiveSheet()->setCellValue("H".$linha, str_replace(chr(10),'', str_replace(chr(13),'',$obj->nomeArea) ) );
		$objPHPExcel->getActiveSheet()->setCellValue("I".$linha, $obj->usuarioRecurso);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$linha, $obj->nomeFase);
		
		if ($obj->dataIniFase <> null) { $dataIniFase = $FUNCOES->dataExterna($obj->dataIniFase); } else { $dataIniFase = "TBD"; }
		$objPHPExcel->getActiveSheet()->setCellValue("K".$linha, $dataIniFase);

		if ($obj->dataFimFase <> null) { $dataFimFase = $FUNCOES->dataExterna($obj->dataFimFase); } else { $dataFimFase = "TBD"; }
		$objPHPExcel->getActiveSheet()->setCellValue("L".$linha, $dataFimFase);
		
		$objPHPExcel->getActiveSheet()->setCellValue("M".$linha, $obj->descricaoTipo);
		
		/* Buscando Historico */
		$res1 = mysql_query("
				select	*
				from 	dcd_historico
				where	codigoFrente = $obj->codigoFrente
				order by dataHistorico desc
			");
		$linhass=mysql_affected_rows(); $historico="";
		if ($linhass>0)
		{ 
			while ($objj=mysql_fetch_object($res1))
			{ 
				if ($historico <> "") { $historico.="\n"; }
				$historico.=$FUNCOES->dataExterna($objj->dataHistorico)." - ".(strip_tags(html_entity_decode($objj->descricaoHistorico)));
			}
		}
		$objPHPExcel->getActiveSheet()->setCellValue("N".$linha, $historico);
		
		if ($obj->dataFimProjeto <> null) { $dataFimProjeto = $FUNCOES->dataExterna($obj->dataFimProjeto); } else { $dataFimProjeto = "TBD"; }
		$objPHPExcel->getActiveSheet()->setCellValue("O".$linha, $dataFimProjeto);

		if ( ($obj->dataFimProjeto <> null) and ($obj->dataFimProjeto <> '0000-00-00') ) { 
			$tipoPlanejamento = ($obj->tipoPlanejamento) ? 'Planejado' : 'Previsto'; 
		} else { 
			$tipoPlanejamento = ""; 
		}

		$objPHPExcel->getActiveSheet()->setCellValue("P".$linha, $tipoPlanejamento);
		
		/* Aplicando Style e Tamanho */
		if ($tpStyle == 0) { 
			$tpStyle=1;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha1, "A".$linha.":P".$linha."");
		} else { 
			$tpStyle=0;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha2, "A".$linha.":P".$linha."");
		}
		$objPHPExcel->getActiveSheet()->getRowDimension($linha)->setRowHeight(15);
	}
}

/* Buscando TT Projetos */
$res1 = mysql_query("select count(*) total from dcd_projetos");
$linhass=mysql_affected_rows(); $historico="";
if ($linhass>0)
{ 
	$objj=mysql_fetch_object($res1);
	$ttProjetos=$objj->total;
}

$objPHPExcel->getActiveSheet()->setCellValue("A".($linha+1), "Total de Projetos: ".$ttProjetos);
$objPHPExcel->getActiveSheet()->setCellValue("A".($linha+2), "Total de Frentes: ".$linha);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Lista de Projetos');

/* Aplicando Alinhamento */
$objPHPExcel->getActiveSheet()->getStyle("A".$linha.":P".$linha)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

/* Aplicando Quebra de Linha */
$objPHPExcel->getActiveSheet()->getStyle("A1:P".$linha)->getAlignment()->setWrapText(true);

// Set title row bold
$objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);

// Largura e Altura das Linhas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);

/* Aplicando Style do Titulo */
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleTitulo, "A1:P1");

// Set autofilter
$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());

// Set document security
/*$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");*/

// Set sheet security
/*$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);*/

// Aba de Esforco

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Numero Frente');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nome Frente');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Origem');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Alocação');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Nome Recurso');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Sistema');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Jornadas');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'CAP');

$FUNCOES->consulta(array
			(
			"tabelas" 	=> " (
								select 	df.idFrente, 
										df.nomeFrente, 
										do.nomeOrigem, 
										ds.dataAlocacao, 
										dr.nomeRecurso, 
										dt.nomeSistema, 
										ds.quantidade, 
										convert(ds.quantidade/8, DECIMAL(10,2)) jornadas,
										ds.num_linha_cap num_linha_cap
								from 	dcd_sistemas ds, 
										dcd_frentes df, 
										dcd_fasesprojetos dp, 
										dcd_recursosistemas dr, 
										dcd_tipossistema dt, 
										dcd_origemprojetos do 
								where 	ds.codigoFrente = df.codigoFrente and 
										df.codigoFase = dp.codigoFase and 
										ds.codigoRecursoSistemas = dr.codigoRecursoSistemas and 
										ds.codigoTipoSistema = dt.codigoSistema and 
										df.codigoOrigem = do.codigoOrigem and
										df.codigoOrigem = 3
								UNION ALL 
								select 	'N/A', 'N/A', 
										do.nomeOrigem, 
										dj.dataAlocacao, 
										dj.nomeRecurso, 
										dr.usuarioRecurso, 
										dj.quantidade, 
										dj.quantidade jornadas,
										'' num_linha_cap
								from 	dcd_jornadasfixas dj, 
										dcd_recursos dr, 
										dcd_origemprojetos do 
								where 	dj.codigoRecurso = dr.codigoRecurso and 
										dj.codigoOrigem = do.codigoOrigem and 
										dj.codigoOrigem = 3
								) tabela ",
			"ordenacao" => " 4, 3, 1, 5, 6 "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	$tpStyle=0; $linha=1; $tpStyle = 1;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$linha=$linha+1;
		$objPHPExcel->getActiveSheet()->setCellValue("A".$linha, $obj->idFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$linha, $obj->nomeFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$linha, $obj->nomeOrigem);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$linha, str_replace("-", "", substr($obj->dataAlocacao, 0, 7)));
		$objPHPExcel->getActiveSheet()->setCellValue("E".$linha, $obj->nomeRecurso);
		$objPHPExcel->getActiveSheet()->setCellValue("F".$linha, $obj->nomeSistema);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$linha, $obj->jornadas);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$linha, $obj->num_linha_cap);
		
		if ($tpStyle == 0) { 
			$tpStyle=1;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha1, "A".$linha.":G".$linha."");
		} else { 
			$tpStyle=0;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha2, "A".$linha.":G".$linha."");
		}
		$objPHPExcel->getActiveSheet()->getRowDimension($linha)->setRowHeight(15);
	}
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Lista de Custos');

/* Aplicando Alinhamento */
$objPHPExcel->getActiveSheet()->getStyle("A".$linha.":H".$linha)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

/* Aplicando Quebra de Linha */
$objPHPExcel->getActiveSheet()->getStyle("A1:H".$linha)->getAlignment()->setWrapText(true);

// Set title row bold
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

// Largura e Altura das Linhas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

/* Aplicando Style do Titulo */
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleTitulo, "A1:H1");

// Set autofilter
$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());

/* #################### Definindo Aba 7 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Jornadas_Mes_PPs');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico); unset($arrayTT);
$arrayGrafico[]= array('', 'Total', 'Dev', 'Dev Loja', 'Dev Easy', 'Testes', 'Líder PP', 'Analista Funcional'); $linhas = 1;

$FUNCOES->consulta(array
			(
			"campos" 	=> "
							ds.dataAlocacao, 
							(	select 	convert(sum(ds1.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds1 
				            	where 	ds1.codigoRecursoSistemas = 3 and 
				            			ds1.dataAlocacao = ds.dataAlocacao and 
				            			ds1.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds1.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadas,
				            (	select 	convert(sum(ds2.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds2 
				            	where 	ds2.codigoRecursoSistemas = 3 and 
				            			ds2.dataAlocacao = ds.dataAlocacao and 
				            			ds2.codigoTipoSistema not in (70, 132, 141) and
				            			ds2.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds2.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimento,
				            (	select 	convert(sum(ds3.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds3 
				            	where 	ds3.codigoRecursoSistemas = 3 and 
				            			ds3.dataAlocacao = ds.dataAlocacao and 
				            			ds3.codigoTipoSistema in (70) and
				            			ds3.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds3.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoLoja,
				            (	select 	convert(sum(ds4.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds4 
				            	where 	ds4.codigoRecursoSistemas = 3 and 
				            			ds4.dataAlocacao = ds.dataAlocacao and 
				            			ds4.codigoTipoSistema in (141) and
				            			ds4.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds4.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoEasy,
				            (
				            	select 	convert(sum(ds5.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds5 
				            	where 	ds5.codigoRecursoSistemas = 3 and 
				            			ds5.dataAlocacao = ds.dataAlocacao and 
				            			ds5.codigoTipoSistema in (132) and
				            			ds5.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds5.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasTestes,
				            (
				            	select 	convert(sum(jf1.quantidade), DECIMAL(10,2)) jornadas 
				            	from 	dcd_jornadasfixas jf1 
				            	where 	jf1.dataAlocacao = ds.dataAlocacao and 
				            			jf1.nomeRecurso = 'ANALISTA FUNCIONAL' and
				            			jf1.codigoRecurso in (	select 	df.codigoRecurso
				            									from 	dcd_frentes df
				            									where 	df.codigoOrigem = 3
				            								)
				            ) jornadasAnalista,
				            (
				            	select 	convert(sum(jf2.quantidade), DECIMAL(10,2)) jornadas 
				            	from 	dcd_jornadasfixas jf2 
				            	where 	jf2.dataAlocacao = ds.dataAlocacao and 
				            			jf2.nomeRecurso = 'LÍDER PP'
				            ) jornadasLider 
							 ",
			"tabelas" 	=> " dcd_sistemas ds, dcd_frentes df, dcd_origemprojetos dp ",
			"condicoes"	=> " ds.codigoFrente = df.codigoFrente and df.codigoOrigem = dp.codigoOrigem and df.codigoOrigem = 3 group by 1 ",
			"ordenacao" => " ds.dataAlocacao "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	unset($array);
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$horasTT = 	($obj->jornadasDesenvolvimento + 0) + 
					($obj->jornadasTestes + 0) + 
					($obj->jornadasAnalista + 0) + 
					($obj->jornadasLider + 0) +
					($obj->jornadasDesenvolvimentoLoja + 0) +
					($obj->jornadasDesenvolvimentoEasy + 0);

		$array[$obj->dataAlocacao] = array ( 
						'jornadasTotal' => $horasTT,
						'jornadasDesenvolvimento' => ($obj->jornadasDesenvolvimento + 0),
						'jornadasDesenvolvimentoLoja' => ($obj->jornadasDesenvolvimentoLoja + 0),
						'jornadasDesenvolvimentoEasy' => ($obj->jornadasDesenvolvimentoEasy + 0),
						'jornadasTestes' => ($obj->jornadasTestes + 0),
						'jornadasLider' => ($obj->jornadasLider + 0),
						'jornadasAnalista' => ($obj->jornadasAnalista + 0)
					);
	}
}

$keyy = "";
foreach ($array as $key => $value) {
	if ($keyy == "") { $keyy = $key; }
	$dataAlocacao = $key;
	$arrayGrafico[] = array(
						substr($FUNCOES->dataExterna($dataAlocacao), -6), 
						$value['jornadasTotal'], 
						$value['jornadasDesenvolvimento'], 
						$value['jornadasDesenvolvimentoLoja'], 
						$value['jornadasDesenvolvimentoEasy'], 
						$value['jornadasTestes'], 
						$value['jornadasLider'], 
						$value['jornadasAnalista']);
	$linhas++;
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$B$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$C$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$D$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$E$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$F$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$G$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$H$1', NULL, 1),
);


$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$A$2:$A$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_PPs!$B$2:$B$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_PPs!$C$2:$C$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_PPs!$D$2:$D$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_PPs!$E$2:$E$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_PPs!$F$2:$F$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_PPs!$G$2:$G$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_PPs!$H$2:$H$'.$linhas.'', NULL, 4),
);

$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);

$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Jornadas PPs');
$yAxisLabel = new PHPExcel_Chart_Title('Jornadas');

//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);

//	Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('A1');
$chart->setBottomRightPosition('O25');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:AI50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

/* #################### Fim Definindo Aba 7 ######################## */

/* #################### Definindo Aba 7 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(4);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Fases_Projetos_PPs');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico); unset($arrayTT);
$arrayGrafico[]= array('Fases','Quantidade'); $linhas = 1;

$FUNCOES->consulta(array
			(
			"campos" 	=> " dp.nomeFase , count(1) quantidade ",
			"tabelas" 	=> " dcd_frentes df, dcd_fasesprojetos dp ",
			"condicoes"	=> " codigoOrigem = 3 and 
							 df.codigoFase = dp.codigoFase and 
							 df.codigoFase <> 10 and
							 df.codigoStatus = 1
							 group by dp.nomeFase ",
			"ordenacao" => " df.codigoFase "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	unset($array);
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$arrayGrafico[] = array($obj->nomeFase, $obj->quantidade);
		$linhas++;
	}
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Fases_Projetos_PPs!$A$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Fases_Projetos_PPs!$B$1', NULL, 1),
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Fases_Projetos_PPs!$A$2:$A$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Fases_Projetos_PPs!$B$2:$B$'.$linhas.'', NULL, 4),
);

$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);

$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Fases PPs');
$yAxisLabel = new PHPExcel_Chart_Title('Quantidade');

//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);

//	Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('A1');
$chart->setBottomRightPosition('O25');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:AI50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

/* #################### Fim Definindo Aba 7 ######################## */

/* #################### Definindo Aba 7 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(5);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Projetos_Alocacao_PPs');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico); unset($arrayTT);
//$arrayGrafico[]= array('Alocacao', 'Fases', 'Quantidade'); $linhas = 1;

$FUNCOES->consulta(array
			(
			"tabelas" 	=> " 
							 (
								SELECT 	dr.usuarioRecurso, df.codigoFase, dp.nomeFase, count(1) quantidade
								FROM 	dcd_frentes df, dcd_recursos dr, dcd_fasesprojetos dp
								WHERE	df.codigoRecurso = dr.codigoRecurso and df.codigoFase = dp.codigoFase and 
										df.codigoProjeto <> 1 and df.codigoFase <> 10 and df.codigoStatus = 1
								group by dr.usuarioRecurso, df.codigoFase, dp.nomeFase
								UNION ALL
								SELECT 	dr.usuarioRecurso, 99 codigoFase, 'Total' nomeFase, count(1) quantidade
								FROM 	dcd_frentes df, dcd_recursos dr, dcd_fasesprojetos dp
								WHERE	df.codigoRecurso = dr.codigoRecurso and df.codigoFase = dp.codigoFase and 
										df.codigoProjeto <> 1 and df.codigoFase <> 10 and df.codigoStatus = 1
								group by dr.usuarioRecurso
    						 ) tabela
			",
			"ordenacao" => " 1, 2 "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	unset($array); $usuarioRecurso = ""; $linhas = 0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		if ( $usuarioRecurso <> $obj->usuarioRecurso ) { $usuarioRecurso = $obj->usuarioRecurso; $nome=$usuarioRecurso; } else { $nome = ""; }
		$arrayGrafico[] = array($nome, $obj->nomeFase, $obj->quantidade);
		$linhas++;
	}
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Alocacao_PPs!$A$'.$linhas.'', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Alocacao_PPs!$B$'.$linhas.'', NULL, 1),
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Alocacao_PPs!$A$1:$B$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Alocacao_PPs!$C$1:$C$'.$linhas.'', NULL, 4),
);

$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);

$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Alocacao PPs');
$yAxisLabel = new PHPExcel_Chart_Title('Quantidade');

//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);

//	Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('A1');
$chart->setBottomRightPosition('O25');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:AI50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

/* #################### Fim Definindo Aba 7 ######################## */

/* #################### Definindo Aba 8 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(6);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Projetos_Segmento_PPs');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico); unset($arrayTT);
//$arrayGrafico[]= array('Alocacao', 'Fases', 'Quantidade'); $linhas = 1;

$FUNCOES->consulta(array
			(
			"tabelas" 	=> " 
							 (
								SELECT	dp.nomeProjeto, dfp.codigoFase, dfp.nomeFase, count(1) quantidade
								FROM	dcd_frentes df, dcd_projetos dp, dcd_fasesprojetos dfp
								WHERE	df.codigoProjeto = dp.codigoProjeto and 
										df.codigoFase = dfp.codigoFase and
										df.codigoProjeto <> 1 and 
										df.codigoFase <> 10 and 
										df.codigoStatus = 1
								GROUP BY 1, 2, 3
								UNION ALL
								SELECT	dp.nomeProjeto, 99 codigoFase, 'Total' quantidade, count(1)
								FROM	dcd_frentes df, dcd_projetos dp, dcd_fasesprojetos dfp
								WHERE	df.codigoProjeto = dp.codigoProjeto and 
										df.codigoFase = dfp.codigoFase and
										df.codigoProjeto <> 1 and 
										df.codigoFase <> 10 and 
										df.codigoStatus = 1
								GROUP BY 1, 2, 3
    						 ) tabela
			",
			"ordenacao" => " 1, 2 "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	unset($array); $nomeProjeto = ""; $linhas = 0;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		if ( $nomeProjeto <> $obj->nomeProjeto ) { $nomeProjeto = $obj->nomeProjeto; $nome=$nomeProjeto; } else { $nome = ""; }
		$arrayGrafico[] = array($nome, $obj->nomeFase, $obj->quantidade);
		$linhas++;
	}
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Segmento_PPs!$A$'.$linhas.'', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Segmento_PPs!$B$'.$linhas.'', NULL, 1),
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Segmento_PPs!$A$1:$B$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Segmento_PPs!$C$1:$C$'.$linhas.'', NULL, 4),
);

$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);

$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Alocacao por Segmento PPs');
$yAxisLabel = new PHPExcel_Chart_Title('Quantidade');

//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);

//	Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('A1');
$chart->setBottomRightPosition('O25');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:AI50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

/* #################### Fim Definindo Aba 7 ######################## */

/* #################### Definindo Aba 7 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(7);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Jornadas_Mes_Dev_PPs');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico); unset($arrayTT);
//$arrayGrafico[]= array('', 'Total', 'MV PF Fixa', 'MV PF Móvel', 'MV PJ', 'Portal', 'Loja', 'Vivo Easy', 'Demais', 'Testes' ); $linhas = 1;

$FUNCOES->consulta(array
			(
			"campos" 	=> "
							ds.dataAlocacao, 
							(	select 	convert(sum(ds1.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds1 
				            	where 	ds1.codigoRecursoSistemas = 3 and 
				            			ds1.dataAlocacao = ds.dataAlocacao and 
				            			ds1.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds1.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadas,
				            (	select 	convert(sum(ds2.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds2 
				            	where 	ds2.codigoRecursoSistemas = 3 and 
				            			ds2.dataAlocacao = ds.dataAlocacao and 
				            			ds2.codigoTipoSistema in (59) and
				            			ds2.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds2.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoMVPFFixa,
                            (	select 	convert(sum(ds2.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds2 
				            	where 	ds2.codigoRecursoSistemas = 3 and 
				            			ds2.dataAlocacao = ds.dataAlocacao and 
				            			ds2.codigoTipoSistema in (60) and
				            			ds2.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds2.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoMVPFMovel,
                            (	select 	convert(sum(ds2.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds2 
				            	where 	ds2.codigoRecursoSistemas = 3 and 
				            			ds2.dataAlocacao = ds.dataAlocacao and 
				            			ds2.codigoTipoSistema in (61) and
				            			ds2.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds2.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoMVPJ,
                            (	select 	convert(sum(ds2.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds2 
				            	where 	ds2.codigoRecursoSistemas = 3 and 
				            			ds2.dataAlocacao = ds.dataAlocacao and 
				            			ds2.codigoTipoSistema in (80) and
				            			ds2.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds2.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoPortal,
				            (	select 	convert(sum(ds3.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds3 
				            	where 	ds3.codigoRecursoSistemas = 3 and 
				            			ds3.dataAlocacao = ds.dataAlocacao and 
				            			ds3.codigoTipoSistema in (70) and
				            			ds3.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds3.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoLoja,
				            (	select 	convert(sum(ds4.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds4 
				            	where 	ds4.codigoRecursoSistemas = 3 and 
				            			ds4.dataAlocacao = ds.dataAlocacao and 
				            			ds4.codigoTipoSistema in (141) and
				            			ds4.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds4.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoEasy,
                            (
				            	select 	convert(sum(ds5.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds5 
				            	where 	ds5.codigoRecursoSistemas = 3 and 
				            			ds5.dataAlocacao = ds.dataAlocacao and 
				            			ds5.codigoTipoSistema not in (59, 60, 61, 70, 80, 132, 141) and
				            			ds5.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds5.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasDesenvolvimentoDemais,
				            (
				            	select 	convert(sum(ds5.quantidade)/8, DECIMAL(10,2)) jornadas 
				            	from 	dcd_sistemas ds5 
				            	where 	ds5.codigoRecursoSistemas = 3 and 
				            			ds5.dataAlocacao = ds.dataAlocacao and 
				            			ds5.codigoTipoSistema in (132) and
				            			ds5.codigoFrente in (	select 	df.codigoFrente 
				            									from 	dcd_frentes df
				            									where 	df.codigoFrente = ds5.codigoFrente and
				            											df.codigoOrigem = 3
				            								)
				            ) jornadasTestes,
				            (
				            	select 	convert(sum(jf1.quantidade), DECIMAL(10,2)) jornadas 
				            	from 	dcd_jornadasfixas jf1 
				            	where 	jf1.dataAlocacao = ds.dataAlocacao and 
				            			jf1.nomeRecurso = 'ANALISTA FUNCIONAL' and
				            			jf1.codigoRecurso in (	select 	df.codigoRecurso
				            									from 	dcd_frentes df
				            									where 	df.codigoOrigem = 3
				            								)
				            ) jornadasAnalista,
				            (
				            	select 	convert(sum(jf2.quantidade), DECIMAL(10,2)) jornadas 
				            	from 	dcd_jornadasfixas jf2 
				            	where 	jf2.dataAlocacao = ds.dataAlocacao and 
				            			jf2.nomeRecurso = 'LÍDER PP'
				            ) jornadasLider 
							 ",
			"tabelas" 	=> " dcd_sistemas ds, dcd_frentes df, dcd_origemprojetos dp ",
			"condicoes"	=> " ds.codigoFrente = df.codigoFrente and df.codigoOrigem = dp.codigoOrigem and df.codigoOrigem = 3 group by 1 ",
			"ordenacao" => " ds.dataAlocacao "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	unset($array);
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$array[$obj->dataAlocacao] = array ( 
						'jornadasTotal' => $obj->jornadas,
						'jornadasDesenvolvimentoMVPFFixa' => ($obj->jornadasDesenvolvimentoMVPFFixa + 0),
						'jornadasDesenvolvimentoMVPFMovel' => ($obj->jornadasDesenvolvimentoMVPFMovel + 0),
						'jornadasDesenvolvimentoMVPJ' => ($obj->jornadasDesenvolvimentoMVPJ + 0),
						'jornadasDesenvolvimentoPortal' => ($obj->jornadasDesenvolvimentoPortal + 0),
						'jornadasDesenvolvimentoLoja' => ($obj->jornadasDesenvolvimentoLoja + 0),
						'jornadasDesenvolvimentoEasy' => ($obj->jornadasDesenvolvimentoEasy + 0),
						'jornadasDesenvolvimentoDemais' => ($obj->jornadasDesenvolvimentoDemais + 0),
						'jornadasTestes' => ($obj->jornadasTestes + 0)
					);
	}
}

$keyy = "";
foreach ($array as $key => $value) {
	if ($keyy == "") { $keyy = $key; }
	$dataAlocacao = $key;
	$arrayGrafico[] = array(substr($FUNCOES->dataExterna($dataAlocacao), -6), 'Total', $value['jornadasTotal']	); $linhas++;
	$arrayGrafico[] = array('', 'MV PF Fixa'	, $value['jornadasDesenvolvimentoMVPFFixa']						); $linhas++;
	$arrayGrafico[] = array('', 'MV PF Móvel'	, $value['jornadasDesenvolvimentoMVPFMovel']					); $linhas++;
	$arrayGrafico[] = array('', 'MV PJ'			, $value['jornadasDesenvolvimentoMVPJ']							); $linhas++;
	$arrayGrafico[] = array('', 'Portal'		, $value['jornadasDesenvolvimentoPortal']						); $linhas++;
	$arrayGrafico[] = array('', 'Loja'			, $value['jornadasDesenvolvimentoLoja']							); $linhas++;
	$arrayGrafico[] = array('', 'Vivo Easy'		, $value['jornadasDesenvolvimentoEasy']							); $linhas++;
	$arrayGrafico[] = array('', 'Demais'		, $value['jornadasDesenvolvimentoDemais']						); $linhas++;
	$arrayGrafico[] = array('', 'Testes'		,$value['jornadasTestes']										); $linhas++;
}

$objWorksheet->fromArray($arrayGrafico);

unset($dataseriesLabels, $xAxisTickValues, $dataSeriesValues);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_Dev_PPs!$C$1', NULL, 1)
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_Dev_PPs!$A$1:$B$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes_Dev_PPs!$C$1:$C$'.$linhas.'', NULL, 4)
);

$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);

$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Jornadas Desenvolvimento');
$yAxisLabel = new PHPExcel_Chart_Title('Jornadas');

//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);

//	Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('A1');
$chart->setBottomRightPosition('O25');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:AI50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

/* #################### Fim Definindo Aba 7 ######################## */

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel 2007 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$nomeArquivo = "export_412_".str_replace("-","",$FUNCOES->DATA).str_replace(":","",$FUNCOES->HORA)."_projetos.xlsx";
$path = "./export/$nomeArquivo";
$objWriter->save($path);

$msn="Arquivo Gerado com sucesso!";
/* */
?>