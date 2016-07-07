<?
	$data=date('y/m/d');
	$hora=getdate();  $hora=($hora['hours'].':'.$hora['minutes']); 
	$login=$USUARIO;
	//
    $getSql="Select * from usuariohistorico where login='$login' order by dataLogin, horaLogin desc";
    $getRes=mysql_query($getSql);  $linhas=mysql_affected_rows();
	if ($linhas>0){
	    $obj=mysql_fetch_object($getRes);
		$dataLogin=$obj->dataLogin; $horaLogin=$obj->horaLogin;
		$res=mysql_query("UPDATE usuariohistorico SET datalogof='$data', horalogof='$hora' where login='$login' and dataLogin='$dataLogin' and horaLogin='$horaLogin'  ");
	}
	$_SESSION["USUARIO"]="";
?>
<script>
	document.location='./aplicacao.php'
</script>
