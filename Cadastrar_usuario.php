<?php
    require_once 'php/func_usuario.php';
    $inc_usu = new Usuario;
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="CSS/estilo.css"
    </head>
    <body>
    <div id="corpo-form">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="f_nome" placeholder="Nome" maxlength="30">
            <input type="email" name="f_email" placeholder="E-mail" maxlength="40">
            <input type="password" name="f_senha" placeholder="Senha" maxlength="15">
            <input type="password" name="f_conf_senha" placeholder="Confirmar Senha" maxlength="15">
            <input type="submit" value="Cadastrar">
        </form>
    </div>
    <?php
    //echo 'passei aqui';
    if (isset($_POST['f_nome'])){
        $str_nome = addslashes($_POST['f_nome']);
        $str_email = addslashes($_POST['f_email']);
        $str_senha = addslashes($_POST['f_senha']);
        $str_conf_senha = addslashes($_POST['f_conf_senha']);
        // verificar se estão preenchidos
        if (!empty($str_nome) && !empty($str_email) && !empty($str_senha) && !empty(
                $str_conf_senha)){
            if ($str_conf_senha == $str_senha){
                ?>
                <div id="retorno_inc"><?php
                  echo $inc_usu->inc_usu($str_nome, $str_email, $str_senha);
                ?></div><?php
            }
            else {
                ?>
                <div class="msg-erro">
                    Senha e Confirmar Senha estão diferentes
                </div>
                <?php
            }
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
