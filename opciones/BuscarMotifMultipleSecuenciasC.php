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
			$resultado1 = match($sec1, $SeqMotifOriginal);
			$resultado2 = match($sec2, $SeqMotifOriginal);
			$resultado3 = match($sec3, $SeqMotifOriginal);

			echo <<<NO_MORE

	  <ul class="pager">
		 <li><a href="BuscarMotifMultipleSecuenciasV.php">Volver</a></li>
	  </ul>

		<div class="bs-example">
			<center>
			 <form action="BuscarMotifMultipleSecuenciasC.php" method="post">


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


NO_MORE;
					if(empty($resultado1) && empty($resultado2) && empty($resultado3)) {
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
				   
					$patronFiltrado = filtrarPatron($SeqMotifOriginal);
					echo "Patron:<br>";
					echo $patronFiltrado."<br><br>";

					echo "Indices:<br>";
					echo "Secuencia 1:  ";
					print_r($resultado1);echo "<br>";
					echo "Secuencia 2:  ";
					print_r($resultado2);echo "<br>";
					echo "Secuencia 3:  ";
					print_r($resultado3);echo "<br>";
					echo "<br><br>";

					echo "Secuencia 1:<br>";
					pintarPatrones($sec1, $SeqMotifOriginal);
					echo "<br><br>";
				
					echo "Secuencia 2:<br>";
					pintarPatrones($sec2, $SeqMotifOriginal);
					echo "<br><br>";

					echo "Secuencia 3:<br>";
					pintarPatrones($sec3, $SeqMotifOriginal);
					echo "<br><br>";
					////Imprimiendo Rangos
					//imprimirRangos($rango);
					//imprimirConservacion($conservacion);
					//echo "<br>";
					
					////Imprimiendo secuencias
						//echo"<center>";
						//echo "Secuencia 1 :       " ;
						//imprimirSecuencias($resultado, $sec1);
						//echo "<br>";

						//echo"</center>";

						//echo "<br>";
						//echo "<br>";

					//mostrarMatch($sec1, "TTN");



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
