<?php

include('db.php');

if (isset($_POST['save_task'])) {
  $nome = $_POST['nome'];
  $endereco = $_POST['endereco'];
  $query = "INSERT INTO task(nome, endereco) VALUES ('$nome', '$endereco')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task salva com sucesso!';
  $_SESSION['message_type'] = 'success';
  header('Location: admin.php');

}

?>
