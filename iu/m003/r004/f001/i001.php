    <input type="hidden" name="nomeArquivo">
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						             
    	<div class="input-group">
			<input type="file" name="arquivo" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="executar('m003/r004/f001/importFile','aplicacao')">Importar</button>
			</span>
		</div>
                        
		<? if (isset($listaTabela)){  foreach($listaTabela as $value) { echo $value; }	} ?></p>
                            							
	</div>