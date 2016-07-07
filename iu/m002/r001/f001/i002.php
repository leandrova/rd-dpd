	<input type="hidden" name="codigoRecurso" value="<?=$codigoRecurso;?>"/>
	<input type="hidden" name="codigoProjeto"/>
	<input type="hidden" name="codigoFrente"/>
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron">
		<script type="text/javascript" src="./iu/lib/js/jquery-1.7.2.min.js"></script> 
		<script type="text/javascript" src="./iu/lib/js/table_script.js"></script> 
		<link rel="stylesheet" type="text/css" href="./iu/lib/css/table_estilo.css"/>
		<link rel="stylesheet" type="text/css" href="./iu/lib/css/radio_estilo.css"/>

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
		<div style="float: right; margin: 5px;"><? if (isset($listaFiltro)){  foreach($listaFiltro as $value) { echo $value; }	}	?><input type="button" class="btn btn-default" value="Filtrar" onclick="executar('m002/r001/f001/loadFrentes','aplicacao')"/></div>
						
        <? if (isset($listaTabela)){  foreach($listaTabela as $value) { echo $value; }	}	?>
		
		<h4>Total Geral de Esforço por Fase</h4>
		
		<? if (isset($listaTotalizadores)){  foreach($listaTotalizadores as $value) { echo $value; }	}	?>
	  
    </div>
<!-- Fim Lista Capacidade -->