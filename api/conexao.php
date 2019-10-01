<?php
define('HOST', 'localhost');
define('USUARIO', 'alunando_apoia');
define('SENHA', 'd5;^0~q#W#q]');
define('DB', 'alunando_apoia');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');