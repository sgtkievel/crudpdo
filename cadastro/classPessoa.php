<?php
require_once 'Config.php';
;class Pessoa{
    private $pdo;
    public function __construct($dbname, $host, $user, $senha)
    {
        try
        {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }
        catch (PDOException $e){
            echo "ERRO com banco de dados: ".$e->getMessage();
        }
        catch(Exception $e){
            echo "ERRO generico: ".$e->getMessage();
        }
    }
    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // CADASTRAR PESSOA NO BANCO DE DADOS
    public function cadastrarPessoa($nome, $telefone, $email)
    {
        // VERIFICANDO SE PESSOA JÁ ESTÁ CADASTRADA

        $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE
        email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if($cmd->rowCount() > 0)// email já existe no banco
        {
            return false;
        }else //não foi encontrado o email
        {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa(nome, telefone, email)
            VALUES (:n, :t, :e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }
    }

    // EXCLUINDO DO BANCO DE DADOS
    public function excluir($id)
    {
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    //BUSCAR DADOS NO BANCO DE DADOS
    public function buscar($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //ATUALIZAR DADOS NO BANCO DE DADOS
    public function atualizar($id, $nome, $telefone, $email)
    {
        
            $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e  WHERE id = :id");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
           return true;
    }
}