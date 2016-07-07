
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
        <!-- MAIN CONTENT -->
		
		<link rel="stylesheet" type="text/css" href="./iu/lib/css/table_estilo.css"/>
        <? if (isset($listaTabela)){  foreach($listaTabela as $value) { echo $value; }	}	?>
		
		<? if ($FUNCOES->getPermissao(3,1,1,2,$USUARIO)) {?>
			<input type="button" class="button" value="Atualizar Memória" onclick="executar('m003/r001/f001/atualizarMemoria','aplicacao')" />
		<? } ?>
	  
    </div>
<!-- Fim Lista Capacidade -->
