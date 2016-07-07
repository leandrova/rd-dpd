<?

// Eventos

$FUNCOES->consulta(
		array(	"campos" => "distinct(dado), tela, informacao, situacao",
				"tabelas" => "navegacao",
				"condicoes" => "usuario='$USUARIO' and tipo='eventos' and situacao<>'Consulta' group by situacao, dado",
				"ordenacao" => "data desc, hora desc limit 5"
				)
			);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado())){
			$tela=explode("/",$obj->tela);
			$listaEventos[]="
				<li><a href=\"#\" onclick=\"document.aplicacao.codigo.value='$obj->informacao'; executar('".$tela[0]."/".$tela[1]."/".$tela[2]."/loadBusca','aplicacao')\" >".$obj->situacao." ".$obj->dado." [".$obj->informacao."]</a></li>";
		}
	}


// Busca

$FUNCOES->consulta(
		array(	"campos" => "situacao, tela, dado, informacao",
				"tabelas" => "navegacao",
				"condicoes" => "usuario='$USUARIO' and tipo='eventos' and situacao='Consulta' and informacao is not null and informacao<>'' and dado is not null and dado<>'' group by dado, situacao",
				"ordenacao" => "data desc, hora desc limit 5"
			)
		);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado())){
			$tela=explode("/",$obj->tela);
			$listaBusca[]="
				<li><a href=\"#\" onclick=\"document.aplicacao.codigo.value='$obj->informacao'; executar('".$tela[0]."/".$tela[1]."/".$tela[2]."/loadBusca','aplicacao')\" >".$obj->situacao." ".$obj->dado." [".$obj->informacao."]</a></li>";
		}
	}

// Navegação

$FUNCOES->consulta(
		array(	"campos" => "dado, tela",
				"tabelas" => "navegacao",
				"condicoes" => "usuario='$USUARIO' and tipo='navegacao' and dado is not null and dado<>'' group by dado",
				"ordenacao" => "data desc, hora desc limit 5"
			)
		);
	if ($FUNCOES->GetLinhas()>0)
	{
		$qnt=0;
		while ($obj=mysql_fetch_object($FUNCOES->GetResultado())){
			$tela=explode("/",$obj->tela);
			$listaNavegacao[]="
				<li><a href=\"#\" onclick=\"executar('".$tela[0]."/".$tela[1]."/".$tela[2]."/load','aplicacao')\" >".$obj->dado."</a></li>";
		}
	}


?>