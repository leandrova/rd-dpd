	<input type="hidden" name="codigoRecurso"/>
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						
        <? if (isset($listaTabela)){  foreach($listaTabela as $value) { echo $value; }	}	?>
	  
    </div>
<!-- Fim Lista Capacidade -->