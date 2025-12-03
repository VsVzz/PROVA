<?php
include '../conexao.php';

$id = $_GET['id'];
$produto = $_GET['produto'];
$quantidadeProduto = $_GET['quantidadeProduto'];
$valor = $_GET['valor'];
$origem = isset($_GET['origem']) ? $_GET['origem'] : 'listar';

$update = "UPDATE estoque SET produto ='$produto', quantidadeProduto = $quantidadeProduto, valor = $valor WHERE id = $id";
$result = $conn->query($update);

$link = $origem === 'home' ? '../index.php?pagina=home' : '../index.php?pagina=listar';
?>

<div style="
    max-width: 500px;
    margin: 80px auto;
    padding: 25px;
    border-radius: 12px;
    background: #e8f8ec;
    border: 1px solid #b6e2c2;
    color: #1e7b34;
    font-family: Arial, sans-serif;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
">
    <h1 style="font-size: 22px; margin-bottom: 10px;">
        <?= $result === true ? "Atualizado com sucesso!" : "Erro ao atualizar!" ?>
    </h1>

    <a href="<?= $link ?>" style="
        display: inline-block;
        margin-top: 15px;
        padding: 10px 18px;
        background: #0d6efd;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 15px;
        transition: 0.2s;
    ">Voltar</a>
</div>