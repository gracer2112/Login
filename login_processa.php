<?php
    echo "sessao aberta";
    session_start();
    if(!isset($_SESSION['ss_id_usuario']))
        {
            header["location: index.php"];
            exit();
        }
?>

seja bem vindo!