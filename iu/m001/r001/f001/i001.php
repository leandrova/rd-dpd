	<input type="hidden" name="codigoProjeto"/>
	<input type="hidden" name="codigoProjetoPai"/>
	<input type="hidden" name="codigoFrente"/>
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
        <!-- MAIN CONTENT -->

		<h5>
			<div class="row">
				<div class="col-lg-4">
					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="tipoBusca" value="projeto" <? if ($tipoBusca == "projeto" or $tipoBusca == "") { echo "checked"; } ?> >
						</span>
						<span class="form-control">Por Projeto</span>
						<span class="input-group-addon">
							<input type="radio" name="tipoBusca" value="frente" <? if ($tipoBusca == "frente") { echo "checked"; } ?>>
						</span>
						<span class="form-control">Por Frente</span>
					</div>
					
				</div>
				<div class="col-lg-3">
					<div class="input-group">
						<input type="text" name="buscaProjeto" value="<?=$buscaProjeto;?>" class="form-control">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" onclick="executar('m001/r001/f001/load','aplicacao')">Buscar</button>
						</span>
					</div>
				</div>
			</div>
		</h5>
			
			<!--input type="text" class="form-control" size="20" name="buscaProjeto" value="<?=$buscaProjeto;?>">
			<button class="btn btn-default" onclick="executar('m001/r001/f001/load','aplicacao')">buscar</button-->
			<!--&nbsp;&nbsp;<input type="radio" name="tipoBusca" value="projeto" <? if ($tipoBusca == "projeto" or $tipoBusca == "") { echo "checked"; } ?> >&nbsp;Por Projeto&nbsp;&nbsp;<input type="radio" name="tipoBusca" value="frente" <? if ($tipoBusca == "frente") { echo "checked"; } ?>>&nbsp;Por Frente -->
		
		<script type="text/javascript" src="./iu/lib/js/jquery-1.7.2.min.js"></script> 
		<script type="text/javascript" src="./iu/lib/js/table_script.js"></script> 
		<link rel="stylesheet" type="text/css" href="./iu/lib/css/table_estilo.css"/>
        <? if (isset($listaTabela)){  foreach($listaTabela as $value) { echo $value; }	}	?>
	  
    </div>
<!-- Fim Lista Capacidade -->
