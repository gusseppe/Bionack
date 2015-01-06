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
			  <h1>Searching Patterns in DNA </h1>
		 </div>
		</div>


	  <!--[> Titulo: <]-->
	  <!--<center><h1> Searching Patterns in DNA Sequence</h1></center>-->




	  <!-- Formulario  -->
		<div class="bs-example">
			<center>
			 <form action="BuscarMotifMultipleSecuenciasC.php" method="post">


				<hr style="width:1000px;" class="divider">
				 <!-- Secuencia 1-->
				  <div class="form-group">
						<label for="inputEmail" >Secuencia 1</label>
						<input name="s1" type="text" class="form-control"  style="width:500px;"id="inputEmail" placeholder="Secuencia 1" value="">
				  </div>


				 <!-- Secuencia 2-->
				  <div class="form-group">
						<label for="inputEmail">Secuencia 2</label>
						<input name="s2" type="text" class="form-control" style="width:500px;"id="inputEmail" placeholder="Secuencia 2" value="">
				  </div>


				 <!-- Secuencia 3-->
				  <div class="form-group">
						<label for="inputEmail">Secuencia 3</label>
						<input name="s3" type="text" class="form-control" style="width:500px;"id="inputEmail" placeholder="Secuencia 3" value="">
				  </div>
				<hr style="width:500px;" class="divider">

				 <!-- Dropdown -->
				  <div class="side-by-side clearfix">
					 <p><font size="5">Motif</font></p>

					<?php
						  include("db.php");

						  $db = conectarDB();
						  $motifs = listarMotif($db);
						  $db->close();

						echo <<<NO_MORE
						 <select name=dropdown data-placeholder="Choose a Country..." class="chosen-select" style="width:350px;" tabindex="2" value="TFAM">
NO_MORE;
							$default = "TAATNN";

							foreach($motifs as $key => $val) {
								 echo ($key == $default) ? "<option selected=\"selected\" value=\"$key\">$val</option>":"<option value=\"$key\">$val</option>";
							}

							echo "</select>";
					?>


				  </div>
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

				
				  </div><!-- /.container-fluid -->
				</nav>

				<!--<font COLOR="#800080">text text text text text</font>-->

				 <!-- Boton-->

				 <button type="submit" class="btn btn-primary">Submit</button>


			 </form>
			</center>
		</div>
	  
	</body>
</html>                                		
