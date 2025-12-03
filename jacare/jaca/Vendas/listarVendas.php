<h2 class="fw-bold text-primary mb-4">Histórico de Vendas</h2>

<?php
include('conexao.php');
$select = "SELECT v.id, e.produto, v.quantidade, v.valor_unitario, v.total, v.data_venda 
           FROM vendas v 
           JOIN estoque e ON v.produto_id = e.id 
           ORDER BY v.data_venda DESC";
$result = $conn->query($select);
?>

<div class="table-container">
<table class="table table-hover table-striped table-bordered shadow-sm rounded">
    <thead class="table-primary">
        <th>Produto</th>
        <th>Quantidade Vendida</th>
        <th>Valor Unitário</th>
        <th>Total</th>
        <th>Data da Venda</th>
    </thead>

    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($venda = $result->fetch_object()) {
                $data_formatada = date('d/m/Y H:i', strtotime($venda->data_venda));
                echo "<tr>
                            <td>{$venda->produto}</td>
                            <td>{$venda->quantidade}</td>
                            <td>R$ " . number_format($venda->valor_unitario, 2, ',', '.') . "</td>
                            <td>R$ " . number_format($venda->total, 2, ',', '.') . "</td>
                            <td>{$data_formatada}</td>";
                echo "</tr>";
            }
        } else {
            echo "
                    <tr>
                        <td colspan='5' class='text-center text-secondary p-3'>
                            Nenhuma venda registrada
                        </td>
                    </tr>
                ";
        }
        ?>
    </tbody>
</table>
</div>
