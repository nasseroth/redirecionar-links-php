<?php include("db.php"); ?>
<?php
// Status flag:
$LoginSuccessful = false;
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
 
    $Username = $_SERVER['PHP_AUTH_USER'];
    $Password = $_SERVER['PHP_AUTH_PW'];
 
    if ($Username == 'admin' && $Password == 'admin'){
        $LoginSuccessful = true;
    }
}
?>
 <?php

 
// Login passed successful?
if (!$LoginSuccessful){
	header('WWW-Authenticate: Basic realm="Secret page"');
    header('HTTP/1.0 401 Unauthorized');
 
    print "Acesso negado!\n";
} else {
	include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="nome" class="form-control" placeholder="Nome do site" autofocus>
          </div>
          <div class="form-group">
            <textarea name="endereco" rows="2" class="form-control" placeholder="Endereço do site"></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Salvar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Inserido em</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM task";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['endereco']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); 
}?>
