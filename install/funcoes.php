<?
// Verifica se a conecção funcionou
if ( ($host<>"")&($login<>"") ){
//
$link = mysql_connect($host, $login, $senha);
	// Verifica conecxao
	if (!$link) { $msn='N&atilde;o foi poss&iacute;vel conectar: ' . mysql_error(); } else { $coneccao=1; }
	//
	if ($banco<>"") { 
		$sql=" select * from information_schema.schemata where SCHEMA_NAME='$banco' ";
		$res=mysql_query($sql); $linhas=mysql_affected_rows(); if ($linhas>0){ $statusBanco=1;	} else { $statusBanco=0; }
		//
		if ($statusBanco){
		$sql=" select * from information_schema.tables where TABLE_SCHEMA='$banco'";
		$res=mysql_query($sql); $linhas=mysql_affected_rows();
		if ($linhas>0){ while ($obj=mysql_fetch_object($res)){ $listaTabelas[$obj->TABLE_NAME]=""; } }
		}
	}
	//
	// Instala o Sistema
	if (isset($_POST["instalar"])){
		//
		// Criar o banco
		if (!$statusBanco){
			$sql=" CREATE DATABASE $banco "; $res=mysql_query($sql);
			if (mysql_error()=="") { $instalacao[]="<tr><td>DATABASE</td><td>$banco</td><td>criar<td>Criada com sucesso</td></tr>"; } else { $instalacao[]="<tr><td>DATABASE</td><td>$banco</td><td>criar</td><td>Error (".mysql_error().")</td></tr>"; $baseError=1; }
		}else{
			$instalacao[]="<tr><td>DATABASE</td><td>$banco</td><td>criar<td>Base ja existe</td></tr>";
		}
		//
		//
		if (!isset($baseError)){
			//
			// Criar as Tabelas
			mysql_select_db($banco);
			// Criando Tabelas
			foreach ($tabelas as $key => $sub){
				foreach ($sub as $keyy => $valuee){
					$sql=$tabelas[$key][$keyy];
					if ( (isset($listaTabelas[$key]))&(!isset($tabelas[$key]["apagar"])) ){
						$instalacao[]="<tr><td>TABLE</td><td>$key</td><td>$keyy</td><td>Ja existe</td></tr>";
					}else{
						if ($sql<>""){
							$res=mysql_query($sql);
							if (mysql_error()=="") { $instalacao[]="<tr><td>TABLE</td><td>$key</td><td>$keyy</td><td>Operacao Realizada</td></tr>"; } else { $instalacao[]="<tr><td>TABLE</td><td>$key</td><td>$keyy</td><td>Error (".mysql_error().")</td></tr>"; $tableError=1; }
						}
					}
				}
			}
			//
			if (!isset($tableError)){
				// Cria Arquivo .inc
				$fp = fopen($FUNCOES->trocadml("./iu/lib/js/conecta_mysql.inc"), "w");  fwrite($fp, "<?php "."$"."SIShost=\"$host\"; "."$"."SISlogin=\"$login\"; "."$"."SISsenha=\"$senha\"; "."$"."SISbanco=\"$banco\"; "."$"."conexao=mysql_connect("."$"."SIShost,"."$"."SISlogin,"."$"."SISsenha); mysql_select_db("."$"."SISbanco); ?>");	fclose($fp);
				$instalacao[]="<tr><td>Arquivo</td><td>conecta_mysql</td><td>criar</td><td>Operacao Realizada</td></tr>";
				//
				$fp = fopen($FUNCOES->trocadml("./iu/lib/js/conecta_mysqli.inc"), "w");  fwrite($fp, "<? "."$"."SIShost=\"$host\"; "."$"."SISlogin=\"$login\"; "."$"."SISsenha=\"$senha\"; "."$"."SISbanco=\"$banco\"; "."$"."mysqli = new mysqli("."$"."SIShost,"."$"."SISlogin,"."$"."SISsenha,"."$"."SISbanco); if (!"."$"."mysqli) { printf(\"Connect failed: %s
\", mysqli_connect_error()); } ?>");	fclose($fp);
				$instalacao[]="<tr><td>Arquivo</td><td>conecta_mysqli</td><td>criar</td><td>Operacao Realizada</td></tr>";
				//
				$fp = fopen($FUNCOES->trocadml("./install/serial.key"), "w");  
				fwrite($fp, "System=".$system.chr(13).chr(10)."CustomerName=".$customer.chr(13).chr(10)."ExpirationDate=".chr(13).chr(10)."MachineID=".md5($FUNCOES->mac(0)).chr(13).chr(10)."AuthorizationKey=");	fclose($fp);
				$instalacao[]="<tr><td>Arquivo</td><td>Registro</td><td>criar</td><td>Operacao Realizada</td></tr>";
			}
		}
		//
	}
	//	
mysql_close($link);
}
?>