			<input type="hidden" name="codModuloOrig" value="<?=$codModulo;?>"/>
			<input type="hidden" name="codRotinaOrig" value="<?=$codRotina;?>"/>
			<input type="hidden" name="codFuncaoOrig" value="<?=$codFuncao;?>"/>
			<div class="jumbotron">
				
				<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
				<h5>Dados do Modulo</h5>
				<table class="table table-striped table-condensed">
				<tbody>
		                    <tr>
		                    	<td>Cod. Modulo</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><input type="text" class="box" name="codModulo" size="9" maxlength="7" value="<? echo $codModulo; ?>" /></td>
							</tr>
		                    <tr>
		                    	<td>Cod Rotina</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><input type="text" class="box" name="codRotina" size="8" maxlength="6" value="<? echo $codRotina;?>" /></td>
							</tr>
		                    <tr>
		                    	<td>Cod Fun&ccedil;&atilde;o</td>
		                        <td>&nbsp;:&nbsp;</td>
								<td><input type="text" class="box" name="codFuncao" size="8" maxlength="6" value="<? echo $codFuncao;?>" /></td>
							</tr>
		                    <tr>
		                    	<td>Modulo</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><input type="text" class="box" name="modulo" size="30" maxlength="30" value="<? echo $modulo;?>" /></td>
							</tr>
		                    <tr>
		                    	<td>Rotina</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><input type="text" class="box" name="rotina" size="30" maxlength="30" value="<? echo $rotina;?>" /></td>
							</tr>
		                    <tr>
		                    	<td>Fun&ccedil;&atilde;o</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><input type="text" class="box" name="funcao" size="30" maxlength="30" value="<? echo $funcao; ?>" /></td>
							</tr>
		                    <tr>
		                    	<td>Load Class</td>
		                        <td>&nbsp;:&nbsp;</td>
		                        <td><input type="text" class="box" name="loadClass" size="40" maxlength="50" value="<? echo $loadClass; ?>" /></td>
							</tr>
		                    </tbody>
		                    </table>
							<br/>
							<? if ($codModulo=="") { ?>
							<? if ($FUNCOES->getPermissao(999,2,1,1,$USUARIO)) {?>
								<input type="button" class="button" value="Cadastrar" onclick="executar('m999/r002/f001/cadastrar','aplicacao')" />
							<? } } else {?>
							<? if ($FUNCOES->getPermissao(999,2,1,2,$USUARIO)) { ?>
								<input type="button" class="button" value="Alterar" onclick="executar('m999/r002/f001/alterar','aplicacao')" />
							<? } ?>	<? if ($FUNCOES->getPermissao(999,2,1,3,$USUARIO)) { ?>
								<input type="button" class="button" value="Excluir" onclick="executar('m999/r002/f001/excluir','aplicacao')" />
							<? } ?> <? } ?>
                            							
			</div>
