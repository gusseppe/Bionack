<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Biology</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> 
		<style type="text/css">
			 .bs-example{
						margin: 20px;
							 }
		</style>

		<!--Chosen-->
	  <link rel="stylesheet" href="chosen/docsupport/style.css">
	  <link rel="stylesheet" href="chosen/docsupport/prism.css">
	  <link rel="stylesheet" href="chosen/chosen.css">
	  <style type="text/css" media="all">
		 /* fix rtl for demo */
		 .chosen-rtl .chosen-drop { left: -9000px; }
	  </style>


	<style>
		#resultado {
		   word-wrap: break-word;
			width: 1000px;
		}
	</style>

	</head>
	<body>

	  <!-- Parte superior: Navbar -->
		<div class="container">
			 <nav role="navigation" class="navbar navbar-inverse">
				  <!-- Brand and toggle get grouped for better mobile display -->
				  <div class="navbar-header">
						<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
							 <span class="sr-only">Toggle navigation</span>
							 <span class="icon-bar"></span>
							 <span class="icon-bar"></span>
							 <span class="icon-bar"></span>
						</button>
						<a href="#" class="navbar-brand">Biologia Computacional</a>
				  </div>
				  <!-- Collection of nav links, forms, and other content for toggling -->
				  <div id="navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							 <li class="active"><a href="#">Search</a></li>
							 <li><a href="About.html">About</a></li>
							 <li><a href="../index.php">Inicio</a></li>
						</ul>
				  </div>
			 </nav>
		 <div class="jumbotron">
			  <h1>Resultados </h1>
		 </div>
		</div>


	  <!--[> Titulo: <]-->
	  <!--<center><h1> Searching Patterns in DNA Sequence</h1></center>-->


	<?php
			include("algorithm.php");
			include("db.php");

			$sec1 = trim($_POST['s1']);
			$sec2 = trim($_POST['s2']);
			$sec3 = trim($_POST['s3']);
			$distancia = trim($_POST['distancia']);
			$radioconservacion = trim($_POST['radioconservacion']);
			$conservacion = trim($_POST['conservacion']);
			$dropdown = $_POST['dropdown'];

	  //Formularios


		  //if (!$searchtype || !$searchterm) {
				//echo 'No se han ingresado detalles de busqueda, regrese y vuelva a intentarlo.';
				//exit;
		  //}

		  $db = conectarDB();

		  $query = "select * from motifsTF where Motif_ID="."\"".$dropdown."\"";
		  $result = $db->query($query);

		  $num_results = $result->num_rows;


			//for ($i=0; $i <$num_results; $i++) {
			$row = $result->fetch_assoc();
			$SeqMotifOriginal = $row['Consensus'];

			//}
			$result->free();

			/*
			 *Calcular indices en la secuencias	
			 */

			//$resultado = array();
			$res1= match($sec1, $SeqMotifOriginal);
			$res2 = match($sec2, $SeqMotifOriginal);
			$res3 = match($sec3, $SeqMotifOriginal);

			echo <<<NO_MORE

	  <ul class="pager">
		 <li><a href="CalcularRadioConservacionV.php">Volver</a></li>
	  </ul>

		<div class="bs-example">
			<center>
			 <form action="CalcularRadioConservacionC.php" method="post">


				<hr style="width:1000px;" class="divider">

				 <!-- Secuencia 1-->
				  <div class="form-group">
						<label for="inputEmail" >Secuencia 1</label>
						<input name="s1" type="text" class="form-control"  style="width:500px;"id="inputEmail" placeholder="Secuencia 1" value=$sec1> </div>

				 <!-- Secuencia 2-->
				  <div class="form-group">
						<label for="inputEmail">Secuencia 2</label>
						<input name="s2" type="text" class="form-control" style="width:500px;"id="inputEmail" placeholder="Secuencia 2" value="$sec2">
				  </div>


				 <!-- Secuencia 3-->
				  <div class="form-group">
						<label for="inputEmail">Secuencia 3</label>
						<input name="s3" type="text" class="form-control" style="width:500px;"id="inputEmail" placeholder="Secuencia 3" value="$sec3">
				  </div>

				<hr style="width:500px;" class="divider">

NO_MORE;


				echo <<<NO_MORE
				 <!-- Secuencia Motif escogida-->
				<label for="inputEmail" >Motif escogido</label>
				  <div class="form-group">
						<input type="text" class="form-control" style="width:400px;"id="inputEmail" placeholder="Secuencia escogida" value=$SeqMotifOriginal>
					</div>

				<hr style="width:500px;" class="divider">
				 <!-- Opciones-->
				 <p><font size="5">Opciones</font></p>

				 <!-- Conservacion -->
				  <div class="form-group">
						<label for="inputEmail">Radio de conservacion</label>
							<input type="text" class="form-control" style="width:100px;"id="inputEmail" placeholder="Numero" value=$radioconservacion>
				  </div>

				 <!-- Conservacion -->
				  <div class="form-group">
						<label for="inputEmail">Conservacion</label>
							<input type="text" class="form-control" style="width:100px;"id="inputEmail" placeholder="Numero" value=$conservacion>
				  </div>

				<hr  class="divider">
				  <br>

NO_MORE;
					if(empty($res1) && empty($res2) && empty($res3)) {
					 echo "<span  class='label label-danger'>Motif no encontrado!</span>";
					}
					else {
					 echo "<span  class='label label-success'>Motif encontrado!</span>";

					}

				echo <<<NO_MORE
					  <br>
					  <br>
				  <!-- Resultado-->

				<nav class="navbar navbar-default" role="navigation">
				  <div class="container-fluid">
					 <div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						</button>
						<a class="navbar-brand" href="#">Resultado</a>
					 </div>

NO_MORE;
				   
					$res1= match($sec1, $SeqMotifOriginal);
					$res2 = match($sec2, $SeqMotifOriginal);
					$res3 = match($sec3, $SeqMotifOriginal);

					$res4 = match($sec1, "NNNNNAAANWRRRNHNNN");
					$res5 = match($sec2, "NNNNNAAANWRRRNHNNN");
					$res6 = match($sec3, "NNNNNAAANWRRRNHNNN");

					$res7 = match($sec1, "NTTTGRWN");
					$res8 = match($sec2, "NTTTGRWN");
					$res9 = match($sec3, "NTTTGRWN");


					$res1 = array_merge($res1, $res4);
					$res2 = array_merge($res2, $res5);
					$res3 = array_merge($res3, $res6);

					$res1 = array_merge($res1, $res7);
					$res2 = array_merge($res2, $res8);
					$res3 = array_merge($res3, $res9);

					$patronFiltrado = filtrarPatron($SeqMotifOriginal);
					//$patronFiltrado2 = filtrarPatron("RTATATRTR");
					//$patronFiltrado3 = filtrarPatron("RTATATATA");
					

					echo "<b>Resultados obtenidos en cada secuencia segun la opcion activada</b><br>";
					echo "<br><br>";

					echo "<b>Patron:</b><br>";
					echo $patronFiltrado;
					echo "<br><br>";

					$sec1 = str_replace(' ', '', $sec1);
					$sec2 = str_replace(' ', '', $sec2);
					$sec3 = str_replace(' ', '', $sec3);

					echo "<b>Indices:</b><br>";
					echo "Secuencia 1:  ";
					imprimirIndicesFixed($res1, $sec1);echo "<br>";
					//print_r($resultado1);echo "<br>";
					echo "Secuencia 2:  ";
					imprimirIndicesFixed($res2, $sec2);echo "<br>";
					//print_r($resultado2);echo "<br>";
					echo "Secuencia 3:  ";
					imprimirIndicesFixed($res3, $sec3);echo "<br>";
					//print_r($resultado3);echo "<br>";
					echo "<br><br>";

					echo "<br><br>";
					echo "<b>Filtrado por Distancia:</b><br>";

					$arrayFiltrado = filtrarPorDistancia($distancia,$res1,$res2,$res3,$sec1,$sec2,$sec3);
					//echo getIndiceFixed($lenR1, $r1[$i]);
					print_r($arrayFiltrado);

					$arrayPorcentaje = calcularPorcentajeConservacion($radioconservacion,$res1,$res2,$res3,$sec1,$sec2,$sec3);


					echo "<h1>Porcentaje de conservacion:</h1><br>";
					print_r($arrayPorcentaje);

					$promedioPorcentaje = (array_sum($arrayPorcentaje));
					if(count($arrayPorcentaje) != 0)
						$promedioPorcentaje /= count($arrayPorcentaje);
					print "<p > <font color=red  size='6pt'>$promedioPorcentaje %</font> </p>";

					if($promedioPorcentaje <= $radioconservacion && !empty($arrayFiltrado))
					 echo "<span  class='label label-success'>Cadena Valida!!</span>";
					else 
					 echo "<span  class='label label-danger'>Cadena Invalida!!</span>";

					echo "<br><br>";
					echo "<br><br>";

					pintarPatrones($sec1, $SeqMotifOriginal);



				echo <<<NO_MORE
				  </div><!-- /.container-fluid -->
				</nav>

				<!--<font COLOR="#800080">text text text text text</font>-->


			 </form>
			</center>
		</div>
NO_MORE;
	?>


	  
	</body>
</html>                                		
