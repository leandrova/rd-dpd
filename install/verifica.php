<?
function verificaFunc(){
	$ret=0;
	//
	// Verifica se arquivos de coneccao existe
	if (!file_exists("./iu/lib/js/conecta_mysql.inc")) $ret=1;
	if (!file_exists("./iu/lib/js/conecta_mysqli.inc")) $ret=1;
	if (!file_exists("./install/serial.key")) $ret=1;
	//
	if (file_exists("./iu/lib/js/conecta_mysql.inc")){
		//
		include("./iu/lib/js/conecta_mysql.inc");
		include("./install/tabelas.php");
		//
		$sql=" select * from information_schema.tables where TABLE_SCHEMA='$SISbanco'";
		$res=mysql_query($sql); $linhas=mysql_affected_rows();
		if ($linhas>0){ 
		while ($obj=mysql_fetch_object($res)){ 
			$listaTabelas[$obj->TABLE_NAME]="";
		}
		}
		//
		foreach ($tabelas as $key => $value) {
			if (!isset($listaTabelas[$key])) { $ret=1; }
		}
	}
	return $ret;
} 

?>