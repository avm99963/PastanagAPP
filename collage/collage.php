<?php
	$id = isset($_GET['id']) ? $_GET['id'] : 9;
	
	// 2^0 (not hidden) and 2^9 (fully hidden)
	$hidden = (int)rand(1,512);
	$bits = decbin($hidden);
	while (strlen($bits) < 9) $bits = '0' . $bits;
	
	$i = 0;
?>

<style>
	img.black {
		filter: brightness(0%);
	}
</style>

<form action="collage.php" method="GET">
	<input type="text" name="id" placeholder="Poseu un número de l'1 al 113..." />
	<input type="submit" value="Actualitza foto" />
</form>

<table cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="./imgs/<?=$id?>/slice_01_01.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
		<td><img src="./imgs/<?=$id?>/slice_01_02.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
		<td><img src="./imgs/<?=$id?>/slice_01_03.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
	</tr>
	<tr>
		<td><img src="./imgs/<?=$id?>/slice_02_01.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
		<td><img src="./imgs/<?=$id?>/slice_02_02.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
		<td><img src="./imgs/<?=$id?>/slice_02_03.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
	</tr>
	<tr>
		<td><img src="./imgs/<?=$id?>/slice_03_01.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
		<td><img src="./imgs/<?=$id?>/slice_03_02.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
		<td><img src="./imgs/<?=$id?>/slice_03_03.png" width="33" class="<?=(int)$bits[$i++] ? 'black' : ''?>" /></td>
	</tr>
</table>
