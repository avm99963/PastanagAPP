<?php
	require '../credentials.php';
	require '../php/utils.php';
	$user = get_users($_GET['userid']);
	$victim = get_users($user->quimata);
?>

<table class="victima">
	<tr>
		<td><img id="victim_img" src="https://picsum.photos/id/<?=$victim->id?>/200/200" /></td>
		<td>
			<div id="victim_name"><?=$victim->nomcomplet?></div>
			<div id="victim_curs_i_grau"><span id="victim_curs"><?=$victim->curs?></span>-<span id="victim_grau"><?=$victim->grau?></span></div>
			<div id="butons" class="options">
				<button id="win" onclick="js: send_request(user, 'REQ KILL');">L'he matat</button>
			</div>
		</td>
	</tr>
</table>
