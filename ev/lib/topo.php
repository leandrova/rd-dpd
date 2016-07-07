<?
$nomeUsuario=$USUARIO; $dataLogin=$FUNCOES->DATA;	$horaLogin=$FUNCOES->HORA;	$diaSemana=$dataLogin;
if ($FUNCOES->conexao){
$FUNCOES->consulta(	array(	"campos" => "us.nome as nome, uh.dataLogin as data, uh.horaLogin as hora",
							"tabelas" => "usuarios as us, usuariohistorico as uh",
							"condicoes" => " us.login=uh.login and us.login='$USUARIO'",
							"ordenacao" => "uh.dataLogin desc, uh.horaLogin desc"
							)
					);
if ($FUNCOES->GetLinhas()>0){
	$obj=mysql_fetch_object($FUNCOES->GetResultado());
	$nomeUsuario=$obj->nome;
	$dataLogin=$FUNCOES->dataExterna($obj->data);
	$horaLogin=$obj->hora;
	$diaSemana=$FUNCOES->diasemana($obj->data);
}
}

$diasExpira = $FUNCOES->diasExpira();
?>
