<?php
include('conexao.php');
$select = "SELECT * FROM estoque";
$result = $conn->query($select);
?>

<div class="container d-flex justify-content-center mt-4">
    <div class="col-12 col-md-6 bg-white p-4 shadow rounded">
        <h2 class="text-primary fw-bold text-center mb-4">Registrar Venda</h2>

        <form action="Vendas/inserirVenda.php" method="post">
            <div class="mb-3">
                <label class="form-label fw-bold">Produto</label>
                <select class="form-control" name="produto_id" required>
                    <option value="">Selecione um produto</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($produto = $result->fetch_object()) {
                            echo "<option value='{$produto->id}' data-quantidade='{$produto->quantidadeProduto}' data-valor='{$produto->valor}'>
                                    {$produto->produto} (Disponível: {$produto->quantidadeProduto})
                                  </option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Quantidade Vendida</label>
                <input class="form-control" type="number" min="1" required placeholder="Quantidade" name="quantidade">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Valor Unitário</label>
                <input class="form-control" type="number" step="0.01" required placeholder="Valor" name="valor_venda" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Total da Venda</label>
                <input class="form-control" type="number" step="0.01" required placeholder="Total" name="total" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Data da Venda</label>
                <input class="form-control" type="date" required name="data_venda" value="<?php echo date('Y-m-d'); ?>">
            </div>

            <button class="btn btn-primary w-100" type="submit">Registrar Venda</button>
        </form>
    </div>
</div>

<script>
    const selectProduto = document.querySelector('select[name="produto_id"]');
    const inputQuantidade = document.querySelector('input[name="quantidade"]');
    const inputValor = document.querySelector('input[name="valor_venda"]');
    const inputTotal = document.querySelector('input[name="total"]');

    selectProduto.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        const valor = option.getAttribute('data-valor');
        inputValor.value = valor || '';
        calcularTotal();
    });

    inputQuantidade.addEventListener('input', calcularTotal);

    function calcularTotal() {
        const quantidade = parseFloat(inputQuantidade.value) || 0;
        const valor = parseFloat(inputValor.value) || 0;
        const total = quantidade * valor;
        inputTotal.value = total.toFixed(2);
    }
</script>
