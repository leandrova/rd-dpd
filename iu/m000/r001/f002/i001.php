		<script src="./iu/lib/grafico/RGraph_002.js"></script>
		<script src="./iu/lib/grafico/RGraph_003.js"></script>
		<script src="./iu/lib/grafico/RGraph_004.js"></script>
		<script src="./iu/lib/grafico/RGraph_005.js"></script>
		<script src="./iu/lib/grafico/RGraph_006.js"></script>
		<script src="./iu/lib/grafico/RGraph.js"></script>

		<script>
			var dadosProjetos = <?=$dadosProjetos;?>;
			var emAndamento = <?=$listaProjetos['Em Andamento'];?>;
			var parado = <?=$listaProjetos['Parada'];?>;
			var total = <?=($listaProjetos['Parada']+$listaProjetos['Em Andamento']);?>;
			
			var dadosAlocacao = <?=$dadosAlocacao;?>;
			var horas = <?=$horas;?>;
			var horasAtual = <?=$horasAtual;?>;
			var horasFutura = <?=$horasFutura;?>;
		</script>
	
		<script>		
			window.onload = function ()
			{
				var meuGraficoIdades = new RGraph.Bar('meuCanvasGraficoStatusProjeto', dadosProjetos);
				meuGraficoIdades.Set('chart.background.barcolor1', 'white');
				meuGraficoIdades.Set('chart.background.barcolor2', 'white');
				meuGraficoIdades.Set('chart.title', 'Status dos Projetos');
				meuGraficoIdades.Set('chart.title.vpos', 0.6);
				meuGraficoIdades.Set('chart.labels', ['Em Andamento', 'Parado', 'Total' ]);
				meuGraficoIdades.Set('chart.tooltips', ['Projetos Em Andamento: ' + emAndamento, 'Projetos Parado: ' + parado, 'Total de Projetos' + total]);
				meuGraficoIdades.Set('chart.text.angle', 45);
				meuGraficoIdades.Set('chart.gutter', 35);
				meuGraficoIdades.Set('chart.shadow', true);
				meuGraficoIdades.Set('chart.shadow.blur', 5);
				meuGraficoIdades.Set('chart.shadow.color', '#aaa');
				meuGraficoIdades.Set('chart.shadow.offsety', -3);
				meuGraficoIdades.Set('chart.colors', ['#777']);
				meuGraficoIdades.Set('chart.key.position', 'gutter');
				meuGraficoIdades.Set('chart.text.size', 10);
				meuGraficoIdades.Set('chart.text.font', 'Georgia');
				meuGraficoIdades.Set('chart.text.angle', 0);
				meuGraficoIdades.Set('chart.grouping', 'stacked');
				meuGraficoIdades.Set('chart.strokecolor', 'rgba(0,0,0,0)');
				meuGraficoIdades.Draw();

				/* Grafico Alocação */
				var meuGraficoIdades = new RGraph.Bar('meuCanvasGraficoAlocacao', dadosAlocacao);
				meuGraficoIdades.Set('chart.background.barcolor1', 'white');
				meuGraficoIdades.Set('chart.background.barcolor2', 'white');
				meuGraficoIdades.Set('chart.title', 'Alocação');
				meuGraficoIdades.Set('chart.title.vpos', 0.6);
				meuGraficoIdades.Set('chart.labels', ['Horas Mes', 'Alocacao Atual', 'Alocacao Futura' ]);
				meuGraficoIdades.Set('chart.tooltips', ['Horas Mes: ' + horas, 'Alocacao Atual: ' + horasAtual, 'Alocacao Futura: ' + horasFutura]);
				meuGraficoIdades.Set('chart.text.angle', 45);
				meuGraficoIdades.Set('chart.gutter', 35);
				meuGraficoIdades.Set('chart.shadow', true);
				meuGraficoIdades.Set('chart.shadow.blur', 5);
				meuGraficoIdades.Set('chart.shadow.color', '#aaa');
				meuGraficoIdades.Set('chart.shadow.offsety', -3);
				meuGraficoIdades.Set('chart.colors', ['#777']);
				meuGraficoIdades.Set('chart.key.position', 'gutter');
				meuGraficoIdades.Set('chart.text.size', 10);
				meuGraficoIdades.Set('chart.text.font', 'Georgia');
				meuGraficoIdades.Set('chart.text.angle', 0);
				meuGraficoIdades.Set('chart.grouping', 'stacked');
				meuGraficoIdades.Set('chart.strokecolor', 'rgba(0,0,0,0)');
				meuGraficoIdades.Draw(); 
			}
		</script>
		
	<input type="hidden" name="codigoProjeto"/>
	<input type="hidden" name="codigoFrente"/>
	
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron" style="height:500px">
		<br/>
		<div style="width:100%">
		
			<div style="width:49%; float: left">
				<fieldset style="border:1; width: 100%; height:235">
					<legend style="font-size: 17px; margin-bottom: 0px;">Top 5 Favoritos</legend>
					<? if (isset($listaTopFavoritos)){  foreach($listaTopFavoritos as $value) { echo $value; }	}	?>
				</fieldset>
			</div>
			
			<div style="width:49%; float: right">
				<fieldset style="border:1px; width: 100%; text-align:center">
					<canvas style="cursor: default;" id="meuCanvasGraficoAlocacao" width="500" height="235">[No canvas support]</canvas>
				</fieldset>
			</div>
			
			<div style="width:49%; float: left">
				<fieldset style="border:1; width: 100%; height:235">
					<legend style="font-size: 17px; margin-bottom: 0px;">Top 5 Projetos +</legend>
					<? if (isset($listaTopMais)){  foreach($listaTopMais as $value) { echo $value; }	}	?>
				</fieldset>
			</div>
			
			<div style="width:49%; float: right">
				<fieldset style="border:1px; width: 100%; text-align:center">
					<canvas style="cursor: default;" id="meuCanvasGraficoStatusProjeto" width="500" height="235">[No canvas support]</canvas>
				</fieldset>
			</div>
		</div>		
	  
    </div>
<!-- Fim Lista Capacidade -->