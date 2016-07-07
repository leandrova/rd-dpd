	<input type="hidden" name="codModulo"/>
	<input type="hidden" name="codFuncao"/>
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						
        <? if (isset($listaTable)){  foreach($listaTable as $value) { echo $value; }	}	?>
                            							
	</div>