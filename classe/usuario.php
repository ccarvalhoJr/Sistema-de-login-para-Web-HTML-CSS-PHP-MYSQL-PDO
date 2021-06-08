<?php
Class Usuario
{   
    private $pdo;
    public $msgErro = "";
    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try
        {
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e)
         {
             $msgErro = $e->getMessage();
         }
    }

    public function cadastrar($nome, $telefone, $email, $senha)
    {
        global $pdo;
        global $msgErro;
        //verificar existencia
        $sql = $pdo->prepare("SELECT usuario_id FROM usuario WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false;
        }
        else
        {
            //cadastrar
            $sql = $pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;
        global $msgErro;
        $sql = $pdo->prepare("SELECT usuario_id FROM usuario WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            //entrar na sessão
            $dado = $sql->fetch();
            session_start();
            $_SESSION['usuario_id'] = $dado['usuario_id'];
            return true; //logado
        }
        else
        {
            return false; //Não foi possivel logar
        }
    }
}   
?>