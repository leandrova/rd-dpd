    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						
		<h5>Selecione as tabelas do back-up para se restaurado.</h5>
                        
        <? if (isset($listaTable)){  foreach($listaTable as $value) { echo $value; }	}	?>
                            							
	</div>