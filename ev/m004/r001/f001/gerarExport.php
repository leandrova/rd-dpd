<?

/** Include PHPExcel */
require_once './iu/lib/js/PHPExcel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Canais Digitais Relatórios")
							 ->setLastModifiedBy("Canais Digitais - Relatórios")
							 ->setTitle("Export Todos Projetos")
							 ->setSubject("Export de todos os projetos registrados no sistema.")
							 ->setDescription("Export de todos os projetos registrados no sistema.")
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
			"tabelas" 	=> " 	dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1, dcd_areasolicitante as1  ",
			"condicoes"	=> " 	f1.codigoStatus = s1.codigoStatus and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase and f1.codigoArea = as1.codigoArea and p1.nomeProjeto <> 'TESTE' and f2.codigoFase <> 10 and f1.codigoStatus = 1 ",
			"ordenacao" => " 	16, f1.prioridadeFrente, o1.nomeOrigem, f1.nomeFrente, f1.dataCadastro "
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


$FUNCOES->consulta(array
			(
			"campos" 	=> " p1.codigoProjeto, p1.nomeProjeto, f1.codigoFrente, p1.descricao, s1.descricaoStatus, f1.idFrente, f1.nomeFrente, f1.descricaoFrente, 
							o1.nomeOrigem, r1.usuarioRecurso, f2.nomeFase, 
							(select  dataInicioMarco from dcd_marcofrente mf where mf.codigoFase = f2.codigoFase and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataIniFase, 
							(select  dataFimMarco from dcd_marcofrente mf where mf.codigoFase = f2.codigoFase and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataFimFase, 
							descricaoTipo, 
							(select  dataFimMarco from dcd_marcofrente mf where mf.codigoFase = 8 and mf.codigoFrente = f1.codigoFrente order by codigoMarco desc limit 1) dataFimProjeto, 
							as1.nomeArea ",
			"tabelas" 	=> " dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1, dcd_areasolicitante as1  ",
			"condicoes"	=> " f1.codigoStatus = s1.codigoStatus and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase and f1.codigoArea = as1.codigoArea",
			"ordenacao" => " p1.nomeProjeto, f1.nomeFrente, f1.dataCadastro "
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
		
		/* Aplicando Style e Tamanho */
		if ($tpStyle == 0) { 
			$tpStyle=1;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha1, "A".$linha.":O".$linha."");
		} else { 
			$tpStyle=0;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha2, "A".$linha.":O".$linha."");
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
$objPHPExcel->getActiveSheet()->getStyle("A".$linha.":O".$linha)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

/* Aplicando Quebra de Linha */
$objPHPExcel->getActiveSheet()->getStyle("A1:O".$linha)->getAlignment()->setWrapText(true);

// Set title row bold
$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);

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

/* Aplicando Style do Titulo */
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleTitulo, "A1:O1");

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

$FUNCOES->consulta(array
			(
			"tabelas" 	=> " (
								select df.idFrente, df.nomeFrente, do.nomeOrigem, ds.dataAlocacao, dr.nomeRecurso, dt.nomeSistema, ds.quantidade, convert(ds.quantidade/8, DECIMAL(10,2)) jornadas
								from dcd_sistemas ds, dcd_frentes df, dcd_fasesprojetos dp, dcd_recursosistemas dr, dcd_tipossistema dt, dcd_origemprojetos do 
								where ds.codigoFrente = df.codigoFrente and df.codigoFase = dp.codigoFase and ds.codigoRecursoSistemas = dr.codigoRecursoSistemas and ds.codigoTipoSistema = dt.codigoSistema and df.codigoOrigem = do.codigoOrigem 
								UNION ALL 
								select 'N/A', 'N/A', do.nomeOrigem, dj.dataAlocacao, dj.nomeRecurso, dr.usuarioRecurso, dj.quantidade, dj.quantidade jornadas
								from dcd_jornadasfixas dj, dcd_recursos dr, dcd_origemprojetos do 
								where dj.codigoRecurso = dr.codigoRecurso and dj.codigoOrigem = do.codigoOrigem 
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
$objPHPExcel->getActiveSheet()->getStyle("A".$linha.":G".$linha)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

/* Aplicando Quebra de Linha */
$objPHPExcel->getActiveSheet()->getStyle("A1:G".$linha)->getAlignment()->setWrapText(true);

// Set title row bold
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

// Largura e Altura das Linhas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

/* Aplicando Style do Titulo */
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleTitulo, "A1:G1");

// Set autofilter
$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());


/* #################### Definindo Aba 2 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Projetos_Por_Recurso');

$objWorksheet = $objPHPExcel->getActiveSheet();

$arrayGrafico[]= array('',			'Total',	"Concluido",	"Em Andamento",	"Parado",	"Cancelado");

$FUNCOES->consulta(array
			(
			"campos" 	=> " usuarioRecurso 'Recurso', (select count(1) from dcd_frentes df where df.codigoRecurso = dr.codigoRecurso) 'Total', (select count(1) from dcd_frentes df where df.codigoRecurso = dr.codigoRecurso and df.codigoFase = 11) 'Concluido', (select count(1) from dcd_frentes df where df.codigoRecurso = dr.codigoRecurso and df.codigoFase <> 11 and df.codigoStatus = 1 ) 'EmAndamento', (select count(1) from dcd_frentes df where df.codigoRecurso = dr.codigoRecurso and df.codigoFase <> 11 and df.codigoStatus = 2 ) 'Parado', (select count(1) from dcd_frentes df where df.codigoRecurso = dr.codigoRecurso and df.codigoFase <> 11 and df.codigoStatus = 3 ) 'Cancelado' ",
			"tabelas" 	=> " dcd_recursos dr  ",
			"ordenacao" => " 1 "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	$linhas=1;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$linhas=$linhas+1;
		$arrayGrafico[]= array($obj->Recurso, $obj->Total, $obj->Concluido, $obj->EmAndamento, $obj->Parado, $obj->Cancelado);
		
	}
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$B$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$C$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$D$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$E$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$F$1', NULL, 1),
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$A$2:$A$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$B$2:$B$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$C$2:$C$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$D$2:$D$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$E$2:$E$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$F$2:$F$'.$linhas.'', NULL, 4),
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

$title = new PHPExcel_Chart_Title('Projetos por Recurso');
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
$chart->setBottomRightPosition('K20');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:Z50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

// Set document security
/*$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");*/

// Set sheet security
/*$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);*/

/* #################### Recurso Horas ######################## */

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico);
$arrayGrafico[]= array('',			'Produtividade',	'Total',	"Em Andamento",	"Parado",	"Cancelado");

$FUNCOES->consulta(array
			(
			"campos" 	=> " 	usuarioRecurso 'Recurso', 
								(select round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*dc.deflatorCargo/100) from dcd_cargos dc, dcd_recursos dr1 where dr1.codigoCargo = dc.codigoCargo and dr1.codigoRecurso = dr.codigoRecurso) produtidadeMes,
								(select	time_format(sum(m1.horasEsforco), '%H') from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoRecurso = dr.codigoRecurso and f1.codigoFase <> 11 and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase) 'Total',
								(select	time_format(sum(m1.horasEsforco), '%H') from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoRecurso = dr.codigoRecurso and f1.codigoStatus = 1 and f1.codigoFase <> 11 and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase) 'EmAndamento',
								(select	time_format(sum(m1.horasEsforco), '%H') from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoRecurso = dr.codigoRecurso and f1.codigoStatus = 2 and f1.codigoFase <> 11 and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase) 'Parado',
								(select	time_format(sum(m1.horasEsforco), '%H') from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoRecurso = dr.codigoRecurso and f1.codigoStatus = 3 and f1.codigoFase <> 11 and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase) 'Cancelado' ",
			"tabelas" 	=> " dcd_recursos dr  ",
			"ordenacao" => " 1 "
			)
		);	
$linhas=0; 
if ($FUNCOES->GetLinhas()>0)
{
	$linhas=1;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$linhas=$linhas+1;
		$arrayGrafico[]= array($obj->Recurso, $obj->produtidadeMes, $obj->Total, $obj->EmAndamento, $obj->Parado, $obj->Cancelado);
		
	}
}

$objWorksheet->fromArray($arrayGrafico, null, 'L1');

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$M$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$N$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$O$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$P$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$Q$1', NULL, 1),
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Projetos_Por_Recurso!$L$2:$L$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$M$2:$M$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$N$2:$N$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$O$2:$O$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$P$2:$P$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Projetos_Por_Recurso!$Q$2:$Q$'.$linhas.'', NULL, 4),
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

$title = new PHPExcel_Chart_Title('Projetos por Recurso');
$yAxisLabel = new PHPExcel_Chart_Title('Horas');

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
$chart->setTopLeftPosition('L1');
$chart->setBottomRightPosition('U20');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:Z50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

/* #################### Fim Definindo Aba 2 ######################## */

/* #################### Definindo Aba 3 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(4);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Top10_Projetos');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico);
$arrayGrafico[]= array('',			'Total de Projetos', 'Em Andamento');

$FUNCOES->consulta(array
			(
			"campos" 	=> " nomeProjeto, (select count(1) from dcd_frentes df where df.codigoProjeto = dp.codigoProjeto) Quantidade, (select count(1) from dcd_frentes df where df.codigoProjeto = dp.codigoProjeto and df.codigoFase = 11) 'Concluido', (select count(1) from dcd_frentes df where df.codigoProjeto = dp.codigoProjeto and df.codigoFase <> 11 and df.codigoStatus = 1 ) 'EmAndamento', (select count(1) from dcd_frentes df where df.codigoProjeto = dp.codigoProjeto and df.codigoFase <> 11 and df.codigoStatus = 2 ) 'Parado', (select count(1) from dcd_frentes df where df.codigoProjeto = dp.codigoProjeto and df.codigoFase <> 11 and df.codigoStatus = 3 ) 'Cancelado' ",
			"tabelas" 	=> " dcd_projetos dp  ",
			"condicoes"	=> " codigoProjetoPai = 0 ",
			"ordenacao" => " 2 desc limit 10 "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	$linhas=1;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$linhas=$linhas+1;
		$arrayGrafico[]= array($obj->nomeProjeto, $obj->Quantidade, $obj->EmAndamento);
		
	}
}

$objWorksheet->fromArray($arrayGrafico);

//	Set the Labels for each data series we want to plot
$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Top10_Projetos!$B$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Top10_Projetos!$C$1', NULL, 1),
);
//	Set the X-Axis Labels
$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Top10_Projetos!$A$2:$A$'.$linhas, NULL, 4),	//	Q1 to Q4
);
//	Set the Data values for each data series we want to plot
$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Top10_Projetos!$B$2:$B$'.$linhas, NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Top10_Projetos!$C$2:$C$'.$linhas, NULL, 4),
);

//	Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);
//	Set additional dataseries parameters
//		Make it a horizontal bar rather than a vertical column graph
$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Top 10 Projetos Mais Impactados');
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
$chart->setBottomRightPosition('M22');

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:Z50");

// Set document security
/*$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");*/

// Set sheet security
/*$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);*/

/* #################### Fim Definindo Aba 3 ######################## */

/* #################### Definindo Aba 4 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(5);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Alocacao_Recurso');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico);
$arrayGrafico[]= array('','Esforço Futuro','Esforço Atual','Produtividade Mes');

$FUNCOES->consulta(array
			(
			"campos" 	=> " 	u1.nome, (select dadoParametro from dcd_parametros where descricaoParametro='horasMes') horasMes, 
								round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100) produtidadeMes, 
								(select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtual, 
								(select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturo, 
								(select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtualTotal, 
								(select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturoTotal ",
			"tabelas" 	=> " dcd_recursos r1, usuarios u1, dcd_cargos c1 ",
			"condicoes"	=> " r1.usuarioRecurso = u1.login and r1.codigoCargo = c1.codigoCargo ",
			"ordenacao" => " u1.nome "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	$linhas=1;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$linhas=$linhas+1;
		$arrayGrafico[]= array(	$obj->nome, 
								substr($obj->esforcoFuturo,0,(strlen($obj->esforcoFuturo)-4)),
								substr($obj->esforcoAtual,0,(strlen($obj->esforcoAtual)-4)), 
								$obj->produtidadeMes, 
							);
		
	}
}

$objWorksheet->fromArray($arrayGrafico);

//	Set the Labels for each data series we want to plot
$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Alocacao_Recurso!$B$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Alocacao_Recurso!$C$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Alocacao_Recurso!$D$1', NULL, 1),
);
//	Set the X-Axis Labels
$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Alocacao_Recurso!$A$2:$A$'.$linhas, NULL, 4),	//	Q1 to Q4
);
//	Set the Data values for each data series we want to plot
$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Alocacao_Recurso!$B$2:$B$'.$linhas, NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Alocacao_Recurso!$C$2:$C$'.$linhas, NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Alocacao_Recurso!$D$2:$D$'.$linhas, NULL, 4),
);

//	Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);
//	Set additional dataseries parameters
//		Make it a horizontal bar rather than a vertical column graph
$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title = new PHPExcel_Chart_Title('Alocação Por Recurso');
$yAxisLabel = new PHPExcel_Chart_Title('Horas');


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
$chart->setBottomRightPosition('M22');

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:Z50");

// Set document security
/*$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");*/

// Set sheet security
/*$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);*/

/* #################### Fim Definindo Aba 4 ######################## */

/* #################### Definindo Aba 5 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(6);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Tipos_Projetos');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico);
$arrayGrafico[]= array('',			'Total',	"Em Andamento",	"Parado",	"Cancelado");

$FUNCOES->consulta(array
			(
			"campos" 	=> " descricaoTipo, (select count(1) from dcd_frentes df where df.codigoFase <> 11 and df.codigoTipoProjeto = tp.codigoTipoProjeto) 'Total', (select count(1) from dcd_frentes df where df.codigoStatus = 1 and df.codigoFase <> 11 and df.codigoTipoProjeto = tp.codigoTipoProjeto) 'EmAndamento', (select count(1) from dcd_frentes df where df.codigoStatus = 2 and df.codigoFase <> 11 and df.codigoTipoProjeto = tp.codigoTipoProjeto) 'Parado', (select count(1) from dcd_frentes df where df.codigoStatus = 3 and df.codigoFase <> 11 and df.codigoTipoProjeto = tp.codigoTipoProjeto) 'Cancelado' ",
			"tabelas" 	=> " dcd_tiposprojeto tp",
			"ordenacao" => " codigoTipoProjeto "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	$linhas=1;
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$linhas=$linhas+1;
		$arrayGrafico[]= array($obj->descricaoTipo, $obj->Total, $obj->EmAndamento, $obj->Parado, $obj->Cancelado);
		
	}
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Tipos_Projetos!$B$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Tipos_Projetos!$C$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Tipos_Projetos!$D$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Tipos_Projetos!$E$1', NULL, 1),
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Tipos_Projetos!$A$2:$A$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Tipos_Projetos!$B$2:$B$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Tipos_Projetos!$C$2:$C$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Tipos_Projetos!$D$2:$D$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Tipos_Projetos!$E$2:$E$'.$linhas.'', NULL, 4),
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

$title = new PHPExcel_Chart_Title('Projetos por Recurso');
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
$chart->setBottomRightPosition('K20');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:Z50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

/* #################### Definindo Aba 6 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(7);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Jornadas_Mes');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico);
$arrayGrafico[]= array('','Total'); $linhas = 1;

$FUNCOES->consulta(array
			(
			"campos" 	=> " * ",
			"tabelas" 	=> " dcd_origemprojetos ",
			"ordenacao" => " codigoOrigem "
			)
		);

if ($FUNCOES->GetLinhas()>0)
{
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$arrayGrafico[0][] = $obj->nomeOrigem;
		$listOrigem[$obj->codigoOrigem] = $obj->nomeOrigem;
		
	}
}

$FUNCOES->consulta(array
			(
			"campos" 	=> " ds.dataAlocacao, dp.codigoOrigem, dp.nomeOrigem, convert(sum(ds.quantidade)/8, DECIMAL(10,2)) jornadas ",
			"tabelas" 	=> " dcd_sistemas ds, dcd_frentes df, dcd_origemprojetos dp  ",
			"condicoes"	=> " ds.codigoFrente = df.codigoFrente and df.codigoOrigem = dp.codigoOrigem group by 1, 2, 3 ",
			"ordenacao" => " ds.dataAlocacao, dp.codigoOrigem "
			)
		);		
if ($FUNCOES->GetLinhas()>0)
{
	unset($array);
	while ($obj=mysql_fetch_object($FUNCOES->GetResultado()))
	{
		$arrayTT[$obj->dataAlocacao] = $arrayTT[$obj->dataAlocacao] + $obj->jornadas;
		$array[$obj->dataAlocacao][$obj->codigoOrigem] = $obj->jornadas;

	}
}
$keyy = ""; unset($arrayy);
foreach ($array as $key => $value) {
	if ($keyy == "") { $keyy = $key; }
	$dataAlocacao = $key; $i=0; unset($arrayy); $arrayy[] = substr($FUNCOES->dataExterna($dataAlocacao), -6); $arrayy[] = $arrayTT[$dataAlocacao];
	foreach ($listOrigem as $codigoOrigem => $nomeOrigem) {
		$arrayy[] = $array[$dataAlocacao][$codigoOrigem]+0;
	}
	$arrayGrafico[] = $arrayy;
	$linhas++;
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$B$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$C$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$D$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$E$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$F$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$G$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$H$1', NULL, 1),
);

$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes!$A$2:$A$'.$linhas.'', NULL, 4),	//	Q1 to Q4
);

$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes!$B$2:$B$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes!$C$2:$C$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes!$D$2:$D$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes!$E$2:$E$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes!$F$2:$F$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes!$G$2:$G$'.$linhas.'', NULL, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', 'Grafico_Jornadas_Mes!$H$2:$H$'.$linhas.'', NULL, 4),
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

$title = new PHPExcel_Chart_Title('Jornadas por Origem');
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
$chart->setBottomRightPosition('K20');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:Z50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

// Set document security
/*$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");*/

// Set sheet security
/*$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);*/

/* #################### Fim Definindo Aba 6 ######################## */

/* #################### Definindo Aba 7 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(8);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Jornadas_Mes_PPs');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico); unset($arrayTT);
$arrayGrafico[]= array('','Total','Desenvolvimento','Testes', 'Líder PP', 'Analista Funcional'); $linhas = 1;

$FUNCOES->consulta(array
			(
			"campos" 	=> "
							ds.dataAlocacao, 
				            (select convert(sum(ds1.quantidade)/8, DECIMAL(10,2)) jornadas from dcd_sistemas ds1 where ds1.codigoRecursoSistemas = 3 and ds1.dataAlocacao = ds.dataAlocacao and ds1.codigoTipoSistema <> 132) jornadasDesenvolvimento,
				            (select convert(sum(ds2.quantidade)/8, DECIMAL(10,2)) jornadas from dcd_sistemas ds2 where ds2.codigoRecursoSistemas = 3 and ds2.dataAlocacao = ds.dataAlocacao and ds2.codigoTipoSistema = 132) jornadasTestes,
				            (select convert(sum(jf1.quantidade), DECIMAL(10,2)) jornadas from dcd_jornadasfixas jf1 where jf1.dataAlocacao = ds.dataAlocacao and jf1.nomeRecurso = 'ANALISTA FUNCIONAL') jornadasAnalista,
				            (select convert(sum(jf2.quantidade), DECIMAL(10,2)) jornadas from dcd_jornadasfixas jf2 where jf2.dataAlocacao = ds.dataAlocacao and jf2.nomeRecurso = 'LÍDER PP') jornadasLider 
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
		$horasTT = ($obj->jornadasDesenvolvimento + 0) + ($obj->jornadasTestes + 0) + ($obj->jornadasAnalista + 0) + ($obj->jornadasLider + 0);
		$array[$obj->dataAlocacao] = array ( 
						'jornadasTotal' => $horasTT,
						'jornadasDesenvolvimento' => ($obj->jornadasDesenvolvimento + 0),
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
	$arrayGrafico[] = array(substr($FUNCOES->dataExterna($dataAlocacao), -6), $value['jornadasTotal'], $value['jornadasDesenvolvimento'], $value['jornadasTestes'], $value['jornadasLider'], $value['jornadasAnalista']);
	$linhas++;
}

$objWorksheet->fromArray($arrayGrafico);

$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$B$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$C$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$D$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$E$1', NULL, 1),
	new PHPExcel_Chart_DataSeriesValues('String', 'Grafico_Jornadas_Mes_PPs!$F$1', NULL, 1),
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

// Set document security
/*$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");*/

// Set sheet security
/*$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);*/

/* #################### Fim Definindo Aba 7 ######################## */

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel 2007 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$nomeArquivo = "export_411_".str_replace("-","",$FUNCOES->DATA).str_replace(":","",$FUNCOES->HORA)."_projetos.xlsx";
$path = "./export/$nomeArquivo";
$objWriter->save($path);

$msn="Arquivo Gerado com sucesso!";
/* */
?>