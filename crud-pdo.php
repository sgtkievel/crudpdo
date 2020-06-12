<?php
// CONECTANDO E CRIANDO PDO E INSTANCIANDO O PDO
try{
    $pdo = new PDO("mysql:dbname=crudpdo;host=localhost", "root", "");
} 
catch (PDOException $e){
    echo "ERRO com banco de dados: ".$e->getMessage();
}
catch(Exception $e){
    echo "ERRO generico: ".$e->getMessage();
}

// FAZENDO UM INSERT
/*
$res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:n, :t, :e)");
$res->bindValue(":n", "Tais");
$res->bindValue(":t", "51 99256564841");
$res->bindValue(":e", "tais-gremio@bol.com.br");
$res->execute();
*/

// FAZENDO UM DELETE
/*
$res = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$id = 2;
$res->bindValue(":id", $id);
$res->execute();
*/

// FAZENDO UMA ALTERAÇÃO
/*
$res = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
$id = 1;
$res->bindValue(":id", $id);
$res->bindValue(":e", "jlk-gremio@hotmail.com");
$res->execute();
*/

// FAZENDO SELEÇÃO
$res = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$id = 1;
$res->bindValue(":id", $id);
$res->execute();
$array = $res->fetch(PDO::FETCH_ASSOC);

echo "<b>NOME</b>: ".$array['nome']."<br>";
echo "<b>TELEFONE</b>: ".$array['telefone']."<br>";
echo "<b>EMAIL</b>: ".$array['email'];


