<?php
class Pessoa{
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
}