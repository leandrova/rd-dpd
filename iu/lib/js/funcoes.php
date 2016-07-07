<?

class CONEXAO
{
	
	public $conexao;
	public $SIShost; 
	public $SISlogin; 
	public $SISsenha; 
	public $SISbanco; 
	public $ACTION="aplicacao.php";
	public $DIAS=3600;                        /* QUANTIDADE DE DIAS PARA EXPIRAR A LICENÇA */
	public $DATA;
	public $HORA;
	public $LOGSQL;
	
	function __construct()
	{
		if (file_exists("./iu/lib/js/conecta_mysql.inc"))
		{
			include("./iu/lib/js/conecta_mysql.inc");
			$this->SIShost=$SIShost;
			$this->SISlogin=$SISlogin;
			$this->SISsenha=$SISsenha;
			$this->SISbanco=$SISbanco;
			$this->abreConexao();
		}
		$this->DATA=date("Y-m-d");
		$this->HORA=date("H:i:s");
	}
	
	function __destruct()
	{
		if ($this->conexao<>""){
			$this->fechaConexao();
		}
	}
	
	private function abreConexao()
	{
		$this->conexao=mysql_connect($this->SIShost,$this->SISlogin,$this->SISsenha); 
		mysql_set_charset('utf8',$this->conexao);
		mysql_select_db($this->SISbanco);
		if (mysql_error()<>"") { $this->conexao=""; }
	}
	private function fechaConexao()
	{
		mysql_close($this->conexao);
	}
	
}

class SQL extends CONEXAO
{
	
	private $resultado;
	private $sql;
	private $linhas;
	private $ID;
	public	$sqlList = array();
	public	$mysqlError;
	public	$IU;
	public	$USUARIO;

	private function processaSql()
	{
		if ($this->conexao)
		{
			$this->resultado=mysql_query($this->sql);
			$this->ID=mysql_insert_id();
			$this->linhas=mysql_affected_rows();
			$this->mysqlError=str_replace("'","",mysql_error());
			if ($this->LOGSQL) $this->sqlList[]=$this->sql." => ".$this->linhas." => ".$this->mysqlError;
		}
	}

	public function GetResultado()
	{
		return $this->resultado;
	}
	
	public function GetSql()
	{
		return $this->sql;
	}
	
	public function GetID()
	{
		return $this->ID;
	}
	
	public function GetLinhas()
	{
		return $this->linhas;
	}
	
	public function GetSqlList()
	{
		return $this->sqlList;
	}

	public function GetMysqlError()
	{
		return $this->mysqlError;
	}
	
	public function executaSql($sql)
	{
		$this->sql=$sql;
		$this->processaSql();
	}
	
	public function navegacao($tipo,$situacao,$dado,$informacao)
	{
		/*
			Utilizacao da Pagana		navegacao("navegacao",situacao,dado); [Situacao = "navegacao" ] [ Dado = Variavel Importante ]
			Eventos						navegacao("eventos",situacao,dado); [Situacao = Cadastra - Alteracao - Exclusao ] [ Dado = O que cadastrou ]
			Busca						navegacao("busca",situacao,dado); [Situacao = O que buscou ] [ Dado = O que cadastrou ]
		*/
		$this->LOGSQL=0;
		$this->cadastro(	array(	"tabelas" => "navegacao", 
									"campos" => "codigo, tipo, situacao, dado, informacao, tela, usuario, data, hora", 
									"values" => "'', '$tipo', '$situacao', '$dado', '$informacao', '$this->IU', '$this->USUARIO', '$this->DATA', '$this->HORA' "
								)
						);
	}
	
	public function consulta($array)
	{
		if (isset($array["campos"])) 	{ $campos=$array["campos"]; } else { $campos="*"; 			}
		$this->sql="select ".$campos." ";																// campos
		$this->sql.="from ".$array["tabelas"]." ";														// tabelas
		if (isset($array["condicoes"])) {	$this->sql.="where ".$array["condicoes"]." ";			}	// condicoes
		if (isset($array["agrupamento"])) {	$this->sql.="group by ".$array["agrupamento"]." ";		}	// agrupamento
		if (isset($array["ordenacao"])) {	$this->sql.="order by ".$array["ordenacao"]." ";		}	// ordenacao
		if (isset($array["limite"])) {	$this->sql.="limit ".$array["limite"]." ";		}	// limite
		$this->processaSql();
	}
	
	public function cadastro($array)
	{
		$this->LOGSQL=1;
		$this->sql="INSERT INTO ".$array["tabelas"]." ";		// tabelas
		$this->sql.="(".$array["campos"].") ";					// campos
		$this->sql.="VALUES (".$array["values"].") ";			// values
		if ($this->diasExpira()>0) { $this->processaSql(); } else { $this->licensaExpirada(); }
	}
	
	public function altera($array)
	{
		$this->LOGSQL=1;
		$this->sql="UPDATE ".$array["tabelas"]." ";				// tabelas
		$this->sql.="SET ".$array["campos"]." ";				// campos
		$this->sql.="WHERE ".$array["condicoes"]." ";			// condicoes
		if ($this->diasExpira()>0) { $this->processaSql(); } else { $this->licensaExpirada(); }
	}
	
	public function deleta($array)
	{
		$this->LOGSQL=1;
		$this->sql="delete from ".$array["tabelas"]." ";		// tabelas
		$this->sql.="WHERE ".$array["condicoes"]." ";			// condicoes
		if ($this->diasExpira()>0) { $this->processaSql(); } else { $this->licensaExpirada(); }
	}
	
	public function licensaExpirada()
	{
		$this->linhas=0; 
		$this->mysqlError="Sua Licensa Expirou.<br>Este tipo de operacao nao é mais possivel.<Br>Renove sua Licensa.";
	}
	
	
	public function dataExpira()
	{
		$fp = fopen($this->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1),'r'); $ret2="";
		if (filesize($this->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1)))
		{
			$texto = fread($fp, filesize($this->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1)));
			$vt=explode(chr(13).chr(10),$texto); $i=0;
			foreach ($vt as $value)
			{
		    	$i=$i+1;
				$vtt=explode("=",$value); 
				if ($vtt[0]==$this->code("RGF0ZQ==",1))
				{
					$ret2=substr($vtt[1], 0, 16);
					$ret2=date('Y-m-d', strtotime($ret2." +".$this->DIAS." days"));
				}
			}
		}
		return $ret2;
	}
	
	public function diasExpira()
	{
		return $this->difDias($this->dataExpira(), $this->DATA);
	}
	
	public function difDias($dtIni, $dtFim)
	{
		//defino data 1 
		if ($dtIni=="") { $dtIni=$this->DATA; }
		if ($dtFim=="") { $dtFim=$this->DATA; }
		/**/
		list($ano1, $mes1, $dia1) = explode('-', $dtIni);
		//defino data 2 
		list($ano2, $mes2, $dia2) = explode('-', $dtFim);	
		//calculo timestam das duas datas 
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
		$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2); 
		//diminuo a uma data a outra 
		$segundos_diferenca = $timestamp1 - $timestamp2; 
		//converto segundos em dias 
		$dias_diferenca = $segundos_diferenca / (60 * 60 * 24); 	
		//obtenho o valor absoluto dos dias (tiro o possível sinal negativo) 
		//$dias_diferenca = abs($dias_diferenca); 
		//tiro os decimais aos dias de diferenca 
		$dias_diferenca = floor($dias_diferenca); 
		//
		return $dias_diferenca; 
	}
	
}

class FUNCOES extends SQL
{

	function trocadml($str)
	{
		$info=get_defined_constants(); 
		$dmlP= $info['DIRECTORY_SEPARATOR'];
		$string=str_replace("/",$dmlP,$str);
		return $string;
	}

	public function getPost($var)
	{
		if (isset($_POST[$var]))
		{
			return $_POST[$var];
		}
		else
		{
			return "";
		}

	}
	
	public function getGet($var)
	{
		if (isset($_GET[$var]))
		{
			return $_GET[$var];
		}
		else
		{
			return "";
		}
	}
	
	public function code($a,$b)
	{
		if ($b)
		{
			$ret=base64_decode($a); 
		}
		else
		{
			$ret= base64_encode($a);
		}
		return $ret;
	}
	
	public function mac($n)
	{
		$info=get_defined_constants(); $dmlP= $info['DIRECTORY_SEPARATOR']; $retorno="";
		if ($dmlP=="/")
		{
			exec($this->code("aWZjb25maWcgfCBncmVwIGV0aA==",1).$n, $saida);
			if ((!isset($saida[0]))&($n<10)) $this->mac($n+1);
			if (isset($saida[0])) { $retorno = substr($saida[0], -17); }
		}else
		{
			exec($this->code("aXBjb25maWcgL2FsbA==",1), $saida);
			$ret=utf8_encode($saida[13]); 
			$ret=explode(":",$ret); 
			if (isset($ret[1])) { $retorno = $ret[1]; } else { $retorno=""; }
			if ($retorno=="")  { $retorno=$ret[0]; }
		}
		return $retorno;
	}
	
	public function vldArq()
	{
		$fp = fopen($this->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1),'r'); $ret=""; $vld=0; $kk=""; $ret2="";
		if (filesize($this->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1)))
		{
			$texto = fread($fp, filesize($this->code("Li9pbnN0YWxsL3NlcmlhbC5rZXk=",1)));
			$vt=explode(chr(13).chr(10),$texto); $i=0;
			foreach ($vt as $value)
			{
		    	$i=$i+1;
				$vtt=explode("=",$value); 
				if ($vtt[0]<>$this->code("QXV0aG9yaXphdGlvbktleQ==",1))
				{
					$ret.=$vtt[1];
				}
				else
				{
					$kk=$vtt[1];
				}
				if ($vtt[0]==$this->code("TWFjaGluZUlE",1))
				{
					$ret.=substr($vtt[1], 0, 16);
				}
				if ($vtt[0]==$this->code("RGF0ZQ==",1))
				{
					$ret2=substr($vtt[1], 0, 16);
				}
			}
			if ($i)
			{
				if (md5($ret)==$kk) { $vld=1; }
			}
		}
		return $vld;
	}
	

	public function dataExterna($data)
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
	
	public function dataInterna($data)
	{
    	if ($data=="")
		{
        	$data="";
		}
		else
		{
	        $data=str_replace("/","-",$data);
	    	$vt=explode("-",$data);
			if ( (isset($vt[1])) & (isset($vt[0])) & (isset($vt[2])) )
			{
				$valida = checkdate($vt[1], $vt[0], $vt[2]);
				if ($valida)
				{
					$data="$vt[2]-$vt[1]-$vt[0]";
				}
				else
				{
					$data="";
				}
			}
			else
			{
				$data="";
			}
    	}
		return $data;
	}
	
	public function dadosLogin($login)
	{
    	$this->LOGSQL=0;	$nome=$login;
		$this->consulta(array("campos" => "*","tabelas" => "usuarios","condicoes" => " login='$login' "));
    	$this->LOGSQL=1;
		if ($this->GetLinhas()>0)
		{
			$obj=mysql_fetch_object($this->GetResultado());
	    	$dados["nome"]=$this->formataNome($obj->nome);
			$dados["email"]=$obj->email;
			$dados["telefone"]=$obj->telefone;
			$dados["data"]["senha"]=$obj->dataSenha;
			$dados["data"]["diasSenha"]=$this->difDias($obj->dataSenha, date('Y-m-d'));
		}
    	return $dados;
	}
	
	public function tempoSenha($login){
		$this->LOGSQL=0;	$data="";
		$this->consulta(array("campos" => "*","tabelas" => "usuarios","condicoes" => " login='$login' "));
    	$this->LOGSQL=1;
		if ($this->GetLinhas()>0)
		{
			$obj=mysql_fetch_object($this->GetResultado());
			$data=$obj->dataSenha;
		}
		if ($data=="")
		{ 
			$dias=1000;
		}
		else
		{
			$dias = $this->difDias(date('Y-m-d'),$data);
		}
	    //
		return $dias;
	}

	
	public function formataNome($nome)
	{
		$vt=explode(" ",$nome); $nome="";
		foreach($vt as $value)
		{
	    	$nome.= strtoupper(substr($value,0,1)).strtolower(substr($value,1,30))." ";
		}
		return $nome;
	}
	
	public function getPermissao($modulo,$rotina,$funcao,$tipo,$usuario)
	{
    	$this->LOGSQL=0;	$permissao=0;
		if ($rotina=="")
		{
			$testaRotina="";
		}
		else
		{
			$testaRotina="and codRotina='$rotina'";
		}
		if ($funcao=="")
		{
			$testaFuncao="";
		}
		else
		{
			$testaFuncao="and codFuncao='$funcao'";
		}
		$this->consulta(array("campos" => "*","tabelas" => "permissao","condicoes" => " codModulo='$modulo' ".$testaRotina." ".$testaFuncao." and login='$usuario' "));
		$this->LOGSQL=1;
		if ($this->GetLinhas()>0)
		{
			if ($testaFuncao=="")
			{
				$permissao=1;
			}
			else
			{
				$obj=mysql_fetch_object($this->GetResultado());
				if ($tipo<=$obj->permissao)
				{
					$permissao=1;
				}
			}
    	}
    	return $permissao;
	}
	
	public function somaTime($HoraInicial,$Duracao)
	{
		//Converte em Minutos o horário inicial
		$MinutosIniciais = explode(':',$HoraInicial);
		$TempoInicial = ($MinutosIniciais[0]*60) + $MinutosIniciais[1] ;
		//Converte em Minutos o horário final
		$Duracao = explode(':',$Duracao);
		$Duracao = ($Duracao[0]*60) + $Duracao[1] ;
		//Subtrai os minutos
		$TotalMinutos =  ($Duracao + $TempoInicial);
		//Converte os minutos para horas
		$NHoras = floor($TotalMinutos/60);
		$NMinutos = ($TotalMinutos%60);
		//
		if(strlen($NMinutos) != 2 )
		{
			$NMinutos = $NMinutos."0";	
		}
		if ($NHoras > 23 )
		{
			$NHoras=$NHoras-24;
		}
		//
		$NHoras=$NHoras+100;
		$NHoras=substr($NHoras,1,2);
		//
		return $NHoras.':'.$NMinutos.":00";
	}

	public function formataValor($valor)
	{
		$casas = 3;	
		$valor = number_format($valor,$casas,',','.');
		return $valor;
	}

	public function segMin($seg)
	{
		$min=explode(".",$seg/60); $min=$min[0];
		$seg=$seg%60;
		$ret=$min.".".$seg;
		return $ret;
	}

	public function converte_segundos($total_segundos)
	{
		$dias_por_mes=((((365*3)+366)/4)/12);
		$inicio = 'Y';
		$comecou = false;
		//
		if ($inicio == 'Y')
		{
			$array['anos'] = floor( $total_segundos / (60*60*24* $dias_por_mes *12) );
			$total_segundos = ($total_segundos % (60*60*24* $dias_por_mes *12));
			$comecou = true;
		}
		if (($inicio == 'm') || ($comecou == true))
		{
			$array['meses'] = floor( $total_segundos / (60*60*24* $dias_por_mes ) );
			$total_segundos = ($total_segundos % (60*60*24* $dias_por_mes ));
			$comecou = true;
		}
		if (($inicio == 'd') || ($comecou == true))
		{
			$array['dias'] = floor( $total_segundos / (60*60*24) );
			$total_segundos = ($total_segundos % (60*60*24));
			$comecou = true;
		}
		if (($inicio == 'H') || ($comecou == true))
		{
			$array['horas'] = floor( $total_segundos / (60*60) );
			$total_segundos = ($total_segundos % (60*60));
			$comecou = true;
		}
		if (($inicio == 'i') || ($comecou == true))
		{
			$array['minutos'] = floor($total_segundos / 60);
			$total_segundos = ($total_segundos % 60);
			$comecou = true;
		}
		$array['segundos'] = $total_segundos;

		$ret="";
		if ($array['anos']<>0) 		{ $ret.=$array['anos']." dia(s), "; 			}
		if ($array['meses']<>0) 	{ $ret.=$array['meses']." mes(es), "; 			}
		if ($array['dias']<>0) 		{ $ret.=$array['dias']." dia(s), "; 			}
		if ($array['horas']<>0) 	{ $ret.=$array['horas']." hora(s), "; 			}
		if ($array['minutos']<>0) 	{ $ret.=$array['minutos']." minuto(s), "; 		}
		if ($array['segundos']<>0) 	{ $ret.=$array['segundos']." segundo(s)."; 	}
	
		return $ret;
	}
	
	public function diasemana($data)
	{
		$ano =  substr("$data", 0, 4);
		$mes =  substr("$data", 5, -3);
		$dia =  substr("$data", 8, 9);
		$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
		//
		switch($diasemana)
		{
			case"0": $diasemana = "Domingo";       			break;
			case"1": $diasemana = "Segunda-Feira"; 			break;
			case"2": $diasemana = "Ter&ccedil;a-Feira";   	break;
			case"3": $diasemana = "Quarta-Feira";  			break;
			case"4": $diasemana = "Quinta-Feira";  			break;
			case"5": $diasemana = "Sexta-Feira";   			break;
			case"6": $diasemana = "S&aacute;bado";        	break;
		}
		return $diasemana;
	}
	
	function converteHoraSegundo($hora)
	{
		$v=explode(":",$hora);
		$hr=$v[0]; 		$mn=$v[1]; 		$sg=$v[2];
		$hr=$hr*3600;	$mn=$mn*60;
		return ($hr+$mn+$sg);
	}
}
?>