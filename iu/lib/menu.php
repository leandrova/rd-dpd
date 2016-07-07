 
<? if ($USUARIO<>"") { ?>
	<!-- Inicio Menu -->
	<div class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
		
			<? if ($USUARIO<>"") { ?>
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Home</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#" onclick="executar('m000/r001/f002/load','aplicacao')"><img src="./images/home.png" width="22px" title="Home"></a>
			</div>
			
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
			<?
			foreach($listaMenu as $key => $value)
			{
			
			if (isset($listaMenuI[$key][$key])==1){
				echo "<li class=\"dropdown\"><a href=\"#\" onclick=\"executar('".$listaMenu[$key][$key][$key]."','aplicacao')\">$key</a></li>";
			} else { 
			
				echo "
			<li class=\"dropdown\">
				<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">$key<span class=\"caret\"></span></a>";
				if (is_array($value))
				{
					echo "
				<ul class=\"dropdown-menu\" role=\"menu\">";
					foreach($value as $keyy => $valuee)
					{
						if ($listaMenuI[$key][$keyy]["qnt"]==1)
						{
							$valueee=$listaMenu[$key][$keyy][$keyy];
							echo "
					<li><a href=\"#\" onclick=\"executar('".$valueee."','aplicacao')\">$keyy</a></li>";
						}
						else
						{
							echo "
					<li class=\"divider\"></li>
					<li class=\"dropdown-header\">$keyy</li>";	
							foreach($valuee as $keyyy => $valueee)
							{
								echo "
								<li><a href=\"#\" onclick=\"executar('".$valueee."','aplicacao')\">".$keyyy."</a></li>";
							}
							echo "
					</li>";
						}
					}
					echo "
				</ul>";
				}
				else
				{
				
				}
			}
			
			}
			?>
			
			<!--
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Projetos</a></li>
					<li><a href="#">Recursos</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Configurações<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Memória de Cálculo</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Projetos</li>
						<li><a href="#">Tipos</a></li>
						<li><a href="#">Solicitantes</a></li>
					</ul>
					</li>
				</ul>
			</div>
			-->
			<? } ?>
			
        </div>
		
    </div>
	<!-- Fim Menu -->
<? } ?>

 