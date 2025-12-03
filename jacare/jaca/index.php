<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: auth/login.php');
}

$usuario = $_SESSION['usuario'];
?>

<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style/index.css">
  <link rel="shortcut icon" href="oq.png" type="image/x-icon">
  <title>Início</title>
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="index.php">Sistema</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link active" href="?pagina=cadastrar">Cadastrar</a></li>
          <li class="nav-item"><a class="nav-link active" href="?pagina=listar">Listar</a></li>
          <li class="nav-item"><a class="nav-link active" href="?pagina=vendas">Vendas</a></li>
        </ul>

        <ul class="navbar-nav align-items-center">

          <span class="navbar-text me-3 d-flex align-items-center" style="font-size: 15px;">
            <i class="bi bi-person-circle fs-5 me-1"></i>
            <?= $usuario ?>
          </span>

          <a class="btn btn-light btn-sm d-flex align-items-center px-3"
            style="border-radius: 20px; font-weight: 500;"
            href="?pagina=sair">
            <i class="bi bi-box-arrow-right me-1"></i> Sair
          </a>

        </ul>
      </div>
    </div>
  </nav>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <div class="container mt-5">

    <?php
    switch (@$_REQUEST['pagina']) {
      case 'cadastrar':
        include('Estoque/formCadastrar.php');
        break;
      case 'editar':
        include('Estoque/formEditar.php');
        break;
      case 'listar':
        include('Estoque/listar.php');
        break;
      case 'vendas':
        include('Vendas/formVendas.php');
        break;
      case 'listar-vendas':
        include('Vendas/listarVendas.php');
        break;
      case 'sair':
        include('auth/sair.php');
        break;
      default:
        include("home.php");
    }
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>