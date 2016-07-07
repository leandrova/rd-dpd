<?
set_time_limit(120000);
date_default_timezone_set('America/Sao_Paulo');
include("./conecta_mysql.inc");
$conexao=mysql_connect($SIShost,$SISlogin,$SISsenha); 
mysql_set_charset('utf8',$conexao);
mysql_select_db($SISbanco);
$DATA=date("Y-m-d");
$HORA=date("H:i:s");
/**/
function dataExterna($data)
{
    if ($data=="")
	{
       	$data="";
	}
	elseif($data=="0000-00-00")
	{
       	$data="";
	}
	else
	{
       	$data=str_replace("/","-",$data);
    	$vt=explode("-",$data);
    	$data="$vt[2]/$vt[1]/$vt[0]";
	}
	return $data;
}
function trocadml($str)
{
	$info=get_defined_constants(); 
	$dmlP= $info['DIRECTORY_SEPARATOR'];
	$string=str_replace("/",$dmlP,$str);
	return $string;
}
/**/
$eventos = "";
if (isset($_POST["processos"])) {
	$acoes = explode(";",$_POST["processos"]);
	foreach ($acoes as $key => $value){
		$eventos[$value]="";
	}
}
/**/

if (isset($eventos["backup"]))
{
	include("./Processos/backupBaseDados.php");
}

/*if (isset($eventos["backupArquivos"]))
{
	include("./Processos/backupArquivos.php");
}*/

if (isset($eventos["ExpurgoRelatorios"]))
{
	include("./Processos/expurgoRelatorios.php");
}

if (isset($eventos["geraRelatorios"]))
{
	include("./Processos/relatorio.php");
}

?>
<html>

	<head>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<script language='Javascript'>
		segundos = 10;
		function incluiEvento(evento){
			if (document.contador.processos.value != ''){
				document.contador.processos.value = document.contador.processos.value + ';' + evento;
			}else {
				document.contador.processos.value = evento;
			}
		}
		function contagem_tempo(){  

			/* Buscando Hora Atual */
			momentoAtual = new Date()
			hora = momentoAtual.getHours()
			minuto = momentoAtual.getMinutes()
			segundo = momentoAtual.getSeconds()
			horaAtual = hora + " : " + minuto + " : " + segundo;
			document.getElementById("time").innerHTML = 'Hota Atual : ' + hora + " : " + minuto + " : " + segundo;
			
			/* Processo Backup Sistema */
			if (horaAtual == '8 : 0 : 0' || horaAtual == '12 : 0 : 0' || horaAtual == '16 : 0 : 0' || horaAtual == '20 : 0 : 0' ){
				incluiEvento('backup');
			}
			
			/* Processo Backup Arquivos */
			if (horaAtual == '8 : 30 : 0' || horaAtual == '12 : 30 : 0' || horaAtual == '16 : 30 : 0' || horaAtual == '20 : 30 : 0' ){
				incluiEvento('backupArquivos');
			}
			
			/* Processo Geração de Relatórios */
			if (horaAtual == '7 : 0 : 0' || horaAtual == '11 : 0 : 0' || horaAtual == '16 : 0 : 0' || horaAtual == '8 : 46 : 15' ){
				incluiEvento('geraRelatorios');
			}
			
			/* Processo Expurgo de Relatórios */
			if (horaAtual == '6 : 0 : 0'){
				incluiEvento('ExpurgoRelatorios');
			}
			
			/* Verifcando se existe algum processo para executar */
			if (document.contador.processos.value != '' ){
				document.forms['contador'].submit();
			}			
			/* */
			
			setTimeout("contagem_tempo()",1000);  
		}    
		</script>
	</head>
	
	<body onload="contagem_tempo()">

		<form name="contador" method="POST">
			<input type="hidden" name="processos" />
		
			<div class="container">
				<h2>Controle de Execucao para Processos Automaticos</h2>
				
				<div class="alert alert-danger" role="alert">
					Essa pagina deve ficar aberta no servidor para garantir a execucao dos processos nos horarios programados
				</div>
				
				<div id="time" class="alert alert-success" role="alert">
					
				</div>
				
					<form class="form-inline" role="form">
					<div class="well well-lg">
						<div style="width: 100%;" class="container">
						<h3>Backup Sistema</h3>
						
						<p>O backup do sistema sao disparados as 08hs, 12hs, 16hs e 20hs</p>
					
						<? if (isset($backup)) { ?><? foreach ($backup as $key => $value) { echo $value; } ?><? } ?>
						
						</div>
					</div>
					
					<div class="well well-lg">
						<div style="width: 100%;" class="container">
						<h3>Backup Arquivos</h3>
						
						<p>O backup dos arquivos sao disparados as 08:30hs, 12:30hs, 16:30hs e 20:30hs</p>
					
						<? if (isset($backupArquivos)) { ?><? foreach ($backupArquivos as $key => $value) { echo $value; } ?><? } ?>
						
						</div>
					</div>
					
					<div class="well well-lg">
						<div style="width: 100%;" class="container">
						<h3>Geracao de Relatorios</h3>
						
						<p>A geracao do relatorio e as 07:00hs, 11:00hs e 16:00hs</p>
					
						<? if (isset($listaRelatorios)) { ?><? foreach ($listaRelatorios as $key => $value) { echo $value; } ?><? } ?>
						
						</div>
					</div>
					
					<div class="well well-lg">
						<div style="width: 100%;" class="container">
						<h3>Expurgo de Relatorios</h3>
						
						<p>O expurgo e disparado as 00:00hs</p>
					
						<? if (isset($expurgoRelatorio)) { ?><? foreach ($expurgoRelatorio as $key => $value) { echo $value; } ?><? } ?>
						
						</div>
					</div>
					
					</form>

			</div>

		</form>

	</body>

</html>
<?
mysql_close($conexao);
?>