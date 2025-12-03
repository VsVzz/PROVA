<?php
include('conexao.php');

$sql = "CREATE TABLE IF NOT EXISTS vendas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  produto_id INT NOT NULL,
  quantidade INT NOT NULL,
  valor_unitario DECIMAL(10, 2) NOT NULL,
  total DECIMAL(10, 2) NOT NULL,
  data_venda DATETIME NOT NULL,
  FOREIGN KEY (produto_id) REFERENCES estoque(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "<div style='
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
    '>
        <h1 style='font-size: 22px; margin-bottom: 10px;'>
            Tabela de vendas criada com sucesso!
        </h1>
        <a href='index.php' style='
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: #000000;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            transition: 0.2s;
        '>Voltar</a>
    </div>";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}

$conn->close();
?>
