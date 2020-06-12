<?php
    require_once 'classPessoa.php';
    $p = new Pessoa("crudpdo", "localhost", "root", "");

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section id="esquerda">
        <form method="POST" action="cadastro.php">
            <h2>CADASTRAR PESSOA</h2>
            <label for="nome">NOME</label>
            <input type="text" name="nome" id="nome">
            <label for="telefone">TELEFONE</label>
            <input type="text" name="telefone" id="telefone">
            <label for="email">EMAIL</label>
            <input type="text" name="email" id="email">
            <input type="submit" value="CADASTRAR" >
        </form>
    </section>

    <section id="direita">
        <table>
            <tr id="titulo">
                <th>NOME:</th>
                <th>TELEFONE</th>
                <th colspan="2">EMAIL</th>
            </tr>
            
        <?php
            $dados = $p->buscarDados();
            if(count($dados) > 0)
            {
                for($i=0; $i < count($dados); $i++)
                {
                    echo "<tr>";
                    foreach($dados[$i] as $k => $v){
                        if($k != "id")
                        {
                            echo "<td>".$v."</td>";
                        }
                    }
                    echo "</tr>"
                }
            }
        ?>
        <td><a href="">EDITAR</a><a href="">EXCLUIR</a></td><?php
        }
        ?>
            
        </table>
    </section>

</body>
</html>