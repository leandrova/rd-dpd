<?
	$IU="m003/r004/f001/i001";
	//
	$nomeArquivo 	= strtoupper(substr($_FILES['arquivo']['name'], 0, -4));
	$extensao 		= strtolower(substr($_FILES['arquivo']['name'],-4)); //Pegando extensão do arquivo
    $new_name 		= $nomeArquivo."_".str_replace("-","",$FUNCOES->DATA).str_replace(":","",$FUNCOES->HORA).$extensao; //Definindo um novo nome para o arquivo
    $dir = './import/'; //Diretório para uploads
    
    if ($extensao <> '.csv') {
        $msn="O arquivo informado não é um CSV.";
    } else {

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$new_name)) {
            $msn="Import realizada com sucesso.";
        } else {
            $msn="Falha no import do arquivo: ".$_FILES["arquivo"]["error"];
        }

    }

?>