    <input type="hidden" name="codigoTipoSistema" value="">
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						             
	    <h5>
			Buscar : <input type="text" class="box" size="20" name="busca" value="<?=$busca;?>" />
			<input type="button" class="button" value="buscar" onclick="executar('m003/r003/f001/load','aplicacao')">
		</h5>
                        
		<? if (isset($listaSistemas)){  foreach($listaSistemas as $value) { echo $value; }	} ?></p>
                            							
	</div>
