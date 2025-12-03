<div class="container d-flex justify-content-center mt-4">
    <div class="col-12 col-md-6 bg-white p-4 shadow rounded">
        <h2 class="text-primary fw-bold text-center mb-4">Cadastrar Produto</h2>

        <form action="Estoque/inserir.php" method="get">
            <input class="form-control mb-3" type="text" placeholder="Nome do produto" required name="produto">
            <input class="form-control mb-3" type="number" placeholder="Quantidade Produto" required name="quantidadeProduto">
            <input class="form-control mb-3" type="number" placeholder="Valor" required name="valor">

            <button class="btn btn-primary w-100" type="submit">Cadastrar</button>
        </form>
    </div>
</div>