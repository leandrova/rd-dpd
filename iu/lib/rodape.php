 
    <div class="container" style="width: 100%">
      <!-- Example row of columns -->
      <!--div class="row">
        <div class="col-md-4">
          <h3>Projetos Em Andamento</h3>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="http://getbootstrap.com/examples/jumbotron/#" role="button">acessar »</a></p>
        </div>
        <div class="col-md-4">
          <h3>Projetos Em Desenvolvimento</h3>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="http://getbootstrap.com/examples/jumbotron/#" role="button">acessar »</a></p>
       </div>
        <div class="col-md-4">
          <h3>Projetos Em UAT</h3>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="http://getbootstrap.com/examples/jumbotron/#" role="button">acessar »</a></p>
        </div>
      </div-->

      <hr>

	  
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./iu/lib/js/jquery.min.js"></script>
    <script src="./iu/lib/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./iu/lib/js/ie10-viewport-bug-workaround.js"></script>
	  
      <footer>
        <p>
		<div style="width: 50%; float: left; ">©</div>
		<div style="width: 50%; float: right; text-align: right; font-size: 10px;"><?=strtoupper($GLOBALS["IU"]);?></div>
		</p>
      </footer>
    </div>
	
	<? if ( ($FUNCOES->USUARIO == "SUPORTE") OR ($FUNCOES->USUARIO=="LEANDRO") OR ($FUNCOES->USUARIO=="BAGLIONI")  OR ($FUNCOES->USUARIO=="PSH") ) { ?>
		<table class="table table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th style="width:3%">N&deg;</th>
				<th style="width:80%">Sql</th>
				<th style="width:7%">Linhas</th>
				<th style="width:10%">Erro</th>
			</tr>
		</thead>
		<tbody>
		<?
		foreach ($FUNCOES->GetSqlList() as $key => $value) {
			$vt=explode("=>",$value);
			echo "<tr><td>$key</td><td>$vt[0]</td><td>$vt[1]</td><td>$vt[2]</td></tr>";
		}
		?>
		</tbody>
		</table>
	<? } ?>
	
</body>
 
</html>
