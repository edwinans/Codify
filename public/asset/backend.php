<?php
// exemple de solution
$solution=["item_1","item_3","item_2","item_4","item_5"];
// récupération de la solution envoyé par l'utilisateur
$indexArray=$_POST["indexArray"];
if ($solution == $indexArray) {
	$response->result="s";
	echo json_encode($response);
} else {
	$response->result="f";
	echo json_encode($response);
}

?>
