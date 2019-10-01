<?php

/**
 * Function to query information based on 
 * a parameter: in this case, nome_bolsista.
 *
 */

require "./api/config.php";
require "./api/common.php";

if (isset($_POST['submit'])) {

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = sprintf("SELECT * 
					FROM usuarios AS U
					WHERE U.cpf = :CPF AND U.senha = :SENHA;
			");

    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':CPF', $cpf, PDO::PARAM_STR);
    $statement->bindParam(':SENHA', $senha, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
        
<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <?php
	echo '<script>window.location.href = "home.php";</script>';
	?>
    <?php } else { ?>
      <blockquote>Nenhum resultado para <?php echo escape($_POST['nome_bolsista']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Login</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <label for="cpf">CPF</label>
  <input type="text" id="cpf" name="cpf">
  <label for="senha">SENHA</label>
  <input type="text" id="senha" name="senha">
  <input type="submit" name="submit" value="login">
</form>

<a href="home.php">Voltar</a>

<?php require "templates/footer.php"; ?>