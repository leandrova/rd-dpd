    <input type="hidden" name="codigoTipoSistema" value="<? echo $codigoTipoSistema; ?>">
    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
									
		<table class="table table-striped table-condensed">
		<tr>
			<td colspan="3"><b>Dados do Sistema</b></td>
		</tr>
		<tr>
			<td><br /></td>
		</tr>
		<tr>
			<td>Nome do Sistema</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="text" class="form-control" name="nomeSistema" maxlength="50" value="<? echo $nomeSistema; ?>" /></td>
		</tr>
		<tr>
			<td>Tecnologia</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><? if (isset($listaTiposTecnologia)){  foreach($listaTiposTecnologia as $value) { echo $value; }	}	?></td>
		</tr>
		<tr>
			<td>Contrato</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><? if (isset($listaTiposContrato)){  foreach($listaTiposContrato as $value) { echo $value; }	}	?></td>
		</tr>
		</table>
		<br/>
		<? if ($codigoTipoSistema=="novo") { ?>
			<? if ($FUNCOES->getPermissao(3,3,1,1,$USUARIO)) {?>
			<input type="button" class="button" value="Cadastrar" onclick="executar('m003/r003/f001/cadastrar','aplicacao')" />
			<? } } else {?><? if ($FUNCOES->getPermissao(3,3,1,2,$USUARIO)||($USUARIO==$codigoUsuario)) { ?>
			<input type="button" class="button" value="Alterar" onclick="executar('m003/r003/f001/alterar','aplicacao')" />
			<? } ?>
		<? } ?>
	</div>
