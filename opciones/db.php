<?php

function conectarDB() {
  $db = new mysqli('localhost', 'root', 'ROOT', 'biology');

  if (mysqli_connect_errno()) {
		echo 'No puede conectarse a la BD vuelva a intentarlo.';
		exit;
  }
  else
	  return $db;

}
function listarMotif($db) {
  $query = "select Motif_ID from motifsTF";
  $query2 = "select Consensus from motifsTF";
  $result = $db->query($query);
  $result2 = $db->query($query2);

  $num_results = $result->num_rows;


  $motifs = array();
	for ($i=0; $i <$num_results; $i++) {
		$row = $result->fetch_assoc();
		$row2 = $result2->fetch_assoc();
		$NombreMotif = $row['Motif_ID'];
		$SeqMotif = $row2['Consensus'];
		$motifs[$NombreMotif] = $NombreMotif." -- ".$SeqMotif;
	}
  $result->free();
  $result2->free();

  return $motifs;

}

?>
