<?php
    require_once 'classPessoa.php';
    $p = new Pessoa($db_name, $db_host, $db_user, $db_pass);

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
    <?php
        if(isset($_POST['nome']))
        // CLICOU NO BOTÃO CADASTRAR OU] ATUALIZAR
        {
            if(isset($_GET['id_up']) && !empty($_GET['id_up']))
            {
            $id_upd = addslashes($_GET['id_up']);    
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
                if(!empty($nome) && !empty($telefone) && !empty($email))
                {
                    // ATUALIZANDO
                $p->atualizar($id_upd, $nome, $telefone, $email);
                header("location:index.php");
            }else
                {
                    ?>
                <div id="alert">
                    <h4>PREENCHA TODOS OS CAMPOS louco!</h4>
                </div>
                <?php
                }
            }
            else
                {
                $nome = addslashes($_POST['nome']);
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);
                if(!empty($nome) && !empty($telefone) && !empty($email))
                {
                    
                    if(!$p->cadastrarPessoa($nome, $telefone, $email))
                    {
                        ?>
                        <div id="alert">
                            <h4>ESSE EMAIL JÁ ESTA CADASTRADO!</h4>
                        </div>
                        <?php
                    }
                }else
                {
                    ?>
                <div id="alert">
                    <h4>PREENCHA TODOS OS CAMPOS!</h4>
                </div>
                <?php
                }
                }
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            
        }

        if(isset($_GET['id_up'])) // Se a pessoa cliclou em Editar
        {
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscar($id_update);
        }
    ?>

    <section id="esquerda">
        <form method="POST">
            <h2>CADASTRAR PESSOA</h2>
            <label for="nome">NOME</label>
            <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];} ?>">
            <label for="telefone">TELEFONE</label>
            <input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];} ?>">
            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];} ?>">
            <input type="submit" value="<?php if(isset($res)){echo "ATUALIZAR";}else{echo "CADASTRAR";} ?>">
        </form>
        <a href="../index.html">HOME</a>
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
                    foreach($dados[$i] as $k => $v)
                    {
                        if($k != "id")
                        {
                            echo "<td>".$v."</td>";
                        }
                    }
        ?>
                    <td>
                        <a href="index.php?id_up=<?= $dados[$i]['id']; ?>">EDITAR</a>
                        <a href="index.php?id=<?= $dados[$i]['id']; ?>">EXCLUIR</a>
                    </td>
                    </tr>
            <?php
                }
            }else // O BANCO ESTA VAZIO
            {

        ?>
                    
        </table>
        
        
                <div id="alert">
                    <h4>Não existe Usuários!</h4>
                </div>
                <?php
            }
            ?>
    </section>

</body>
</html>
<?php
    if(isset($_GET['id']))
    {
        $id_pessoa = addslashes($_GET['id']);
        $p->excluir($id_pessoa);
        header("location: index.php");
    }