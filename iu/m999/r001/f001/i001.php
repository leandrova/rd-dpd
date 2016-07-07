    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						             
	    <h5>
			Buscar : <input type="text" class="box" size="20" name="busca" value="<?=$busca;?>" />
			<input type="button" class="button" value="buscar" onclick="executar('m999/r001/f001/load','aplicacao')">
		</h5>
                        
		<? if (isset($listaUsuario)){  foreach($listaUsuario as $value) { echo $value; }	} ?></p>
                            							
	</div>
