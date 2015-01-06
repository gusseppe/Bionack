<?php
 
	/*
	 *Filtrar el patron segun sus caracteres
	 */
	function filtrarPatron($pattern) {
		if(strpos($pattern, "N") !== false) {
			$pattern = str_replace("N", "(G|A|T|C)", $pattern);
		}
		if(strpos($pattern, "K") !== false) {
			$pattern = str_replace("K", "(G|T)", $pattern);
		}
		if(strpos($pattern, "M") !== false) {
			$pattern = str_replace("M", "(A|C)", $pattern);
		}
		if(strpos($pattern, "R") !== false) {
			$pattern = str_replace("R", "(G|A)", $pattern);
		}
		if(strpos($pattern, "Y") !== false) {
			$pattern = str_replace("Y", "(C|T)", $pattern);
		}
		if(strpos($pattern, "S") !== false) {
			$pattern = str_replace("S", "(C|G)", $pattern);
		}
		if(strpos($pattern, "W") !== false) {
			$pattern = str_replace("W", "(A|T)", $pattern);
		}
		if(strpos($pattern, "B") !== false) {
			$pattern = str_replace("B", "(C|G|T)", $pattern);
		}
		if(strpos($pattern, "V") !== false) {
			$pattern = str_replace("V", "(C|G|A)", $pattern);
		}
		if(strpos($pattern, "H") !== false) {
			$pattern = str_replace("H", "(C|T|A)", $pattern);
		}
		if(strpos($pattern, "D") !== false) {
			$pattern = str_replace("D", "(G|T|A)", $pattern);
		}
		return $pattern;

	}

	/*
	 *Encontrar los indices que cumplan el patron en el texto
	 */
	function match($text, $pattern) {

		$pattern = filtrarPatron($pattern);

		preg_match_all("/".$pattern."/", $text, $matches, PREG_OFFSET_CAPTURE);
		  //print_r($matches); 

		$indices = array();
		for($i = 0; $i < count($matches[0]); $i++) {
			$indices[] = $matches[0][$i][1];
		}
		return $indices;
		//print_r($indices);

	}

	/*
	 *Encontrar las palabras que cumplan el patron en el texto
	 */
	function matchWords($text, $pattern) {

		$pattern = filtrarPatron($pattern);

		preg_match_all("/".$pattern."/", $text, $matches, PREG_OFFSET_CAPTURE);
		  //print_r($matches); 

		#Searching for the words matched
		$words = array();
		for($i = 0; $i < count($matches[0]); $i++) {
			$words[] = $matches[0][$i][0];
		}
		return $words;
		//print_r($indices);

	}

	/*
	 *Pintar los patrones en el texto
	 */
	function pintarPatrones($text, $pattern) {
		$pattern = filtrarPatron($pattern);

		//echo $pattern."<br>";

		#Encontrar las los patrones en el texto
		$words = matchWords($text, $pattern);

		#eliminar duplicados
		$words = array_unique($words);

		$newString = "";
		foreach($words as $word) {
			$newString = str_replace($word, "<font color='red'>$word</font>", $text);
			$text = $newString;
		}
		echo $newString;

	}
	/*
	 *Imprimir indices de los motifs encontrados en la secuencias
	 */
	function imprimirIndicesFixed($result, $sec) {
		$len = strlen($sec);

		for($i = 0; $i < count($result); $i++)
			echo "-".getIndiceFixed($len,$result[$i]).",  ";

	}
	/*
	 *Imprimir indices fixeados
	 */
	function getIndiceFixed($len, $indice) {
		return ($len -$indice);
	}

	/*
	 *Imprimir rangos de los motifs encontrados
	 */

	function imprimirRangos($distancia, $sec, $resultado) {
		$len = strlen($sec);

		for($i = 0; $i < count($resultado); $i++) {
			//$ran = ($distancia/100)*getIndiceFixed($len,$resultado[$i]);
			$ran = getRango($distancia,$len,$resultado[$i]);
			$low = getIndiceFixed($len,$resultado[$i]) + ceil($ran);
			$high = getIndiceFixed($len,$resultado[$i]) - ceil($ran);
			echo "[".$low." - ".$high."]".", ";

		}
		echo "<br>";
	}
	/*
	 *Obtener el ancho del rango del indice del motif encontrado usando distancia
	 */
	function getRango($distancia,$len,$indice) {
		return ($distancia/100)*getIndiceFixed($len,$indice);
	}
	function perteneceAlRango($distancia,$len,$indice,$x) {
		$ran = getRango($distancia,$len,$indice);
		$low = getIndiceFixed($len,$indice) + ceil($ran);
		$high = getIndiceFixed($len,$indice) - ceil($ran);

		if(($x <= $low) && ($x >= $high))
			return 1;

		return 0;

	}
	function printString($string) {
		//$len = strlen($string);
		$arr = str_split($string);
		//print_r($arr);

		echo "<table border='2' style='table-layout: fixed;'>";
		 echo "<tr>";
		foreach($arr as $e){
		 echo "<td style='width:15px;'>{$e}</td>";
		}
		 echo "</tr>";
		echo "</table>";
	}
	function countSimilaridad($sec1, $sec2) {
		$count = 0;
		for($i=0; $i<strlen($sec1);$i++) {
			if($sec1[$i] == $sec2[$i])
				$count++;
		}
		return $count;
	}

	function calcularPorcentajeConservacionTotal($sec1, $sec2) {

		$last = system('python conservation.py '.$sec1.' '.$sec2.'', $retval);

		$handle = fopen("output.txt", "r");
		while(!feof($handle)) {
			$buffer = fgets($handle);
			$strings = explode(" ", $buffer);

			$count = countSimilaridad($strings[0], $strings[1]);
			$porcentaje = ($count/strlen($strings[0]))*100;
			print "<p > <font color=blue  size='6pt'>$porcentaje %</font> </p>";

			printString($strings[0]);
			echo "<br>";
			printString($strings[1]);
		}
	}
	//function obtenerArray3($sec1, $sec2, $sec3 ) {

	//}

	function calcularDistanciaHammming($sec1, $sec2) {
		$last = system('python conservation.py '.$sec1.' '.$sec2.'', $retval);
		$handle = fopen("output.txt", "r");
		while(!feof($handle)) {
			$buffer = fgets($handle);
			$strings = explode(" ", $buffer);
			$count = countSimilaridad($strings[0], $strings[1]);

		}
		$len = strlen($sec1);
		print "<p>-------------------------</p>"."<br>";
		print "<h2 > Longitud Total</h2>";
		print "<p > <font color=blue  size='6pt'>$len</font> </p>";

		print "<h2 > Distancia Hamming</h2>";
		$hamming = $len-$count;
		print "<p > <font color=red  size='6pt'>$hamming</font> </p>";

		print "<h2 > Matches</h2>";
		print "<p > <font color=green  size='6pt'>$count</font> </p>";

	}

	function calcularDistanciaHammming3($sec1, $sec2) {
		$last = system('python conservation.py '.$sec1.' '.$sec2.'', $retval);
		$handle = fopen("output.txt", "r");
		while(!feof($handle)) {
			$buffer = fgets($handle);
			$strings = explode(" ", $buffer);

			$count = countSimilaridad($strings[0], $strings[1]);

		}
		$len = strlen($sec1);
		print "<p>-------------------------</p>"."<br>";
		print "<h2 > Longitud Total</h2>";
		print "<p > <font color=blue  size='6pt'>$len</font> </p>";

		print "<h2 > Distancia Hamming</h2>";
		$hamming = $len-$count;
		print "<p > <font color=red  size='6pt'>$hamming</font> </p>";

		print "<h2 > Matches</h2>";
		print "<p > <font color=green  size='6pt'>$count</font> </p>";

	}

	function calcularPorcentajeConservacion($conservacion,$r1,$r2,$r3,$s1,$s2,$s3) {
		$finalResult = array();
		$lenR1 = strlen($s1);
		$lenR2 = strlen($s2);
		$lenR3 = strlen($s3);
		
		if(!empty($r1)) {
			//$j = 0;
			$i2 = 0;
			$i3 = 0;
			for($i = 0; $i < count($r1); $i++) {
				$substr1 = retornarSubstring($conservacion,$s1, $lenR1,$r1[$i]);

				$promedioPorcentaje = 0;
				for($j = 0; $j < count($r2); $j++) {
					$substr2 = retornarSubstring($conservacion,$s2, $lenR2,$r2[$j]);
					//$i2 = getIndiceFixed($lenR2, $r2[$j]);
					$last = system('python conservation.py '.$substr1.' '.$substr2.'', $retval);
					$handle = fopen("output.txt", "r");
					while(!feof($handle)) {
						$buffer = fgets($handle);
						$strings = explode(" ", $buffer);

						$count = countSimilaridad($strings[0], $strings[1]);
						$porcentaje = ($count/strlen($strings[0]))*100;
						$promedioPorcentaje += $porcentaje;
						//print "<p > <font color=blue  size='6pt'>$porcentaje %</font> </p>";
						//printString($strings[0]);
						//echo "<br>";
						//printString($strings[1]);

					}
				}
				if(count($r2) != 0)
					$promedioPorcentaje = $promedioPorcentaje/count($r2);
				$finalResult[] = $promedioPorcentaje;
				//print "<p > <font color=red  size='6pt'>$promedioPorcentaje %</font> </p>";
			}
		}
		return $finalResult;

	}
	function retornarSubstring($conservacion,$sec, $len,$indice) {
		$ran = getRango($conservacion,$len,$indice);
		//$low = getIndiceFixed($len,$indice) + ceil($ran);
		$low = $indice + ceil($ran);
		$high = $indice - ceil($ran);

		return substr($sec, $low, $high); 

	}

	function filtrarPorDistancia($distancia,$r1,$r2,$r3,$s1,$s2,$s3) {
		//global $resultado, $resultado2, $resultado3;
		//global $sec1, $sec2, $sec3;
		$finalResult = array();
		$lenR1 = strlen($s1);
		$lenR2 = strlen($s2);
		$lenR3 = strlen($s3);

		if(!empty($r1)) {
			//$j = 0;
			$i2 = 0;
			$i3 = 0;
			for($i = 0; $i < count($r1); $i++) {
				//$ran = getRango($distancia,$lenR1,$r1[$i]);
				//$ran = ($rango/100)*($lenR1 -$resultado[$i]);
				$flag1 = 0;
				$flag2 = 0;

				for($j = 0; $j < count($r2); $j++) {
					$i2 = getIndiceFixed($lenR2, $r2[$j]);
					if(perteneceAlRango($distancia,$lenR1,$r1[$i],$i2) == 1)
						$flag1 = 1;

				}
				for($j = 0; $j < count($r3); $j++) {
					$i3 = getIndiceFixed($lenR3, $r3[$j]);
					if(perteneceAlRango($distancia,$lenR1,$r1[$i],$i3) == 1)
						$flag2 = 1;

				}
				if(($flag1 == 1) && ($flag2 == 1))
					//$finalResult[] = $r1[$i];
					//Retorna el indice del motif que se conserva en las
					//tres secuencias
					$finalResult[] = getIndiceFixed($lenR1, $r1[$i]);


			}
		}
		return $finalResult;
	}

	//function filtrarDistancia
?>
