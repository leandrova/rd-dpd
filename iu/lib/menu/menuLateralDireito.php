        <? if (isset($listaMenu)) { foreach($listaMenu as $key => $value) { echo $value; } }?>
		
        <div class='dbx-box'>
			<h3 class='dbx-handle'>Dados do Usuário</h3>
			<div class='dbx-content'>
				<strong class='bbcode bold'>Bem Vindo !</strong>
                <br />
                <?=getNomeUsuario($USUARIO);?>
                <br />
                <br />
                <a href="#" onclick="executar('lib/login/logof','aplicacao')">Sair</a>
			</div>
		</div>