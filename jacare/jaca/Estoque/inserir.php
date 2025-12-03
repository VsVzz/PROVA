<?php
include '../conexao.php';

$produto = $_GET['produto'];
$quantidadeProduto= $_GET['quantidadeProduto'];
$valor= $_GET['valor'];

$insert = "INSERT INTO estoque VALUES('', '$produto', '$quantidadeProduto', '$valor')";
$result = $conn->query($insert);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <?php if ($result === true): ?>
        <div class="alert alert-success text-center fw-bold shadow-sm">
            Adicionado com sucesso!
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center fw-bold shadow-sm">
            Erro ao adicionar!
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../index.php?pagina=listar" class="btn btn-primary px-4">
            Voltar
        </a>
    </div>
</div>