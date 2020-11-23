<?php
include("db.php");
$nome = '';
$endereco= '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM task WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nome = $row['nome'];
    $endereco = $row['endereco'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nome= $_POST['nome'];
  $endereco = $_POST['endereco'];

  $query = "UPDATE task set nome = '$nome', endereco = '$endereco' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task editada com sucesso!';
  $_SESSION['message_type'] = 'warning';
  header('Location: admin.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="nome" type="text" class="form-control" value="<?php echo $nome; ?>" placeholder="Update Title">
        </div>
        <div class="form-group">
        <textarea name="endereco" class="form-control" cols="30" rows="10"><?php echo $endereco;?></textarea>
        </div>
        <button class="btn-success" name="update">
          Atualizar
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>
