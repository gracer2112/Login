<?php

Class Usuario

{
    private $pdo;
        
    //inclusão de usuario
    function inc_usu ($strnome,$stremail,$strsenha)
    {
        global $pdo;

        //echo 'passei por aqui 1<br>';
        //echo "$strnome<br>";
        include_once ("conexao.php"); 

        try {
            //abre conexao
            $pdo=  conexao();
            //echo 'passei por aqui 2<br>';
            //verifica se tem esse usuario cadastrado na base
            $execsql=$pdo->query("SELECT * FROM tb_usu WHERE str_tb_usu_email = '".$stremail."'");
            $data = $execsql->fetchAll(PDO::FETCH_ASSOC);

            //se não tem inclui a usuario
            if ($execsql->rowCount() == 0){
                $execsql=$pdo->prepare("INSERT INTO tb_usu (str_tb_usu_nome,"
                                                         . "str_tb_usu_email,"
                                                         . "str_tb_usu_senha) VALUES ("
                                                         . ":str_tb_usu_nome,"
                                                         . ":str_tb_usu_email,"
                                                         . ":str_tb_usu_senha)");
                $execsql->bindValue(':str_tb_usu_nome',$strnome,PDO::PARAM_STR);
                $execsql->bindValue(':str_tb_usu_email',$stremail,PDO::PARAM_STR);
                $execsql->bindValue(':str_tb_usu_senha',md5($strsenha),PDO::PARAM_STR);

                $execsql->execute(); 
                //echo 'passei por aqui 3<br>';

            } else {
                //mostra o que encontrou
    //            foreach ($data as $row) {
    //                echo $row['str_tb_usu_email']."<br />\n";
    //                echo $row['str_tb_usu_nome']."<br />\n";
    //            };
                return "Usuario já cadastrado!";
            }
        }    

        catch (PDOException $erro) 
        {
            //echo 'passei por aqui usuario<br>';
            return 'Erro:'.$execsql->errorInfo();
            //var_dump($erro);
        }

    //    verifica qual o ultima chave cadastrada
    //    $execsql=$pdo->query("SELECT LAST_INSERT_ID()");
    //    $data = $execsql->fetchAll(PDO::FETCH_ASSOC);
    //    echo '<pre>';
    //    print_r ($data);
    //    echo '</pre>';
    
//        foreach ($data as $row) {
//            $coderro=$row['LAST_INSERT_ID()'];
//        };

        return "Usuario cadastrado";
    } // fim inclusao de usuario

    public function Login($stremail,$strsenha) 
    {
        global $pdo;

        //echo 'passei por aqui<br>';
        //echo "$stremail<br>";
        include_once ("conexao.php"); 

        try {
            //abre conexao
            $pdo=  conexao();

            //verifica se tem esse usuario cadastrado na base
            $execsql=$pdo->query("SELECT * FROM tb_usu WHERE str_tb_usu_email = '".$stremail."' and str_tb_usu_senha = '".md5($strsenha)."'");
            $data = $execsql->fetchAll(PDO::FETCH_ASSOC);

            //se não tem este usuario
            if ($execsql->rowCount() == 0){
                return 'Usuario inexistente ou Usuario/Senha Invalidos!';
            } else {
                //abre sessão de manutenção de viagens
                foreach ($data as $row) {

                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                    };
                    $_SESSION['ss_id_usuario'] = $row['int_tb_usu_id'];
                };
                return "Usuario logado com sucesso!";
            }
        }    
        catch (PDOException $erro) 
        {
            //echo 'passei por aqui usuario<br>';
            return 'Erro:'.$execsql->errorInfo();
            //var_dump($erro);
        }
     }

}