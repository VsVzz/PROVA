<?php
include "../conexao.php";

if (isset($_REQUEST['nome'])) {
    $nome = $_GET['nome'];
    $email = $_GET['email'];
    $senha = $_GET['senha'];

    try {
        $conn->query("INSERT INTO usuario VALUES('','$nome','$email','$senha')");
        echo "<p class='text-success text-center mt-3'>Cadastrado com sucesso!</p>";
    } catch (Exception $e) {
        echo "<p class='text-danger text-center mt-3'>Erro ao cadastrar</p>";
    }
}
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-4 bg-white p-4 shadow rounded">
            <h2 class="text-center text-primary mb-4 fw-bold">Cadastro</h2>

            <form>
                <input class="form-control mb-3" type="text" required name="nome" placeholder="Seu nome">
                <input class="form-control mb-3" type="email" required name="email" placeholder="Seu email">
                <input class="form-control mb-3" type="password" required name="senha" placeholder="Sua senha">
                <button class="btn btn-primary w-100 mb-2" type="submit">Cadastrar</button>
            </form>

            <div class="text-center">
                <a href="login.php" class="text-decoration-none">Já tenho conta</a>
            </div>
        </div>
    </div>

</body>

</html>