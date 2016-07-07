    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						
						
                        <? if (isset($listaTable)){  foreach($listaTable as $value) { echo $value; }	}	?>
                        <br/>
                        <table class="table table-striped table-condensed">
                        <tr>
                        	<td>Sistema Operacional</td><td><?=PHP_OS;?></td>
                        </tr>
                        <tr>
                        	<td>Registro da Maquina</td><td><?=md5($FUNCOES->mac(0));?></td>
                        </td>
                        <tr>
                        	<td>Expira em </td><td><?=$FUNCOES->dataExterna($dataExpira);?>&nbsp;(<?=$diasExpira;?> dias)</td>
                        </tr>
                        <tr>
                        	<td>Data Atual </td><td><?=$FUNCOES->dataExterna($FUNCOES->DATA);?></td>
                        </tr>
                        </table>
                        
                        <h5>Dados Do Registro</h5>

                        <textarea cols="100" rows="8" name="registro" class="box"><?=$dadosRegistro;?></textarea>
                        <br/>
                        <input type="button" class="button" name="alterar" value="Alterar Registro" onclick="executar('m999/r004/f001/registrar','aplicacao')" />
                                                    						
	</div>	