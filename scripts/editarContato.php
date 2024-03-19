<?php
    require '../funcoes/init.php';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if (empty($id))
    {
        echo "ID para alteração não definido";
        exit;
    }
    $PDO = db_connect();
    $sql = "SELECT id, nomeContato, dataNascimento, telefone, email FROM contatos WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!is_array($dados))
    {
        echo "Nenhum cadastro encontrado";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contato</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(function(){
                $("#menu").load("navbar.html");
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
            <form action="updateContato.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="descricao">Nome: </label>
                        <input type="text" class="form-control" name="nome" required minlength="5" value="<?php echo $dados['nomeContato'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="descricao">Data de Nascimento: </label>
                        <input type="date" class="form-control" name="dataNascimento" value="<?php echo $dados['dataNascimento'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="descricao">Telefone: </label>
                        <input type="text" class="form-control" name="telefone" value="<?php echo $dados['telefone'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="descricao">e-mail: </label>
                        <input type="email" class="form-control" name="email" value="<?php echo $dados['email'] ?>">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-row">
                    <button type="submit" class="btn btn-primary" id="submit" value="Submit">Enviar</button>
                    <a class="btn btn-danger" href="../index.html">Cancelar</a>
                </div>
            </form>
        </div>

        <hr>
    
      <footer class="container">
        <p>&copy; CEFET-MG - Varginha 2024</p>
      </footer>
</body>
</html>