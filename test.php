<html>
	<body>
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

	function imprimirConservacion($conservacion) {
		global $resultado, $resultado2, $resultado3;
		global $sec1, $sec2, $sec3;
		$lenR1 = strlen($sec1);
		//echo ($lenR1 - $result[0])." ";

		echo "Conservaciones : ";
		for($i = 0; $i < count($resultado); $i++) {

			$i1 = $lenR1 - $resultado[$i];
			echo ($i1 + $conservacion)."-".($i1 - $conservacion).", ";
		}
		echo "<br>";
			

	}


	function filtrarPorDistancia($distancia,$r1,$r2,$r3,$s1,$s2,$s3) {
		//global $resultado, $resultado2, $resultado3;
		//global $sec1, $sec2, $sec3;
		$finalResult = array();
		$lenR1 = strlen($s1);
		$lenR2 = strlen($s2);
		$lenR3 = strlen($s3);

		//$rango = ($rango/100)*($lenR1 -$resultado[0]);
		
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
					$finalResult[] = $r1[$i];
					//$finalResult[] = getIndiceFixed($lenR1, $r1[$i]);


			}
		}
		return $finalResult;
	}
		function main() {
			//$text = 'TAGAAAGAACTAAA';
			//$pattern = 'ANA';
			//pintarPatrones($text, $pattern);
			$seq1='TACGAATCAGAA';
			$seq2='TCGAAAGAA';

			//$last = system('python bioTest2.py '.$seq1.' '.$seq2.'', $retval);

			//$seq1='TACGAATCAGAATACGAATCAGAATACGAATCAGAA';
			//$seq2='TCGAAAGAAAGCAGTCGAAAGAAAGCAG';

			//$last = system('python bioTest2.py '.$seq1.' '.$seq2.'', $retval);

			//$handle = fopen("output.txt", "r");
			//while(!feof($handle)) {
				//$buffer = fgets($handle);
				//echo $buffer.'<br>';
			//}

		}

			//$myString = "I have a function that does this...function";
			//$newString = str_replace("function", "<font color='red'>function</font>", $myString);
			//echo $newString;
			


		?>
	</body>
</html>
