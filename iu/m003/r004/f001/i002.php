    <input type="hidden" name="codigoTipoSistema" value="<? echo $codigoTipoSistema; ?>">
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
									
		<? if (isset($listaProcess)){  foreach($listaProcess as $value) { echo $value; }	} ?></p>

	</div>
