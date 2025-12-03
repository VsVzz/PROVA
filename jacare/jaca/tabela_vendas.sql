-- Criar tabela de vendas
CREATE TABLE IF NOT EXISTS vendas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  produto_id INT NOT NULL,
  quantidade INT NOT NULL,
  valor_unitario DECIMAL(10, 2) NOT NULL,
  total DECIMAL(10, 2) NOT NULL,
  data_venda DATETIME NOT NULL,
  FOREIGN KEY (produto_id) REFERENCES estoque(id)
);

-- Índices para melhor performance
ALTER TABLE vendas ADD INDEX idx_produto_id (produto_id);
ALTER TABLE vendas ADD INDEX idx_data_venda (data_venda);
