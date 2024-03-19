<?php
    require '../funcoes/init.php';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    if (empty($nome))
    {
        echo "Volte e preencha o campo para pesquisa!";
        exit;
    }
    $pesquisa = '%' . $nome . '%';
    $PDO = db_connect();
    $sql = "SELECT id, nomeContato, dataNascimento, telefone, email FROM contatos WHERE upper(nomeContato) like :nome";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([':nome' => $pesquisa]);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contatos</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/bootstrap.js"></script>
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(function(){
                    $("#menu").load("../html/navbar.html");
                });
            });
        </script>
    </head>
    <body>
    <div id="menu"></div>
    
    <div class="jumbotron py-4">
            <h1 class="display-3 text-center">1&ordf; avaliação do 1&ordm; bimestre</h1>
            <p class="h3 text-center">Agenda de contatos.</p>
    </div>
     
        
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">e-mail</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <th scope="row"><?php echo $dados['nomeContato'] ?></th>
                            <td><?php echo dateConvert($dados['dataNascimento']) ?></td>
                            <td><?php echo $dados['telefone'] ?></td>
                            <td><?php echo $dados['email'] ?></td>
                            <td>
                                <a class="btn btn-primary" href="editarContato.php?id=<?php echo $dados['id'] ?>">Editar</a>
                                <a class="btn btn-danger" href="deletarContato.php?id=<?php echo $dados['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <hr>
    
      <footer class="container">
        <p>&copy; CEFET-MG - Varginha 2024</p>
      </footer>
    </body>
</html>