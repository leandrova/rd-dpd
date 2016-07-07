	<input type="hidden" name="codigoProjeto" value="<?=$codigoProjeto;?>"/>
	<input type="hidden" name="codigoProjetoPai" value="<?=$codigoProjetoPai;?>"/>
	<input type="hidden" name="codigoFrente"/>
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
        <!-- MAIN CONTENT -->
		<script type="text/javascript" src="./iu/lib/js/jquery-1.7.2.min.js"></script> 
		<script type="text/javascript" src="./iu/lib/js/table_script.js"></script> 
		<link rel="stylesheet" type="text/css" href="./iu/lib/css/table_estilo.css"/>
		<script>
		function trocaIcone(obj){
			if (obj.src.indexOf("folder_closed") != -1){
				obj.src = './images/folder_open.png';
			} else {
				obj.src = './images/folder_closed.png';
			}
		}		
		</script>
        <? if (isset($listaTabela)){  foreach($listaTabela as $value) { echo $value; }	}	?>
	  
    </div>
<!-- Fim Lista Capacidade -->
