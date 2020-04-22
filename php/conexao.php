<?php

function conexao(){
    $host = "localhost";

    //conexao no provedor
    //    $user = "id10537131_admin";
    //    $pass = "Joytravel2016";
    //    $banco = "id10537131_jtb";
    //    $connect = mysql_connect();
    //    $db=  mysql_select_db($banco);

    //conexao local
    $user = "root";
    $pass = "Joytravel2016";
    //$bd = "test";
    $bd   = "id10537131_jtb";

    //chamada via pdo
      $dsn= "mysql:host=$host;dbname=$bd";
      try{
        $pdo = new PDO($dsn, $user, $pass);
        return $pdo;
        echo "conexao ok";
      }
      catch (PDOException $erro)
      {
        return 'Erro:'.$erro->getMessage();
        //var_dump($erro);
      }
}