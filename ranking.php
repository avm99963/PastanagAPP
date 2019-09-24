<html>
<head>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	<link rel="stylesheet" href="./css/ranking.css" />
</head>

<body>

<?php
	require './credentials.php';
	require './php/utils.php';
	
	// $getranking = "SELECT morts.assassi AS id, users.grau, users.curs, count(morts.assassi) AS kills FROM morts INNER JOIN users ON morts.assassi = users.id GROUP BY morts.assassi";
	// $getranking = "SELECT morts.assassi AS id, users.grau, users.curs, count(morts.assassi) AS kills, sum(CASE WHEN morts.grau = users.grau THEN 1 ELSE 2 END) AS kills_pondered FROM morts INNER JOIN users ON morts.assassi = users.id GROUP BY morts.assassi ORDER BY kills_pondered DESC";
	// Mateix grau i curs => 1, Mateix grau diferent curs => 2, Diferent grau => 3
	// $getranking = "SELECT morts.assassi AS id, users.grau, users.curs, count(morts.assassi) AS kills, sum(CASE WHEN morts.grau = users.grau AND morts.curs = users.curs THEN 1 WHEN morts.grau = users.grau AND morts.curs != users.curs THEN 2 ELSE 3 END) AS kills_pondered FROM morts INNER JOIN users ON morts.assassi = users.id GROUP BY morts.assassi ORDER BY kills_pondered DESC";
	
	// Mateix grau i curs => 100, Mateix grau diferent curs => 150, Diferent grau => 200
	$getranking = "SELECT morts.assassi AS id, users.nom, users.grau, users.curs, count(morts.assassi) AS kills,
					sum(morts.grau = users.grau AND morts.curs = users.curs) AS companys_classe,
					sum(morts.grau = users.grau AND morts.curs != users.curs) AS companys_grau,
					sum(morts.grau != users.grau) AS companys_facu,
					sum(CASE WHEN morts.grau = users.grau AND morts.curs = users.curs THEN 100 WHEN morts.grau = users.grau AND morts.curs != users.curs THEN 150 ELSE 200 END) AS score
					FROM morts INNER JOIN users ON morts.assassi = users.id GROUP BY morts.assassi ORDER BY score DESC";
	
	$results = query($getranking);
?>

<div id="outter-container">
	<div id="inner-container">
		<header>
			<div id="leftlinks"><a id="info" href="javascript:void(0);" onclick="js: toggleinfo();">+Info</a></div>
			<div id="rightlinks"><a href="./index.php">Tornar a l'inici</a></div>
		</header>
		
		<p><img src="./bin/images/info.png" width="32px" /> La puntuació de cada jugador es calcula com a una suma ponderada depenent del caràcter de les seves víctimes: companys de <b>c</b>lasse (mateix curs, mateix grau), companys de <b>g</b>rau (mateix grau) i companys de <b>f</b>acultat (diferents grau). Amb puntuacions +100, +150 i +200; respectivament.</p>
		
		<div id="table-container">
			<table id="ranking" cellspacing="0" cellpadding="0">
				<tr id="header">
					<th></th>
					<th>Assassins</th>
					<th>T</th>
					<th>P</th>
					<th>C</th>
					<th>G</th>
					<th>F</th>
				</tr>
				<?php
					$id = 0;
					$i = 1;
					
					while ($row = $results->fetch_object()) {
						if ($i == 1) echo "<tr class='gold top3'>";
						else if ($i == 2) echo "<tr class='silver top3'>";
						else if ($i == 3) echo "<tr class='bronze top3'>";
						else if ($row->id == $id) echo "<tr class='me'>";
						else echo "<tr>";
						
						echo "<td>". ($i > 3 ? $i : '') ."</td>";
						echo "<td class='name'><div>
									<div class='username'>$row->nom</div>
									<div class='userinfo'>".nomcurs($row->curs)." - ".nomgrau($row->grau)."</div>
								</div></td>";
						echo "<td>$row->kills</td>";
						echo "<td><b>$row->score</b></td>";
						echo "<td>$row->companys_classe</td>";
						echo "<td>$row->companys_grau</td>";
						echo "<td>$row->companys_facu</td>";
						echo "</tr>";
						
						$i = $i + 1;
					}
				?>
			</table>
		</div>
	</div>
</div>

<script>
	function toggleinfo() {
		let state = document.getElementsByTagName("p")[0].style.display;
		if (state == "block") {
			document.getElementsByTagName("p")[0].style.display = "none";
			document.getElementsByTagName("a")[0].innerHTML = "+Info";
		} else {
			document.getElementsByTagName("p")[0].style.display = "block";
			document.getElementsByTagName("a")[0].innerHTML = "-Info";
		}
		return false;
	}
</script>

</body>
</html>
