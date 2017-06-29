    <input type="hidden" name="codigoRecurso" value="<? echo $codigoRecurso; ?>">
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
									
		<table class="table table-striped table-condensed">
		<tr>
			<td colspan="3"><b>Dados do Recurso</b></td>
		</tr>
		<tr>
			<td><br /></td>
		</tr>
		<tr>
			<td>Nome do Recursos</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="text" class="form-control" name="nomeRecurso" maxlength="50" value="<? echo $nomeRecurso; ?>" /></td>
		</tr>
		</table>
		<br/>
		<? if ($codigoRecurso=="novo") { ?>
			<? if ($FUNCOES->getPermissao(3,3,2,1,$USUARIO)) {?>
			<input type="button" class="button" value="Cadastrar" onclick="executar('m003/r003/f002/cadastrar','aplicacao')" />
			<? } } else {?><? if ($FUNCOES->getPermissao(3,3,2,2,$USUARIO)||($USUARIO==$codigoUsuario)) { ?>
			<input type="button" class="button" value="Alterar" onclick="executar('m003/r003/f002/alterar','aplicacao')" />
			<? } ?>
		<? } ?>
	</div>
