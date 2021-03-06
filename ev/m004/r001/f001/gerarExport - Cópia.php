<?

/** Include PHPExcel */
require_once './iu/lib/js/PHPExcel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("RD - PDP Relatórios")
							 ->setLastModifiedBy("RD - PDP Relatórios")
							 ->setTitle("Export Todos Projetos")
							 ->setSubject("Export de todos os projetos registrados no sistema DPD")
							 ->setDescription("Export de todos os projetos registrados no sistema DPD.")
							 ->setKeywords("Desenvolvimento De Plataformas Digitais")
							 ->setCategory("Relacionamento Digital");

$sharedStyleTitulo = new PHPExcel_Style();
$sharedStyleLinha1 = new PHPExcel_Style();
$sharedStyleLinha2 = new PHPExcel_Style();
$sharedStyleBranco = new PHPExcel_Style();

$sharedStyleTitulo->applyFromArray(
	array(
		'fill' 	=> array(
					'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					'color'		=> array('rgb' => 'DFF0D8')
				),
		'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
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
		'borders' => array(
					'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') ),
					'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF') )
				)
		 )
	);
	
// Definindo Titulo Titulo
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nome Projeto');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Descricao');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Nome Frente');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Descricao Frente');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Origem');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Recurso');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Fase');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Tipo');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Historico');


$FUNCOES->consulta(array
			(
			"campos" 	=> " p1.codigoProjeto, p1.nomeProjeto, f1.codigoFrente, p1.descricao, s1.descricaoStatus, f1.nomeFrente, f1.descricaoFrente, o1.nomeOrigem, r1.usuarioRecurso, f2.nomeFase, descricaoTipo ",
			"tabelas" 	=> " dcd_projetos p1, dcd_frentes f1, dcd_origemprojetos o1, dcd_tiposprojeto t1, dcd_fasesprojetos f2, dcd_recursos r1, dcd_memoriaprojetos m1, dcd_statusprojeto s1  ",
			"condicoes"	=> " f1.codigoStatus = s1.codigoStatus and p1.codigoProjeto = f1.codigoProjeto and f1.codigoOrigem = o1.codigoOrigem and f1.codigoTipoProjeto = t1.codigoTipoProjeto and f1.codigoFase = f2.codigoFase and f1.codigoRecurso = r1.codigoRecurso and m1.codigoOrigem = f1.codigoOrigem and m1.codigoTipoProjeto = f1.codigoTipoProjeto and m1.codigoFase = f1.codigoFase",
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
		$objPHPExcel->getActiveSheet()->setCellValue("C".$linha, $obj->descricaoStatus);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$linha, $obj->nomeFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("E".$linha, $obj->descricaoFrente);
		$objPHPExcel->getActiveSheet()->setCellValue("F".$linha, $obj->nomeOrigem);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$linha, $obj->usuarioRecurso);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$linha, $obj->nomeFase);
		$objPHPExcel->getActiveSheet()->setCellValue("I".$linha, $obj->descricaoTipo);
		
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
				$historico.=$FUNCOES->dataExterna($objj->dataHistorico)." - ".($objj->descricaoHistorico);
			}
		}
		$objPHPExcel->getActiveSheet()->setCellValue("J".$linha, $historico);
		
		/* Aplicando Style e Tamanho */
		if ($tpStyle == 0) { 
			$tpStyle=1;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha1, "A".$linha.":J".$linha."");
		} else { 
			$tpStyle=0;	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleLinha2, "A".$linha.":J".$linha."");
		}
		$objPHPExcel->getActiveSheet()->getRowDimension($linha)->setRowHeight(15);
	}
}

$objPHPExcel->getActiveSheet()->setCellValue("A".($linha+1), "Total de Linhas: ".$linha);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Lista de Projetos');

/* Aplicando Alinhamento */
$objPHPExcel->getActiveSheet()->getStyle("A".$linha.":J".$linha)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

/* Aplicando Quebra de Linha */
$objPHPExcel->getActiveSheet()->getStyle("A1:J".$linha)->getAlignment()->setWrapText(true);

// Set title row bold
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);

// Largura e Altura das Linhas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(60);

/* Aplicando Style do Titulo */
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleTitulo, "A1:J1");

// Set autofilter
$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());

// Set document security
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");

// Set sheet security
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

/* #################### Definindo Aba 2 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);

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
$chart->setBottomRightPosition('L20');

// style
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyleBranco, "A1:Z50");

//	Add the chart to the worksheet
$objWorksheet->addChart($chart);

// Set document security
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");

// Set sheet security
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

/* #################### Fim Definindo Aba 2 ######################## */

/* #################### Definindo Aba 3 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);

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
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");

// Set sheet security
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

/* #################### Fim Definindo Aba 3 ######################## */

/* #################### Definindo Aba 4 ######################## */

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Grafico_Alocacao_Recurso');

$objWorksheet = $objPHPExcel->getActiveSheet();

unset($arrayGrafico);
$arrayGrafico[]= array('','Esforço Futuro','Esforço Atual','Produtividade Mes');

$FUNCOES->consulta(array
			(
			"campos" 	=> " 	u1.nome, (select dadoParametro from dcd_parametros where descricaoParametro='horasMes') horasMes, 
								round((select dadoParametro from dcd_parametros where descricaoParametro='horasMes')*c1.deflatorCargo/100) produtidadeMes, 
								(select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtual, (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus = 1 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturo, (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and f1.codigoFase = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoAtualTotal, (select sum(m1.horasEsforco) from dcd_frentes f1, dcd_memoriaprojetos m1 where f1.codigoStatus <> 3 and f1.codigoOrigem = m1.codigoOrigem and f1.codigoTipoProjeto = m1.codigoTipoProjeto and (f1.codigoFase+1) = m1.codigoFase and f1.codigoRecurso = r1.codigoRecurso) esforcoFuturoTotal ",
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
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);
$objPHPExcel->getSecurity()->setWorkbookPassword("DPD");

// Set sheet security
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PDP');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

/* #################### Fim Definindo Aba 4 ######################## */

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