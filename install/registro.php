<?
error_reporting(0);
ini_set('error_reporting', E_ALL);
//
if(PHP_OS != "WINNT") { $OS="Lin"; } else { $OS="Win"; }
//
$NOMESISTEMA="Registro";
$MODULOSISTEMA="Registro para Utiliza&ccedil;&atilde;o do Sistema";
$DISCRICAOSISTEMA="Registro para Utiliza&ccedil;&atilde;o do Sistema";
$IU="registro"; $msn="";
//
if (isset($_POST["registrar"])){
	$registro=$_POST["registro"]; 
	$fp = fopen($FUNCOES->trocadml("./install/serial.key"), "w");
	fwrite($fp, $registro);
	fclose($fp);
	$msn="Sistema registrado com sucesso."; $ok=1;
}
//

include($FUNCOES->trocadml("./ev/lib/head.php"));
include($FUNCOES->trocadml("./iu/lib/head.php"));

include($FUNCOES->trocadml("./ev/lib/topo.php"));
include($FUNCOES->trocadml("./iu/lib/topo.php"));

include($FUNCOES->trocadml("./ev/lib/menu.php"));
include($FUNCOES->trocadml("./iu/lib/menu.php"));

include($FUNCOES->trocadml("./ev/lib/breadCrumb.php"));
include($FUNCOES->trocadml("./iu/lib/breadCrumb.php"));
?>

			<div class="left" id="main" <? if (!isset($barraLateral)) { echo "style=\"width:100%; border-right:0;\""; } ?> >
				<div id="main_content">

					<div class="post">
						
                        <div class="post_title"><h2><?=$DISCRICAOSISTEMA;?></h2></div>
                        
   						<div class="post_body">

						<p>Para continuar a utiliza&ccedil;&atilde;o do sistema &eacute; necessario registralo.</p>
                        
                        <p>Para realizar o registro do sistema, clique no link a seguir: <a href="http://www.leandroviana.com.br/projetos/registro/aplicacao.php" target="_blank">Leandro Viana</a></p>
                        
                        <p>Ap&oacute;s realizar o cadastro e logar no sistema.</p>
                        
                        <p>Selecione a op&ccedil;&atilde;o "Sistema", e informe os seguintes dados.</p>

                        <table>
                        <tr>
                        	<td>Sistema Operacional</td><td><?=PHP_OS;?>
                        </td>
                        <tr>
                        	<td>Registro da Maquina</td><td><?=md5($FUNCOES->mac(0));?>
                        </td>
                        </table>
                        
                        <p>Ap&oacute;s informar os dados acima.</p>
                        
                        <p>Informe os dados fornecidos pelo site no campo abaixo</p>

                        <p><textarea cols="100" rows="8" name="registro" class="box"></textarea></p>
                        
                        <? if (!isset($ok)) { ?>
                        <p><input type="submit" name="registrar" value="registrar" class="button" /></p>
                        <? } else { ?>
                        <p><input type="button" name="voltar" value="voltar ao sistema" class="button" onclick="document.location='index.php'" /></p>
                        <? } ?>
                        
                        
						</div>                        

					</div>	
								
				</div>
			</div>

<?
include($FUNCOES->trocadml("./ev/lib/rodape.php"));
include($FUNCOES->trocadml("./iu/lib/rodape.php"));
?>