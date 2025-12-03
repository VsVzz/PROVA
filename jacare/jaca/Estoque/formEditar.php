<?php
include "conexao.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $origem = isset($_GET['origem']) ? $_GET['origem'] : 'listar';
    $select = "SELECT * FROM estoque WHERE id = $id";
    $result = $conn->query($select);
    $produto = $result->fetch_object();
}
?>

<div class="container d-flex justify-content-center mt-4">
    <div class="col-12 col-md-6 bg-white p-4 shadow rounded">
        <h2 class="text-primary fw-bold text-center mb-4">Atualizar Estoque</h2>

        <form action="Estoque/atualizar.php" method="get">
            <input type="hidden" name="id" value="<?= $produto->id ?>">
            <input type="hidden" name="origem" value="<?= $origem ?>">

            <input class="form-control mb-3" type="text" required placeholder="Nome do Produto"
                value="<?= $produto->produto ?>" name="produto">

            <input class="form-control mb-3" type="number" required placeholder="Insira a quantidade do produto"
                value="<?= $produto->quantidadeProduto ?>" name="quantidadeProduto">

            <input class="form-control mb-3" type="number" required placeholder="Insira o valor do produto"
                value="<?= $produto->valor ?>" name="valor">

            <button class="btn btn-primary w-100" type="submit">Atualizar</button>
        </form>
    </div>
</div>