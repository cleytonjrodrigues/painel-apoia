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
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Painel Apoia</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="util\bootstrap.min.css"> 
    <link rel="stylesheet" href="css/style.css">
	  <link rel="stylesheet" href="css/style_table.css">


</head>

<body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/e5f7e3426d.js" crossorigin="anonymous"></script>

<div id="viewport">
  <!-- Sidebar -->
  <div id="sidebar">
    <header>
      <a href="#">Painel Apoia</a>
    </header>
	
	<div class="div_content_1">
    <div class="div_content_year" style="background-color: #ccc;">
        <label class="label_value">1 Ano</label>
    </div>
    <div class="div_content_year">
        <label class="label_value">2 Ano</label>
    </div>
    <div class="div_content_year">
        <label class="label_value">3 Ano</label>
    </div>
	</div>
	
	<div class="div_content_photo">
		<img class="img_content_photo" src="imgs/photo.jpg" />
	</div>
	
	<div class="div_content_2">
    <div class="div_content_2_name">
        <label class="label_content_2">Kevin Pimentel</label>
    </div>
    <div class="div_content_2_values">
        <strong class="strong_title">Mentor(a):</strong>
        <label class="label_value">Gus tavo Campos & Eduardo Ros man</label>
    </div>
	</div>
	
	<div class="div_content_0">
    <div class="div_content_values">
        <strong class="strong_title">Nascimento: </strong>
        <label class="label_value">10/09/2019</label>
    </div>
    <div class="div_content_values">
        <strong class="strong_title">Escola: </strong>
        <label class="label_value">Colégio Objetivo</label>
    </div>
    <div class="div_content_values">
        <strong class="strong_title">Orçamento Anual: </strong>
        <label class="label_value">R$ 14.151,00</label>
    </div>
	</div>
  </div>
  <!-- Content -->
  <div id="content">
    <div class="wrapper">
	
	<div class="div_content_3">
	<h2>Procurar bolsista pelo nome</h2>
	
	<form method="post" class="form-inline">
	  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <div class="form-group mb-2">
	    <label for="nome_bolsista" class="form-control-plaintext" >Nome</label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <input type="text" class="form-control" id="nome_bolsista" name="nome_bolsista">
    </div>

    <input type="submit" class="btn btn-primary mb-2" name="submit" value="ver_relatorios">


	</form>

	<a href="home.php" class="fas fa-long-arrow-alt-left" >Voltar</a>

	</div>
	
	<div class="div_content_3">
    <div class="div_content_3_title">
        <strong class="label_content_3">Resumo do meu bimestre</strong>
    </div>
    <div class="div_content_3_line">
    </div>
    <div class="div_content_3_text_long">
        <label class="label_content_3_text_long">
            Nesse bimestre meu principal foco, desde o início, foi progredir e aperfeiçoar meus resultados em matérias
            que eu sentia mais dificuldade. Reforçando minha independência, procurei por videoaulas, exercícios, livros
            e até mesmo coachings que proporcionaram-me uma melhora não só nas áreas almejadas, como também no meu
            contexto estudantil no geral. Outro ponto importante, foi que, com a ajuda de professores, pude aprender a
            como entender e reter melhor o conhecimento, algo que é e será profundamente necessário emminha vida.
            Entretanto, dentre todas as lições que tive nesse período a mais marcante foi, sem dúvida, “A arte da
            reciprocidade”, afinal em um momento que eu apresentava certas dificuldades em algumas matérias, amigos
            dispuseram-se a ajudar, o que me deixou muito grato e me fez retribuir, ajudando-os a conquistar melhores
            resultados em matérias que eles tinham dificuldades. Toda essa experiência pela qual eu passei nesse
            bimestre, sendo aluno e depois professor, foi extremamente gratificante e recompensadora, pois, além de dar
            auxílio às outras pessoas, pude consolidar ainda mais minha base em áreas doconhecimento queeu já me sentia
            seguro.
        </label>
    </div>
	</div>

  <div class="container">  
    <div class="table">
      
      <div class="row header blue">
        <div class="cell">
          Ano Letivo
        </div>
        <div class="cell">
          Bimestre / Trimestre
        </div>
        <div class="cell">
          Matemática
        </div>
        <div class="cell">
          Português
        </div>
      <div class="cell">
          Biologia
        </div>
      <div class="cell">
          Física
        </div>
      <div class="cell">
          Química
        </div>
      <div class="cell">
          Inglês
        </div>
      </div>
      
      <div class="row">
        <div class="cell">
          2019
        </div>
        <div class="cell">
          1
        </div>
        <div class="cell">
          7
        </div>
        <div class="cell">
          8
        </div>
      <div class="cell">
          7
        </div>
      <div class="cell">
          9
        </div>
      <div class="cell">
          8
        </div>
      <div class="cell">
          8
        </div>
      </div>
      
      <div class="row">
        <div class="cell">
          2019
        </div>
        <div class="cell">
          2
        </div>
        <div class="cell">
          7
        </div>
        <div class="cell">
          5
        </div>
      <div class="cell">
          7
        </div>
      <div class="cell">
          4
        </div>
      <div class="cell">
          8
        </div>
      <div class="cell">
          8
        </div>
      </div>
    </div>
  </div>  

  <div class="div_content_3">
    <div class="div_content_3_title">
        <strong class="label_content_3">Meu desempenho acadêmico</strong>
    </div>
    <div class="div_content_3_line">
    </div>
    <div class="div_content_3_text_long">
        <label class="label_content_3_text_long">
            O maior aspecto a respeito do meu desempenho nesse bimestre foi a melhora profunda em linguagens, afinal, no
            passado, tanto o Português quanto o Inglês eram dois difíceis obstáculos na minha trajetória estudantil.
            Entretanto, com o objetivo de contornar tal situação, investi meu tempo e minha disciplina no estudo dessas
            matérias, o que me proporcionou melhores resultados nas mesmas. A rotina de estudos que criei no primeiro
            bimestre e aprimorei no segundo foi essencial para a minha melhora nos elementos que euenxergava maiores
            complicações, porém, infelizmente, este método não foi o suficiente para preservar as notas em algumas
            outras
            áreas, como em Biologia, por exemplo, onde o decréscimo foi mais notório. Para solucionar esse problema,
            pretendo organizar e inovar meus planos de estudo, pois assim poderei individualizar os conteúdos e
            verdadeiramente compreender e reter cada conhecimento de forma mais eficiente.
        </label>
    </div>
	</div>
  
  </div>
</div>

  
</body>
</html>