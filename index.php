<?php 
include("db.php");
$query = "SELECT endereco FROM task WHERE id IN ( SELECT id FROM task ) ORDER BY RAND() LIMIT 1;";
$result_tasks = mysqli_query($conn, $query);
$siteDirecionado;
while($row = mysqli_fetch_assoc($result_tasks)) {
	$siteDirecionado = $row['endereco'];
	echo $row['endereco'];
	header('Location: ' .$siteDirecionado);
	exit;
} ?>