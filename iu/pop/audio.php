<?
if (isset($_GET["audio"])){

$caminho=base64_decode($_GET["audio"]);

if (file_exists($caminho)) {

?>

<html>
<head><title>Audio</title></head>
<body>

<embed src="<?=$caminho;?>" width="100%" height="100%" autoplay="false"></embed>

</body>
</html>
<?

}else{
	echo "Audio n&atilde;o encontrado.";
}

}else{
	echo "Audio n&atilde;o informado.";
}
?>