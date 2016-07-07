
<!-- Inicio da Autenticação -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-collapse collapse">
          
				<div class="navbar-form navbar-right" role="form">
				<? if ($USUARIO == null) {?>
				<div class="form-group">
					<input name="login" type="text" placeholder="Login" class="form-control">
				</div>
				<div class="form-group">
					<input name="senha" type="password" placeholder="Senha" class="form-control">
				</div>
				<button class="btn btn-success" onclick="executar('lib/login/login','aplicacao')">Login</button>
				<? } else { ?>
				<div class="form-group">
					<div style="background-color: #eee; padding: 6px 12px;border: 1px solid #ccc;border-radius: 4px;width: 250px;"><?=$nomeUsuario;?></div>
				</div>
				<input type="button" class="btn btn-success" value="Logout" onclick="executar('lib/login/logof','aplicacao')">
				<? } ?>
				</div>
          
        </div>		
    </div>
</div>
<!-- Fim da Autenticação -->
