<html lang="pt-br">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$NOMESISTEMA;?> - <?=$MODULOSISTEMA;?> - <?=$ROTINASISTEMA;?></title>

    <link href="./iu/lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="./iu/lib/css/jquery.jgrowl.css" rel="stylesheet">
    <link href="./iu/lib/css/jumbotron.css" rel="stylesheet">
	<link rel="stylesheet" media="all" type="text/css" href="./iu/lib/css/jquery-impromptu.css" />

    <script type="text/javascript" src="./iu/lib/js/jquery-1.7.2.min.js"></script>
	<script src="./iu/lib/js/ie-emulation-modes-warning.js"></script>
	<script src="./iu/lib/js/script.js"></script>
	<script src="./iu/lib/js/jq.js"></script>
	<script src="./iu/lib/js/jquery-impromptu.js"></script>
	
</head>

<body>
<form method="POST" action="<?=$FUNCOES->ACTION;?>" name="aplicacao">
<input type="hidden" name="IU" value="<?=$IU;?>">
<input type="hidden" name="evento" value="<?=$evento;?>">
<input type="hidden" name="codigo" value="<? if (isset($codigo)) { echo $codigo; }?>">
<? if ($GLOBALS["msn"]<>""){ ?><script>$.prompt('<?=$GLOBALS["msn"];?>');</script><? } ?>
