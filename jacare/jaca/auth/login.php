<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-4 bg-white p-4 shadow rounded">
            <h2 class="text-center text-primary mb-4 fw-bold">Login</h2>

            <form action="autenticar.php">
                <input class="form-control mb-3" type="email" required name="email" placeholder="Email">
                <input class="form-control mb-3" type="password" required name="senha" placeholder="Senha">
                <button class="btn btn-primary w-100 mb-2" type="submit">Entrar</button>
            </form>

            <div class="text-center">
                <a href="cadastrarUsuario.php" class="text-decoration-none">Criar nova conta</a>
            </div>
        </div>
    </div>

</body>

</html>