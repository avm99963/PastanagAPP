<?php
	require '../php/utils.php';
	$user = get_users($_GET['userid']);
	$victim = get_users($user->quimata);
?>

<img width="300px" src="./imgs/<?=$victim->id?>.png" />
<h2 id="victim_name"><?=$victim->nomcomplet?></h2>
<h3><span id="victim_curs"><?=$victim->curs?></span>-<span id="victim_grau"><?=$victim->grau?></span></h3>
