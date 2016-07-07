    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
									
		<table class="table table-striped table-condensed">
		<tr>
		       	<td>Usuario</td>
		        <td>&nbsp;:&nbsp;</td>
		        <td><?=$codigo;?></td>
		</tr>
		<tr>
		<td><br /></td>
		</tr>
		<tr>
			<td colspan="3"><b>Dados do Usuario</b></td>
		</tr>
		<tr>
			<td><br /></td>
		</tr>
		<tr>
			<td>Login</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="text" class="box" name="login" size="9" maxlength="7" value="<? echo $login; ?>" /></td>
		</tr>
		<tr>
			<td>Senha</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="password" class="box" name="senha" size="8" maxlength="6" value="" /></td>
		</tr>
		<tr>
			<td>Repetir Senha</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="password" class="box" name="senha2" size="8" maxlength="6" value="" /></td>
		</tr>
		<tr>
			<td>Nome</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="text" class="box" name="nome" size="30" maxlength="40" value="<? echo $nome; ?>" /></td>
		</tr>
		<tr>
			<td>Email</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="text" class="box" name="email" size="40" maxlength="50" value="<? echo $email; ?>" /></td>
		</tr>
		<tr>
			<td>Telefone</td>
		    <td>&nbsp;:&nbsp;</td>
		    <td><input type="text" class="box" name="telefone" size="15" maxlength="30" value="<? echo $telefone; ?>" /></td>
		</tr>
		</table>
		<br/>
		<? if ($codigo=="novo") { ?><? if ($FUNCOES->getPermissao(999,1,1,1,$USUARIO)) {?><input type="button" class="button" value="Cadastrar" onclick="executar('m999/r001/f001/cadastrar','aplicacao')" /><? } } else {?><? if ($FUNCOES->getPermissao(999,1,1,2,$USUARIO)||($USUARIO==$codigoUsuario)) { ?><input type="button" class="button" value="Alterar" onclick="executar('m999/r001/f001/alterar','aplicacao')" /><? } ?>	<? if ($FUNCOES->getPermissao(999,1,1,3,$USUARIO)) { ?><input type="button" class="button" value="Excluir" onclick="executar('m999/r001/f001/excluir','aplicacao')" /><? } ?> <? } ?>
                            							
	</div>
