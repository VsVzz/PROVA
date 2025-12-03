<?php
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];
    $valor_venda = $_POST['valor_venda'];
    $total = $_POST['total'];
    $data_venda = isset($_POST['data_venda']) ? $_POST['data_venda'] . ' 00:00:00' : date('Y-m-d H:i:s');

    // Verificar se o produto existe e tem quantidade suficiente
    $select = "SELECT quantidadeProduto FROM estoque WHERE id = $produto_id";
    $result = $conn->query($select);
    $produto = $result->fetch_object();

    if ($produto && $produto->quantidadeProduto >= $quantidade) {
        // Começar transação
        $conn->begin_transaction();

        try {
            // Inserir venda na tabela de vendas
            $insert_venda = "INSERT INTO vendas (produto_id, quantidade, valor_unitario, total, data_venda) 
                            VALUES ($produto_id, $quantidade, $valor_venda, $total, '$data_venda')";
            
            if (!$conn->query($insert_venda)) {
                throw new Exception("Erro ao registrar venda");
            }

            // Atualizar quantidade no estoque
            $nova_quantidade = $produto->quantidadeProduto - $quantidade;
            $update_estoque = "UPDATE estoque SET quantidadeProduto = $nova_quantidade WHERE id = $produto_id";
            
            if (!$conn->query($update_estoque)) {
                throw new Exception("Erro ao atualizar estoque");
            }

            // Confirmar transação
            $conn->commit();

            $sucesso = true;
            $mensagem = "Venda registrada com sucesso!";
        } catch (Exception $e) {
            // Desfazer transação em caso de erro
            $conn->rollback();
            $sucesso = false;
            $mensagem = $e->getMessage();
        }
    } else {
        $sucesso = false;
        $mensagem = "Quantidade insuficiente em estoque!";
    }
} else {
    $sucesso = false;
    $mensagem = "Erro na requisição";
}
?>

<div style="
    max-width: 500px;
    margin: 80px auto;
    padding: 25px;
    border-radius: 12px;
    background: <?= $sucesso ? '#e8f8ec' : '#f8e8e8' ?>;
    border: 1px solid <?= $sucesso ? '#b6e2c2' : '#e2b6b6' ?>;
    color: <?= $sucesso ? '#1e7b34' : '#7b1e1e' ?>;
    font-family: Arial, sans-serif;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
">
    <h1 style="font-size: 22px; margin-bottom: 10px;">
        <?= $mensagem ?>
    </h1>

    <a href="../index.php?pagina=vendas" style="
        display: inline-block;
        margin-top: 15px;
        padding: 10px 18px;
        background: #000000;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 15px;
        transition: 0.2s;
    ">Voltar</a>
</div>
