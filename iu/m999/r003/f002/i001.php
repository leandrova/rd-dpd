    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						
        <h5>Selecione um dos back-up's para restaurar.</h5>
                        
		<? if (isset($listaTable)){  foreach($listaTable as $value) { echo $value; }	}	?>
                            							
	</div>