<?php
session_start();
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>Painel Apoia</title>
</head>

<body>
    <section >
        <div>
            <div>
                <div>
                    <h3>Login</h3>
                    <?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div>
                      <p>ERRO: Usuário ou senha inválidos.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>
                    <div>
                        <form action="login.php" method="POST">
                            <div>
                                <div class="control">
                                    <input name="usuario" type="text" placeholder="Seu usuário" autofocus="">
                                </div>
                            </div>

                            <div>
                                <div>
                                    <input name="senha" type="password" placeholder="Sua senha">
                                </div>
                            </div>
                            <button type="submit">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>