    <input type="hidden" name="codigoRecurso">
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						             
	    <h5>
			Buscar : <input type="text" class="box" size="20" name="busca" value="<?=$busca;?>" />
			<input type="button" class="button" value="buscar" onclick="executar('m003/r003/f002/load','aplicacao')">
		</h5>
                        
		<? if (isset($listaRecursos)){  foreach($listaRecursos as $value) { echo $value; }	} ?></p>
                            							
	</div>
