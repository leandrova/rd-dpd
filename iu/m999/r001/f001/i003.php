    <div class="jumbotron">

		<h4><?=$GLOBALS["DISCRICAOSISTEMA"];?></h4>
						
		<h5>Dados do Usuário</h5>
							
		<table class="table table-striped table-condensed">
			<tr><td style="width: 40%; padding: 5px;">Login</td><td style="width: 10%;">:</td><td style="width: 50%;"><? echo $login; ?></td></tr>
			<tr><td style="width: 40%; padding: 5px;">Senha</td><td>:</td><td><input type="password" class="box" name="novasenha" size="10" maxlength="20"/></td></tr>
			<tr><td style="width: 40%; padding: 5px;">Repetir Senha</td><td>:</td><td><input type="password" class="box" name="novasenha2" size="10" maxlength="20"/></td></tr>
			<tr><td style="width: 40%; padding: 5px;">Nome</td><td>:</td><td><? echo $nome; ?></td></tr>
			<tr><td style="width: 40%; padding: 5px;">Email</td><td>:</td><td><? echo $email; ?></td></tr>
			<tr><td style="width: 40%; padding: 5px;">Telefone</td><td>:</td><td><? echo $telefone; ?></td></tr>
		</table>
		<br>
		<input type="button" class="btn btn-default" value="Alterar" onclick="executar('m999/r001/f001/alterarSenha','aplicacao')" />

	</div>
