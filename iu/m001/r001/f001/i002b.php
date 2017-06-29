	<input type="hidden" name="codigoProjeto" value="<?=$codigoProjeto;?>"/>
	<input type="hidden" name="codigoFrente"/>
			<div class="jumbotron">
				
				<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
				<h5>Dados da Frente</h5>
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
		                    	<td>Descrição</td>
							</tr>
							<tr>
								<td colspan="6" align="center"><textarea class="form-control" name="descricaoFrente" rows="5" cols="150"><? echo $descricaoFrente;?></textarea></td>
							</tr>
							<tr>
		                    	<td width="23%">Tipo do Projeto</td>
		                        <td width="4%">&nbsp;:&nbsp;</td>
		                        <td width="23%">
									
										<select class="form-control" name="codigoTipoProjeto">
											<? if (isset($listaTiposProjetos)){  foreach($listaTiposProjetos as $value) { echo $value; }	}	?>
										</select>
									
								<!--select name="codigoTipoProjeto"><? if (isset($listaTiposProjetos)){  foreach($listaTiposProjetos as $value) { echo $value; }	}	?></select></td-->
								<td width="23%">Recurso Alocado</td>
		                        <td width="4%">&nbsp;:&nbsp;</td>
		                        <td width="23%"><select class="form-control" name="codigoRecurso"><? if (isset($listaRecursos)){  foreach($listaRecursos as $value) { echo $value; }	}	?></select></td>
							</tr>
							<tr>
		                    	<td width="23%">Origem do Projeto</td>
		                        <td width="4%">&nbsp;:&nbsp;</td>
		                        <td width="23%"><select class="form-control" name="codigoOrigem"><? if (isset($listaOrigemProjetos)){  foreach($listaOrigemProjetos as $value) { echo $value; }	}	?></select></td>
								<td width="23%">Fase do Projeto</td>
		                        <td width="4%">&nbsp;:&nbsp;</td>
		                        <td width="23%"><select class="form-control" name="codigoFase"><? if (isset($listaFasesProjetos)){  foreach($listaFasesProjetos as $value) { echo $value; }	}	?></select></td>
							</tr>
							<tr>
		                    	<td width="23%">Area Solicitante</td>
		                        <td width="4%">&nbsp;:&nbsp;</td>
		                        <td width="23%"><select class="form-control" name="codigoArea"><? if (isset($listaAreaSolicitante)){  foreach($listaAreaSolicitante as $value) { echo $value; }	}	?></select></td>
							</tr>
		        </tbody>
				</table>
		        <br/>
				<? if ($FUNCOES->getPermissao(1,1,1,1,$USUARIO)) {?>
					<input type="button" class="btn btn-default" value="Cadastrar" onclick="executar('m001/r001/f001/cadastrarFrente','aplicacao')" />
				<? } ?>
				<input type="button" class="btn btn-default" value="Cancelar" onclick="executar('m001/r001/f001/loadDetalhe','aplicacao')" />

                            							
			</div>
