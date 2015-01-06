<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
  <!--Ultimo motor de renderizacion-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
  
  <!--Mobile viewport optimized-->
  <meta name="viewport" content="width=device-width">
  <title>Bionack</title>
  <meta name="description" content="Comparte y aprende" />
  <meta name="keywords" content="biologia, computer" />
  
  <!--Fonts de google-->
  <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'> -->
  
  <!--CSS de toda la web-->
  <link rel="stylesheet" type="text/css" href="CSS/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="CSS/bootstrap-responsive.css">
  <link rel="stylesheet" type="text/css" href="CSS/bootmetro.css">
  <link rel="stylesheet" type="text/css" href="CSS/bootmetro-tiles.css">
  <link rel="stylesheet" type="text/css" href="CSS/bootmetro-charms.css">
  <link rel="stylesheet" type="text/css" href="CSS/metro-ui-light.css">
  <link rel="stylesheet" type="text/css" href="CSS/icomoon.css">
  <link rel="stylesheet" type="text/css" href="CSS/home.css">
  
  <!-- Favicon en la pagina -->
  <link rel="shortcut icon" href="Logo/favicon.ico" type="image/ico">

</head>
<body>
    <!--Barra de navegacion inicial-->
    <div class="navbar">
       <div class="navbar-inner"> 
         <a class="brand" href="index.html">&nbsp&nbsp&nbspOpenack</a>
         <img id="logo" src="Logo/logo.png" width = "26px" height="26px"></img>
         <ul class="nav">
           <li class="active"><a href="index.php">Inicio</a></li>
           <li><a href="#">Conócenos</a></li>

         </ul>
       </div>
     </div>

    <div class="header">
        <h1>Bionack. Learn and Share.</h1>
        <p>Web application that provides tools for solving biological problems on DNA sequences</br>   
        </p>
    </div>  
    <hr>
    <!--Parte central inferior, 4 botones azules de enlaces-->
    <div class="metro">
      <a class="tile square text tilesquareblock" href="opciones/BuscarMotifV.php">
        <div class="text5">Buscar Motif en una secuencia</div>
      </a>

      <a class="tile square text tilesquareblock" href="opciones/BuscarMotifMultipleSecuenciasV.php">
        <div class="text5">Buscar Motif en multiples secuencias</div>
      </a> 

       <a class="tile square text tilesquareblock" href="opciones/FiltrarPorDistanciasV.php">
        <div class="text5">Filtrar por distancias</div>
      </a>

      <a class="tile square text tilesquareblock" href="opciones/CalcularRadioConservacionV.php">
        <div class="text5">Calcular porcentaje de conservacion parcial</div>
      </a>     

      <a class="tile square text tilesquareblock" href="opciones/CalcularConservacionTotalV.php">
        <div class="text5">Calcular porcentaje de conservacion total</div>
      </a>     

      <a class="tile square text tilesquareblock" href="opciones/CalcularDistanciaDeHammingV.php">
        <div class="text5">Calcular distancia de Hamming</div>
      </a>     

      <a class="tile square text tilesquareblock" href="opciones/CalcularTodoV.php">
        <div class="text5">Calcular todas las opciones</div>
      </a>     

    </div><!--Fin de metro-->

  <!--Footer-->
  <!-- <footer class="foot">&copy; Pagina web creada por TODOS.</footer> -->
  
  <!--Scripts al final, para mejorar la velocidad-->
  <script src="scripts/modernizr-2.6.1.min.js"></script>
  <script href="JSS/funciones.js"></script>



</body>
</html>
