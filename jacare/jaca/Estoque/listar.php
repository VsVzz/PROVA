<h2 class="fw-bold text-primary mb-4">Lista de Produtos</h2>

<?php
include('conexao.php');
$select = "SELECT * FROM estoque";
$result = $conn->query($select);
?>

<div class="table-container">
<table class="table table-hover table-striped table-bordered shadow-sm rounded">
    <thead class="table-primary">
        <th>Produto</th>
        <th>Quantidade Produto</th>
        <th>Valor</th>
        <th>Situação</th>
        <th class="text-center">Ação</th>
    </thead>

    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($produto = $result->fetch_object()) {
                $situacao = $produto->quantidadeProduto <= 5 ? '<span class="badge bg-danger">Acabando</span>' : '<span class="badge bg-success">Disponível</span>';

                echo "<tr>
                            <td>$produto->produto</td>
                            <td>$produto->quantidadeProduto</td>
                            <td>$produto->valor</td>
                            <td>$situacao</td>";

                echo "
                        <td class='text-center'>
                            <a class='btn btn-warning btn-sm me-1' href='?pagina=editar&id=$produto->id'>Editar</a>

                            <button class='btn btn-danger btn-sm' data-bs-toggle='modal'
                                data-bs-target='#modalExcluir$produto->id'>Excluir</button>

                            <div class='modal fade' id='modalExcluir$produto->id' tabindex='-1'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title'>Confirmar Exclusão</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                        </div>
                                        <div class='modal-body'>
                                            Deseja realmente excluir o produto <strong>$produto->produto</strong>?
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                            <a href='estoque/apagar.php?id=$produto->id' class='btn btn-danger'>Excluir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>";
            }
        } else {
            echo "
                    <tr>
                        <td colspan='5' class='text-center text-secondary p-3'>
                            Nenhum produto encontrado
                        </td>
                    </tr>
                ";
        }
        ?>
    </tbody>
</table>
</div>