	<input type="hidden" name="codigoProjeto" value="<?=$codigoProjeto;?>"/>
	<input type="hidden" name="codigoFrente" value="<?=$codigoFrente;?>"/>
	<input type="hidden" name="codigoRecursoFrente"/>
	<input type="hidden" name="codigoSistemaImpactado"/>
<!-- Inicio Lista Capacidade -->
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
		
		<? 
		if ($codigoStatus 	<> 1	) { echo "<div class=\"alert alert-danger\" role=\"alert\">  ATENÇÃO O STATUS DESSA FRENTE É ".strtoupper($statusProjeto[$codigoStatus])."</div>"; } 
		if ($codigoFase 	== 10	) { echo "<div class=\"alert alert-danger\" role=\"alert\">  ATENÇÃO A FASE DESSA FRENTE É ".strtoupper($statusFaseProjeto[$codigoFase])."</div>"; } 
		?>
		
        <!-- MAIN CONTENT -->
		<script type="text/javascript" src="./iu/lib/js/jquery-1.7.2.min.js"></script> 
		<script type="text/javascript" src="./iu/lib/js/table_script.js"></script> 
		<link rel="stylesheet" type="text/css" href="./iu/lib/css/table_estilo.css"/>
		
			<script>
			function alterDisplay(obj){
				if (obj.style.display == 'none'){
					obj.style.display = 'block'
				} else {
					obj.style.display = 'none';
				}
			}
			</script>
			
			<div class="panel panel-default">
			<div class="panel-heading" style="cursor:hand;" onclick="alterDisplay(document.getElementById('dadosDoProjeto'))"><b>Dados do Projeto</b></div>
			<div id="dadosDoProjeto" style="panel-body; <!--display:<? if (isset($dadosDoProjeto)) { echo $dadosDoProjeto; } else { echo "none"; } ?> -->; padding-bottom: 15px;">
				<table class="table table-striped table-condensed">
				<tbody>
		                    <tr>
		                    	<td width="15%">Nome do Projeto</td>
		                        <td width="5%">&nbsp;:&nbsp;</td>
								<td width="80%"><select class="form-control" name="codigoProjetoNovo"><? if (isset($listaProjetos)){  foreach($listaProjetos as $value) { echo $value; }	}	?></select></td>
							</tr>
		                    <tr>
		                    	<td colspan="3">Descrição</td>
							</tr>
							<tr>
								<td colspan="3" align="center"><textarea disabled name="descricao" rows="5" cols="150" class="form-control"><? echo ($descricao);?></textarea></td>
							</tr>
		        </tbody>
				</table>
				<? if ($FUNCOES->getPermissao(1,1,1,2,$USUARIO) & ( ($usuarioRecurso==$USUARIO) or  ($USUARIO=="SUPORTE") or $FUNCOES->getPermissao(1,1,1,3,$USUARIO) ) ) {?>
				&nbsp;<input type="button" class="btn btn-default" value="Alterar Projeto" onclick="validaProjeto();" />
				<? } ?>
				<br/>
				<script>
				function validaProjeto(){
					var msn = '';
					if (document.aplicacao.codigoProjetoNovo.value != document.aplicacao.codigoProjeto.value){
						msn += "Atencao o Projeto dessa Frente está sendo alterado.\r\n";
					}
					
					if ( confirm(msn + '\r\nDeseja realmente continuar?')) {
						executar('m001/r001/f001/alterarProjeto','aplicacao')
					}
				}
				</script>
			</div>
			</div>
			
			<div class="panel panel-default">
			<div class="panel-heading" style="cursor:hand;" onclick="alterDisplay(document.getElementById('dadosDaFrente'))"><b>Dados da Frente</b></div>
			<div id="dadosDaFrente" style="panel-body; <!--display:<? if (isset($dadosDaFrente)) { echo $dadosDaFrente; } else { echo "none"; } ?>-->; padding-bottom: 15px;">
				<table class="table table-striped table-condensed">
				<tbody>
		                    <tr>
		                    	<td>Nome da Frente&nbsp;<small>(Id/Nome/Prioridade)</small></td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td colspan="4">
		                        	<input type="text" class="form-control" name="idFrente" size="10" maxlength="10" value="<? echo ($idFrente); ?>" style="width: 6%; float: left;" />
		                        	<input type="text" class="form-control" name="nomeFrente" size="50" maxlength="250" value="<? echo ($nomeFrente); ?>" style="float: left; width: 90%;" />
		                        	<input type="text" class="form-control" name="prioridadeFrente" size="5" maxlength="5" value="<? echo ($prioridadeFrente); ?>" style="float: right; width: 4%;" />
		                        </td>
							</tr>
		                    <tr>
		                    	<td colspan="6">Descrição</td>
							</tr>
							<tr>
								<td colspan="6" align="center"><textarea class="form-control" name="descricaoFrente" rows="5" cols="150"><? echo ($descricaoFrente);?></textarea></td>
							</tr>
							<tr>
		                    	<td width="15%">Tipo do Projeto</td>
		                        <td width="5%">&nbsp;:&nbsp;</td>
		                        <td width="30%"><?=($nomeTipoProjeto);?></td>
								<td width="15%">Recurso Alocado</td>
		                        <td width="5%">&nbsp;:&nbsp;</td>
		                        <td width="30%"><?=($usuarioRecurso);?></select></td>
							</tr>
							<tr>
		                    	<td>Origem do Projeto</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><?=($nomeOrigem);?></td>
								<td>Fase do Projeto</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><?=($nomeFase);?></td>
							</tr>
							<tr>
		                    	<td>Status do Projeto</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><?=$statusProjeto[$codigoStatus];?></td>
								<td>Area Solicitante</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><?=$statusAreaSolicitante[$codigoArea];?></td>
							</tr>
		        </tbody>
				</table>
				<? if ($FUNCOES->getPermissao(1,1,1,2,$USUARIO) & ( ($usuarioRecurso==$USUARIO) or  ($USUARIO=="SUPORTE") or $FUNCOES->getPermissao(1,1,1,3,$USUARIO) ) ) {?>
					&nbsp;<input type="button" class="btn btn-default" value="Alterar Frente" onclick="executar('m001/r001/f001/alterarFrente','aplicacao')" />
				<? } ?>
				<br/>
			</div>
			</div>
			
			<div class="panel panel-default">
			<div class="panel-heading" style="cursor:hand;" onclick="alterDisplay(document.getElementById('marcosDoProjeto'))"><b>Planejamento do Projeto</b></div>
			<div id="dadosDaFrente" style="panel-body; <!--display:<? if (isset($marcosDoProjeto)) { echo $marcosDoProjeto; } else { echo "none"; } ?>-->; padding-bottom: 15px;">
				<? if (isset($marcoProjeto)){  foreach($marcoProjeto as $value) { echo $value; }	}	?>
				<? if ($FUNCOES->getPermissao(1,1,1,2,$USUARIO) & ( ($usuarioRecurso==$USUARIO) or  ($USUARIO=="SUPORTE") or $FUNCOES->getPermissao(1,1,1,3,$USUARIO) ) ) {?>
					&nbsp;<input type="button" class="btn btn-default" value="Atualizar Planejamento" onclick="executar('m001/r001/f001/atualizarPlanejamento','aplicacao')" />
				<? } ?>
			</div>
			</div>

    		<script type="text/javascript" src="/iu/lib/js/jquery.maskMoney.min.js"></script> 
			<script type="text/javascript">
				var listaSistemas = JSON.parse('<?php echo json_encode($arrayTiposSistemas); ?>');
				function carregaSistemas(value)
				{
					if (value)
					{
						document.getElementById('nomeTecnologia').value = listaSistemas[value].nomeTecnologia;
						document.getElementById('tipoContrato').value 	= listaSistemas[value].tipoContrato;
					}
				}
			</script>

			<div class="panel panel-default">
			<div class="panel-heading" style="cursor:hand;" onclick="alterDisplay(document.getElementById('sistemasImpactados'))"><b>Sistemas Impactados</b></div>
			<div id="sistemasImpactados" style="panel-body; <!--display:<? if (isset($sistemasImpactados)) { echo $sistemasImpactados; } else { echo "none"; } ?>-->; padding-bottom: 15px;">
				<? if (isset($listaSistemas)){  foreach($listaSistemas as $value) { echo $value; }	}	?>
			</div>
			</div>

			<script type="text/javascript">$("#valor1").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', precision: 2, affixesStay: false});</script>
			<script type="text/javascript">$("#valor2").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
			
			<div class="panel panel-default">
			<div class="panel-heading" style="cursor:hand;" onclick="alterDisplay(document.getElementById('dadosDoHistorico'))"><b>Histórico da Frente do Projeto</b></div>
			<div id="dadosDoHistorico" style="<!--display:<? if (isset($dadosDoHistorico)) { echo $dadosDoHistorico; } else { echo "block"; } ?>-->; padding-bottom: 15px;">
				<style> #tabela p {	font-size:14px;	}</style>
				<? if (isset($listaHistorico)){  foreach($listaHistorico as $value) { echo $value; }	}	?>
			</div>
			</div>
			
			<? if ($FUNCOES->getPermissao(1,1,1,2,$USUARIO) & ( ($usuarioRecurso==$USUARIO) or  ($USUARIO=="SUPORTE") or ($FUNCOES->getPermissao(1,1,1,3,$USUARIO)) ) ) { ?>
			<div class="panel panel-default">
			<div class="panel-heading" style="cursor:hand;" onclick="alterDisplay(document.getElementById('incluirHistorico'))"><b>Incluir Histórico</b></div>
			<div id="incluirHistorico" style="panel-body; <!--display:<? if (isset($incluirHistorico)) { echo $incluirHistorico; } else { echo "none"; } ?>-->; padding-bottom: 15px;">
				<input type="hidden" name="codigoTipoProjetoOrig" value="<?=$codigoTipoProjeto;?>"/>
				<input type="hidden" name="codigoRecursoOrig" value="<?=$codigoRecurso;?>"/>
				<input type="hidden" name="codigoOrigemOrig" value="<?=$codigoOrigem;?>"/>
				<input type="hidden" name="codigoFaseOrig" value="<?=$codigoFase;?>"/>
				<input type="hidden" name="codigoStatusOrig" value="<?=$codigoStatus;?>"/>
				<input type="hidden" name="codigoAreaOrig" value="<?=$codigoArea;?>"/>
				
				<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
				
				<table class="table table-striped table-condensed">
				<tbody>
		                    <tr>
		                    	<td>Data</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td colspan="4"><input type="text" class="form-control" name="dataHistorico" size="8" maxlength="10" value="<? echo $dataHistorico; ?>" /></td>
							</tr>
		                    <tr>
		                    	<td colspan="6">Descrição</td>
							</tr>
							<tr>
								<td colspan="6" align="center">
									<textarea class="form-control" name="descricaoHistorico" rows="5" cols="150"><? echo $descricaoHistorico;?></textarea>
									<script>
										CKEDITOR.replace( 'descricaoHistorico' );
									</script>
									</td>
							</tr>
							<tr>
		                    	<td width="20%">Alterar Tipo do Projeto</td>
		                        <td width="5%">&nbsp;:&nbsp;</td>
		                        <td width="25%"><select class="form-control" name="codigoTipoProjeto"><? if (isset($listaTiposProjetos)){  foreach($listaTiposProjetos as $value) { echo $value; }	}	?></select></td>
								<td width="20%">Alterar Recurso Alocado</td>
		                        <td width="5%">&nbsp;:&nbsp;</td>
		                        <td width="25%"><select class="form-control" name="codigoRecurso"><? if (isset($listaRecursos)){  foreach($listaRecursos as $value) { echo $value; }	}	?></select></td>
							</tr>
							<tr>
		                    	<td>Alterar Origem do Projeto</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><select class="form-control" name="codigoOrigem"><? if (isset($listaOrigemProjetos)){  foreach($listaOrigemProjetos as $value) { echo $value; }	}	?></select></td>
								<td>Alterar Fase do Projeto</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><select class="form-control" name="codigoFase"><? if (isset($listaFasesProjetos)){  foreach($listaFasesProjetos as $value) { echo $value; }	}	?></select></td>
							</tr>
							<tr>
		                    	<td>Alterar Status do Projeto</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><select class="form-control" name="codigoStatus"><? if (isset($listaStatusProjetos)){  foreach($listaStatusProjetos as $value) { echo $value; }	}	?></select></td>
								<td>Area Solicitante</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><select class="form-control" name="codigoArea"><? if (isset($listaAreaSolicitante)){  foreach($listaAreaSolicitante as $value) { echo $value; }	}	?></select></td>
							</tr>
		        </tbody>
				</table>
				&nbsp;<input type="button" class="btn btn-default" value="cadastrar novo histórico" onclick="validaCadastro()">
				<script>
				function validaCadastro(){
					var msn = '';
					if (document.aplicacao.codigoTipoProjeto.value != document.aplicacao.codigoTipoProjetoOrig.value){
						msn += "Atencao o Tipo do Projeto está sendo alterado.\r\n";
					}
					if (document.aplicacao.codigoRecurso.value != document.aplicacao.codigoRecursoOrig.value){
						msn += "Atencao o Recurso está sendo alterado.\r\n";
					}
					if (document.aplicacao.codigoOrigem.value != document.aplicacao.codigoOrigemOrig.value){
						msn += "Atencao a Origem do Projeto está sendo alterado.\r\n";
					}
					if (document.aplicacao.codigoFase.value != document.aplicacao.codigoFaseOrig.value){
						msn += "Atencao a Fase do Projeto está sendo alterado.\r\n";
					}
					if (document.aplicacao.codigoStatus.value != document.aplicacao.codigoStatusOrig.value){
						msn += "Atencao o Status do Projeto está sendo alterado.\r\n";
					}
					if (document.aplicacao.codigoArea.value != document.aplicacao.codigoAreaOrig.value){
						msn += "Atencao a Area Solicitante está sendo alterado.\r\n";
					}
					
					if ( confirm(msn + '\r\nDeseja realmente continuar?')) {
						executar('m001/r001/f001/cadastrarHistorico','aplicacao');
					}
				}
				</script>
			
			</div>
			</div>
			
			<? } ?>
		
    </div>
<!-- Fim Lista Capacidade -->
