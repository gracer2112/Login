<?php
    require_once 'php/func_usuario.php';
    $log_usu = new Usuario;
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="CSS/estilo.css"
    </head>
    <body>
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="e-mail" name="f_email" placeholder="Usuario">
            <input type="password" name="f_senha" placeholder="Senha">
            <input type="submit" value="Acessar">
        </form>
    </div>
    <?php
    if (isset($_POST['f_email'])){
        $str_email = addslashes($_POST['f_email']);
        $str_senha = addslashes($_POST['f_senha']);
        // verificar se estão preenchidos
        if (!empty($str_email) && !empty($str_senha)){
                ?>
                <div id="retorno_inc"><?php
                  echo $log_usu->Login($str_email, $str_senha);
                  header("login_processa.php");
                ?></div><?php
        }
        else {
            ?>
            <div class="msg-erro">
                Preencha todos os campos
            </div>
            <?php
        }
    }
    ?>
    </body>
</html>
