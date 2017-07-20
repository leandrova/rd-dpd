
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
        <!-- MAIN CONTENT -->
		
		<h5>Veja abaixo as versões existentes neste momento.</h5>
		
		<link rel="stylesheet" type="text/css" href="./iu/lib/css/table_estilo.css"/>
        <? if (isset($listaTabela)){  foreach($listaTabela as $value) { echo $value; }	}	?>
		
		<? if ($FUNCOES->getPermissao(4,1,2,2,$USUARIO)) {?>
			<input class="btn btn-default" value="Gerar Novo Relatório Atualizado" onclick="executar('m004/r001/f002/gerarExport','aplicacao')" type="button">
		<? } ?>
	  
    </div>
<!-- Fim Lista Capacidade -->
