<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "./api/config.php";
require "./api/common.php";

if (isset($_POST['submit'])) {

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
	$ano_letivo = $_POST['ano_letivo'];
	$unidade = $_POST['unidade'];
	$resumo = $_POST['resumo'];
    $matematica = $_POST['matematica'];
    $portugues = $_POST['portugues'];
    $biologia = $_POST['biologia'];
    $fisica = $_POST['fisica'];
    $quimica = $_POST['quimica'];
    $ingles = $_POST['ingles'];
	
    $desempenho = $_POST['desempenho'];
	
    //bolsista está com uma constante, depois ver um select para pegar o usuario atual ou deixar isso salvo no login
    $sql = sprintf(
		"START TRANSACTION;
		INSERT INTO provas (matematica,portugues,biologia,fisica,quimica,ingles) VALUES (:MATEMATICA,:PORTUGUES,:BIOLOGIA,:FISICA,:QUIMICA,:INGLES);
		INSERT INTO relatorio(bolsista, ano_letivo, unidade, provas, resumo, autoavaliacao) VALUES (1, :ANO_LETIVO, :UNIDADE, LAST_INSERT_ID(), :RESUMO, :DESEMPENHO);
		COMMIT;");
    
    $statement = $connection->prepare($sql);
	$statement->bindPAram(':ANO_LETIVO', $ano_letivo);
	$statement->bindPAram(':UNIDADE', $unidade);
	$statement->bindPAram(':RESUMO', $resumo);
	$statement->bindPAram(':MATEMATICA', $matematica);
	$statement->bindPAram(':PORTUGUES', $portugues);
	$statement->bindPAram(':BIOLOGIA', $biologia);
	$statement->bindPAram(':FISICA', $fisica);
	$statement->bindPAram(':QUIMICA', $quimica);
	$statement->bindPAram(':INGLES', $ingles);
	$statement->bindPAram(':DESEMPENHO', $desempenho);
    $statement->execute();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote>Resumo adicionado com sucesso!</blockquote>
  <?php endif; ?>

  <h2>Adicionar usuario</h2>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
	<label for="ano_letivo">Ano letivo</label>
    <input type="text" name="ano_letivo" id="ano_letivo">
	<label for="unidade">Unidade</label>
    <input type="text" name="unidade" id="unidade">
    <label for="resumo">Resumo do meu bimestre</label>
    <input type="text" name="resumo" id="resumo">
    <label for="matematica">Matematica</label>
    <input type="text" name="matematica" id="matematica">
    <label for="portugues">Portugues</label>
    <input type="text" name="portugues" id="portugues">
    <label for="biologia">Biologia</label>
    <input type="text" name="biologia" id="biologia">
    <label for="fisica">Fisica</label>
    <input type="text" name="fisica" id="fisica">
	<label for="quimica">Quimica</label>
    <input type="text" name="quimica" id="quimica">
	<label for="ingles">Ingles</label>
    <input type="text" name="ingles" id="ingles">
	<label for="desempenho">Meu desempenho acadêmico</label>
    <input type="text" name="desempenho" id="desempenho">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="home.php">Back to home</a>

<?php require "templates/footer.php"; ?>
