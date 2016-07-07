		<input type="hidden" name="codigoProjeto" value="<?=$codigoProjeto;?>"/>
			<div class="jumbotron">
				
				<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>

				<table class="table table-striped table-condensed">
				<tbody>
		            <tr>
						<td width="15%">Nome do <? if ($codigoProjeto<>0) { echo "Sub"; } ?>Projeto</td>
		                <td>&nbsp;:&nbsp;</td>
		                <td><input type="text" class="form-control" name="nomeProjeto" size="100%" maxlength="250" value="<? echo $nomeProjeto; ?>" /></td>
					</tr>
		            <tr colspan="3">
						<td>Descrição</td>
					</tr>
					<tr>
						<td colspan="3" align="center"><textarea name="descricao" class="form-control" rows="5"><? echo $descricao;?></textarea></td>
					</tr>
		        </tbody>
				</table>
		        
				<? if ($FUNCOES->getPermissao(1,1,1,1,$USUARIO)) {?>
					<input type="button" class="btn btn-default" value="Cadastrar" onclick="executar('m001/r001/f001/cadastrar','aplicacao')" />
				<? } ?>
				<? if ($codigoProjeto <> 0) { ?>
				<input type="button" class="btn btn-default" value="Cancelar" onclick="executar('m001/r001/f001/loadDetalhe','aplicacao')" />
				<? } else { ?>
				<input type="button" class="btn btn-default" value="Cancelar" onclick="executar('m001/r001/f001/load','aplicacao')" />
				<? } ?>

			</div>
