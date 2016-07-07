<?
error_reporting(0);
set_error_handler('debug');

function debug($msg,$errno,$errstr,$errfile,$errline) {
	
	?><script>	alert("	\nAtencao foi encontrado um erro na geracao da pagina\nSegue abaixo o detalhe do erro\n\n\nErro....: [<?=$errno;?>] \nEm......: <?=str_replace(chr(92),chr(47),$errstr);?> \nDate....: <?=date("d/m/Y H:i:s");?> \nFile....: <?=$errfile;?> \nLnh.....: <?=str_replace(chr(92),chr(47),$errline["class"]);?> \n ") </script><?
	// Monda o Email
	/**/
	$to      = " Leandro Viana <leandroviana@assim.com.br> ";
	$subject = "Erro no Sistema [".$errno."][".$errstr."][".$_SERVER['SERVER_NAME']."]";
	$headers  = "Content-Type: text/html; charset=iso-8859-1\n";
	$headers .= "From: Sistema <contato@leandroviana.com.br>\n";
	$headers .= "\n";
	/**/
	$body = "
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
		<title>Erros Registrados</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
	</head>
	<body>
	<h1>Dados do Erro</h1>
	<pre>
		\nErro....: [$errno] - $errstr
		\nDate....: ".date("d/m/Y H:i:s") . "
		\nFile....: <b>$errfile</b>
		\nInfo....:\n
		"; foreach ($array as $key => $value) { echo $key."	=>	".$value."\n"; }
	$body .= "
	</pre>	
	<h1>Dados da Sessao</h1>
	<table>
	<tr><td width=\"01%\">&nbsp;</td><td width=\"10%\">&nbsp;</td><td width=\"01%\">&nbsp;</td><td width=\"25%\">&nbsp;</td><td width=\"01%\">&nbsp;</td><td width=\"03%\">&nbsp;</td><td width=\"59%\">&nbsp;</td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_GLOBALS</h2></td></tr>";
	$array=$GLOBALS; foreach ($array as $key => $value) { if (!is_array($value)){	$body .= "<tr><td align=center>[</td><td align=center>_GLOBALS</td><td align=center>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td align=center>]</td><td align=center>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; } }
	$body .="
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_ENV</h2></td></tr>";
	$array=$GLOBALS["_ENV"]; foreach ($array as $key => $value) { $body .= " <tr><td>[</td><td align=center>_ENV</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_argv</h2></td></tr>";
	$array=$GLOBALS["argv"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_argv</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_POST</h2></td></tr>";
	$array=$GLOBALS["_POST"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_POST</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_GET</h2></td></tr>";
	$array=$GLOBALS["_GET"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_GET</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_COOKIE</h2></td></tr>";
	$array=$GLOBALS["_COOKIE"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_COOKIE</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_SERVER</h2></td></tr>";
	$array=$GLOBALS["_SERVER"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_SERVER</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_FILES</h2></td></tr>";
	$array=$GLOBALS["_FILES"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_FILES</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>

	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_REQUEST</h2></td></tr>";
	$array=$GLOBALS["_REQUEST"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_REQUEST</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td><br></td></tr>
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>_array</h2></td></tr>";
	$array=$GLOBALS["array"]; foreach ($array as $key => $value) { $body .= "<tr><td>[</td><td align=center>_array</td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; }
	$body .= "
	<tr><td colspan=7><hr></td></tr>
	<tr><td colspan=4><h2>Dados da Funcao</h2></td></tr>";
	$array=debug_backtrace();
	if (is_array($array)){
		foreach ($array as $key => $value) {
			if (is_array($value)){
				foreach ($value as $keyy => $valuee) {
					if (is_array($valuee)){
						foreach ($valuee as $keyyy => $valueee) {
								$body.="<tr><td>[</td><td align=center>".$key."</td><td>]&nbsp;&nbsp;[</td><td align=center>".$keyy."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$valueee."</td></tr>"; 
						}
					}else{
						$body.="<tr><td>[</td><td align=center>".$key."</td><td>]&nbsp;&nbsp;[</td><td align=center>".$keyy."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$valuee."</td></tr>"; 
					}
				}
			}else{
				$body.="<tr><td>[</td><td align=center> - - </td><td>]&nbsp;&nbsp;[</td><td align=center>".$key."</td><td>]</td><td>&nbsp;=&nbsp;</td><td>".$value."</td></tr>"; 
			}
		}
	}
	$body .="
	</table>
	</body>
	</html>";
	/**/
	//mail($to, $subject, $body, $headers);
	$arquivo=getcwd().chr(92)."debug".chr(92).date("Ymd H i s").".html";
	$fp = fopen($arquivo, "w");
	fwrite($fp, $body);
	fclose($fp);
	echo "<script>$('page').style.display='none';</script>";
	/**/
    die; //Se algum erro existir ele aborta a execução do script
}
?>