    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						
		<h5>Usu&aacute;rio&nbsp;:&nbsp;<b><?=$codigo;?></b></h5>
                            
		<h5>Lista de Modulos</h5>
                            
        <? if (isset($lista)){  foreach($lista as $value) { echo $value; }	}	?>
                            
        <? if ($FUNCOES->getPermissao(999,1,1,2,$USUARIO)) { ?><input type="button" class="button" value="Alterar" onclick="executar('m999/r001/f002/alterar','aplicacao')" /><? } ?>
                            							
	</div>