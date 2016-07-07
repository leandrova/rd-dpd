<?
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
/**/
include("./conecta_mysql.inc");
$conexao=mysql_connect($SIShost,$SISlogin,$SISsenha); 
mysql_set_charset('utf8',$conexao);
mysql_select_db($SISbanco);
/**/

	$dados[]="
				
	<table border=1 style=\"font-size: 0.8em;border-color: #FFF\">
		<tr style=\"font-weight: bold;background-color: #DFF0D8;text-align: center;\">
			<td style=\"border-color: #FFF\">Nome Projeto</td>
			<td style=\"border-color: #FFF\">Descricao</td>
			<td style=\"border-color: #FFF\">Status</td>
			<td style=\"border-color: #FFF\">Nome Frente</td>
			<td style=\"border-color: #FFF\">Descricao Frente</td>
			<td style=\"border-color: #FFF\">Origem</td>
			<td style=\"border-color: #FFF\">Recurso</td>
			<td style=\"border-color: #FFF\">Fase</td>
			<td style=\"border-color: #FFF\">Tipo</td>
			<td style=\"border-color: #FFF\">Historico</td>
		</tr>";

$res = mysql_query("
	select 	p1.codigoProjeto,
			p1.nomeProjeto, 
			f1.codigoFrente,
			p1.descricao, 
			s1.descricaoStatus, 
			f1.nomeFrente, 
			f1.descricaoFrente, 
			o1.nomeOrigem, 
			r1.usuarioRecurso, 
			f2.nomeFase, 
			descricaoTipo
	from 	dcd_projetos p1, 
			dcd_frentes f1, 
			dcd_origemprojetos o1, 
			dcd_tiposprojeto t1, 
			dcd_fasesprojetos f2, 
			dcd_recursos r1, 
			dcd_memoriaprojetos m1, 
			dcd_statusprojeto s1 
	where 	( f1.codigoStatus = 1 or f1.codigoStatus = 2 ) 
			and f1.codigoFase <> 11 
			and f1.codigoStatus = s1.codigoStatus 
			and p1.codigoProjeto = f1.codigoProjeto 
			and f1.codigoOrigem = o1.codigoOrigem 
			and f1.codigoTipoProjeto = t1.codigoTipoProjeto 
			and f1.codigoFase = f2.codigoFase 
			and f1.codigoRecurso = r1.codigoRecurso 
			and m1.codigoOrigem = f1.codigoOrigem 
			and m1.codigoTipoProjeto = f1.codigoTipoProjeto 
			and m1.codigoFase = f1.codigoFase 
	order by p1.nomeProjeto, 
			f1.nomeFrente, 
			f1.dataCadastro ");
$linhas=mysql_affected_rows(); $tpStyle=0;
if ($linhas>0)
{ 
	while ($obj=mysql_fetch_object($res))
	{ 
		/* background-color: #F5F5F5; */
		if ($tpStyle == 0) { $style="style=\"background-color: #F5F5F5;\""; $tpStyle=1; } else { $style=""; $tpStyle=0;  }
		$dados[]="
		<tr $style>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->nomeProjeto)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->descricao)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->descricaoStatus)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->nomeFrente)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->descricaoFrente)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->nomeOrigem)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->usuarioRecurso)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->nomeFase)."</td>
			<td style=\"border-color: #FFF\">".utf8_decode($obj->descricaoTipo)."</td>";

$dados[]="
			<td style=\"border-color: #FFF\">";
		/* Buscando Historico */
		$res1 = mysql_query("
				select	*
				from 	dcd_historico
				where	codigoProjeto = $obj->codigoProjeto and codigoFrente = $obj->codigoFrente
				order by dataHistorico desc
		");
		$linhass=mysql_affected_rows();
		if ($linhass>0)
		{ 
			$dados[]="<table border=0 style=\"font-size: 0.8em;border-color: #FFF\">";
			while ($objj=mysql_fetch_object($res1))
			{ 
				$dados[]="<tr><td>".dataExterna($objj->dataHistorico)."</td><td>".utf8_decode($objj->descricaoHistorico)."</td></tr>";
			}
			$dados[]="</table>";
		}
$dados[]="
			</td>";
		
		
		$dados[]="
		</tr>";
	}
}
		
	$dados[]="
	</table>";
?>
<html>

	<head>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>

		<form name="contador" method="POST">
			<input type="hidden" name="processos" />
		
			<div class="container">
				<h2>Relatorio Full de Projetos</h2>
				
				<div id="time" class="alert alert-success" role="alert">
					
				</div>
				
					<form class="form-inline" role="form">
					<div class="well well-lg">
						<div style="width: 100%;" class="container">
						<h3>Relatorio</h3>
						
						<p>Este relatorio contem todos os Projetos em Andamento e Parados e que nao estao Concluidos.</p>
					
						<? if (isset($dados)) { ?><? foreach ($dados as $key => $value) { echo $value; } ?><? } ?>
						
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