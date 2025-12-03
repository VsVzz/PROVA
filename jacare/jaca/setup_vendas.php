<?php
include('conexao.php');

$sql_array = [
    "CREATE TABLE IF NOT EXISTS vendas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        produto_id INT NOT NULL,
        quantidade INT NOT NULL,
        valor_unitario DECIMAL(10, 2) NOT NULL,
        total DECIMAL(10, 2) NOT NULL,
        data_venda DATETIME NOT NULL,
        FOREIGN KEY (produto_id) REFERENCES estoque(id)
    )",
    "ALTER TABLE vendas ADD INDEX idx_produto_id (produto_id)",
    "ALTER TABLE vendas ADD INDEX idx_data_venda (data_venda)"
];

$erros = [];
$sucessos = [];

foreach ($sql_array as $sql) {
    if ($conn->query($sql) === TRUE) {
        $sucessos[] = "✓ Executado com sucesso";
    } else {
        // Verifica se o erro é de índice duplicado (normal quando já existe)
        if (strpos($conn->error, 'Duplicate key name') === false) {
            $erros[] = $conn->error;
        } else {
            $sucessos[] = "✓ Índice já existente";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tabela de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div style="
        max-width: 600px;
        margin: 80px auto;
        padding: 25px;
        border-radius: 12px;
        background: <?= count($erros) > 0 ? '#f8e8e8' : '#e8f8ec' ?>;
        border: 1px solid <?= count($erros) > 0 ? '#e2b6b6' : '#b6e2c2' ?>;
        color: <?= count($erros) > 0 ? '#7b1e1e' : '#1e7b34' ?>;
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    ">
        <h1 style="font-size: 24px; margin-bottom: 20px; text-align: center;">
            <?= count($erros) > 0 ? '⚠️ Resultado' : '✓ Tabela Criada com Sucesso!' ?>
        </h1>

        <?php if (count($sucessos) > 0): ?>
            <div style="margin-bottom: 15px;">
                <h3 style="font-size: 16px; margin-bottom: 10px;">Operações Realizadas:</h3>
                <ul style="margin: 0; padding-left: 20px;">
                    <?php foreach ($sucessos as $sucesso): ?>
                        <li><?= $sucesso ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (count($erros) > 0): ?>
            <div style="margin-bottom: 15px;">
                <h3 style="font-size: 16px; margin-bottom: 10px; color: #dc3545;">Erros:</h3>
                <ul style="margin: 0; padding-left: 20px;">
                    <?php foreach ($erros as $erro): ?>
                        <li><?= $erro ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" style="
                display: inline-block;
                padding: 12px 25px;
                background: #000000;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                font-size: 16px;
                font-weight: 500;
                transition: 0.2s;
            ">Ir para o Sistema</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
