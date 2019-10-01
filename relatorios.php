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
					FROM bolsista B
					INNER JOIN usuarios AS U
					INNER JOIN relatorio AS R ON R.bolsista = B.id
					INNER JOIN provas AS P ON P.id = R.provas
					WHERE U.nome = :NOME;
			");

    $nome_bolsista = $_POST['nome_bolsista'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':NOME', $nome_bolsista, PDO::PARAM_STR);
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
    <h2>Resultados</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Nascimento</th>
          <th>Serie</th>
          <th>Escola</th>
          <th>Orçamento Anual</th>
          <th>Educação pra mim</th>
          <th>Minha História</th>
        </tr>
      </thead>
      <tbody>
	<?php foreach ($result as $row) : ?>
		<tr>
          <td><?php echo escape($row["hash"]); ?></td>
          <td><?php echo escape($row["nome"]); ?></td>
		  <td><?php echo escape($row["d_nascimento"]); ?></td>
          <td><?php echo escape($row["serie"]); ?></td>
          <td><?php echo escape($row["escola"]); ?></td>
          <td><?php echo escape($row["orcamento_anual"]); ?></td>
          <td><?php echo escape($row["educacao_p_mim"]); ?> </td>
          <td><?php echo escape($row["minha_historia"]); ?> </td>
        </tr>
		<?php break; ?>
	<?php endforeach; ?>
		<tr>
          <th>#</th>
          <th>Ano Letivo</th>
          <th>Unidade</th>
          <th>Resumo</th>
		  <th>Matemática</th>
		  <th>Português</th>
		  <th>Biologia</th>
		  <th>Física</th>
		  <th>Química</th>
		  <th>Inglês</th>
          <th>Meu desempenho acadêmico</th>
        </tr>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["hash2"]); ?></td>
          <td><?php echo escape($row["ano_letivo"]); ?></td>
          <td><?php echo escape($row["unidade"]); ?></td>
          <td><?php echo escape($row["resumo"]); ?></td>
          <td><?php echo escape($row["matematica"]); ?></td>
          <td><?php echo escape($row["portugues"]); ?></td>
          <td><?php echo escape($row["biologia"]); ?></td>
          <td><?php echo escape($row["fisica"]); ?></td>
          <td><?php echo escape($row["quimica"]); ?></td>
          <td><?php echo escape($row["ingles"]); ?></td>
          <td><?php echo escape($row["autoavaliacao"]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>Nenhum resultado para <?php echo escape($_POST['nome_bolsista']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Procurar bolsista pelo nome</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <label for="nome_bolsista">Nome</label>
  <input type="text" id="nome_bolsista" name="nome_bolsista">
  <input type="submit" name="submit" value="ver_relatorios">
</form>

<a href="home.php">Voltar</a>

<?php require "templates/footer.php"; ?>