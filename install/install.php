<?
error_reporting(0);
ini_set('error_reporting', E_ALL);
//
if(PHP_OS != "WINNT") { $OS="Lin"; } else { $OS="Win"; }
//
include($FUNCOES->trocadml("./install/tabelas.php"));
include($FUNCOES->trocadml("./install/variaveis.php"));
//
if (isset($_POST["system"]))	{ $system=$_POST["system"]; 	} else { $system=PHP_OS; 	}
if (isset($_POST["customer"]))	{ $customer=$_POST["customer"]; } else { $customer=""; 		}
if (isset($_POST["host"])) 		{ $host=$_POST["host"]; 		} else { $host="127.0.0.1"; }
if (isset($_POST["login"])) 	{ $login=$_POST["login"]; 		} else { $login="";			}
if (isset($_POST["senha"])) 	{ $senha=$_POST["senha"]; 		} else { $senha="";			}
if (isset($_POST["banco"])) 	{ $banco=$_POST["banco"]; 		} else { $banco="";			}
//
include($FUNCOES->trocadml("./install/funcoes.php"));

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
						
                        <div class="post_title"><h2><a href="#">Bem Vindo !</a></h2></div>
                        
   						<div class="post_body">

						<? if (!isset($instalacao)){ ?>
                        <p>Para continuar a instala&ccedil;&atilde;o do sistema, informe os dados abaixo.</p>
                        <? }else {?>
                        <p>Verifique o status da Instalacao abaixo</p>
                        <? } ?>
                        <table>
						<tr>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
                        	<td width="10%">&nbsp;</td>
                        	<td width="20%">&nbsp;</td>
                        	<td width="30%">&nbsp;</td>
                        </tr>
                        <? if (!isset($instalacao)){ ?>
                        <tr>
                        	<td width="20%">Sistema Operacional</td>
                            <? if (!$coneccao) { ?>
                            <td><input type="text" name="system" size="20" readonly="readonly" value="<?=PHP_OS;?>"/></td>
							<? } else { echo "<td>$system</td><td>$imgOK<input type=\"hidden\" name=\"system\" value=\"$system\" /></td>"; } ?>
                        </tr>
                        <tr>
                        	<td width="20%">Empresa</td>
                            <? if (!$coneccao) { ?><td colspan="3"><input type="text" name="customer" size="40" value="<?=$customer;?>"/></td><? } else { echo "<td>$customer</td><td>$imgOK<input type=\"hidden\" name=\"customer\" value=\"$customer\" /></td>"; } ?>
                        </tr>
                        <tr><td><Br /></td></tr>
                        <tr>
                        	<td width="20%">Host do Banco</td>
                        	<? if (!$coneccao) { ?><td><input type="text" name="host" size="20" value="<?=$host;?>"/></td><? } else { echo "<td>$host</td><td>$imgOK<input type=\"hidden\" name=\"host\" value=\"$host\" /></td>"; } ?>
						</tr>
						<tr>
                        	<td>Login</td>
                        	<? if (!$coneccao) { ?><td><input type="text" name="login" size="20" value="<?=$login;?>"/></td><? } else { echo "<td>$login</td><td>$imgOK<input type=\"hidden\" name=\"login\" value=\"$login\" /></td>"; } ?>
						</tr>
                        <tr>
                        	<td>Senha</td>
                        	<? if (!$coneccao) { ?><td><input type="password" name="senha" size="10" value="<?=$senha;?>"/></td><? } else { echo "<td>******</td><td>$imgOK<input type=\"hidden\" name=\"senha\" value=\"$senha\" /></td>"; } ?>
						</tr>
                        <? if ($coneccao) { ?>
                        <tr>
                        	<td>Banco de Dados</td>
						<? if (!isset($statusBanco)) { ?><td><input type="text" name="banco" size="10" value="<?=$banco;?>"/></td><? } else { echo "<td>$banco<input type=\"hidden\" name=\"banco\" value=\"$banco\" /></td>"; if ($statusBanco) { echo "<td>$imgOK</td>"; } else { echo "<td>$imgErr</td><td>&nbsp;</td><td><font size=1 color=red >Esta Banco sera criado</font></td>"; } }?>
                        </tr>
						<? } ?>
                        <? if (isset($statusBanco)) { ?>
						<tr>
                        	<td><br /></td>
						</tr>
                        <tr>
                        	<td>Lista de Tabelas</td>
                        </tr>
                        <? foreach ($tabelas as $key => $value) {
						echo "<tr>";
						echo "<td>&nbsp;</td>";
						echo "<td>$key</td>";
						echo "<td>&nbsp;</td>";
						if (isset($listaTabelas[$key])) { echo "<td>$imgOK</td>"; } else { echo "<td>$imgErr</td><td><font size=1 color=red >Esta tabela sera criada</font></td>"; }
						echo "</tr>";
						}
 						?>
                        <tr>
                        	<td colspan="5">Lista de Arquivos</td>
                        </tr>
						<tr>
							<td>&nbsp;</td>
							<td>conecta_mysql</td>
							<td>&nbsp;</td>
                            <? if (file_exists("./iu/lib/js/conecta_mysql.inc")) { echo "<td>$imgOK</td><td><font size=1 color=blue >Para seguranca este arquivo sera refeito</font></td>"; } else { echo "<td>$imgErr</td><td><font size=1 color=red >Este arquivo sera criado</font></td>"; } ?>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>conecta_mysqli</td>
							<td>&nbsp;</td>
                            <? if (file_exists("./iu/lib/js/conecta_mysqli.inc")) { echo "<td>$imgOK</td><td><font size=1 color=blue >Para seguranca este arquivo sera refeito</font></td>"; } else { echo "<td>$imgErr</td><td><font size=1 color=red >Este arquivo sera criado</font></td>"; } ?>
						</tr>
                        <tr>
							<td>&nbsp;</td>
							<td>registro</td>
							<td>&nbsp;</td>
                            <? if (file_exists("./install.key")) { echo "<td>$imgOK</td><td><font size=1 color=blue >Para seguranca este arquivo sera refeito</font></td>"; } else { echo "<td>$imgErr</td><td><font size=1 color=red >Este arquivo sera criado</font></td>"; } ?>
						</tr>
                        <tr>
                        	<td><br /></td>
						</tr>
                        <? } ?>
                        <tr>
                        	<td><br /></td>
						</tr>
                        <tr>
                        	<td>
                            <? if (!isset($statusBanco)) { ?>
                            <input type="submit" value="Verificar" class="button"/>
                            <? } else { ?>
                            <input type="submit" value="Instalar" name="instalar" class="button"/>
                            <? } ?>
                            </td>
                        </tr>
                        <? }else { ?>
                        <tr>
                        	<td colspan=5>
                            <table width="100%">
                        <? foreach ($instalacao as $key => $value) {
							echo $value;
	                    } ?>
                        	</table>
                            </td>
                        </tr>
                        <tr>
                        	<td><input type="submit" value="Ir para o Sistema" class="button" onclick="document.location='./index.php'"/></td>
                        </tr>
                        <? } ?>
                        </table>
                        
                        
						</div>                        

					</div>	
								
				</div>
			</div>

<?
include($FUNCOES->trocadml("./ev/lib/rodape.php"));
include($FUNCOES->trocadml("./iu/lib/rodape.php"));
?>