<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/index.css">
  <title>Document</title>
</head>
<body>
  
</body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nome = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Visitante';
?>

<h1 class="text-center mb-4 fw-bold">Olá, <?php echo $nome; ?>!</h1>

<?php if (isset($_GET['busca'])): ?>
  <div class="mb-3 text-center">
    <a href="?pagina=home" class="btn btn-secondary btn-sm">🧹Limpar busca</a>
  </div>
<?php endif; ?>

<form class="input-group mb-4 shadow-sm">
  <button class="btn btn-primary" type="submit" id="button-addon1">🔎</button>
  <input name="busca" type="text" required class="form-control"
    placeholder="Buscar"
    value="<?= isset($_GET['busca']) ? $_GET['busca'] : '' ?>">
</form>

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
    if (isset($_GET['busca'])) {
      $busca = $_GET['busca'];
      include('conexao.php');

      $select = "SELECT * FROM estoque WHERE produto LIKE '%$busca%'";
      $result = $conn->query($select);

      if ($result->num_rows > 0) {
        while ($produto = $result->fetch_object()) {
          $situacao = $produto->quantidadeProduto <= 5 ? '<span class="badge bg-danger">Acabando</span>' : '<span class="badge bg-success">Disponível</span>';
          echo "<tr>
                  <td>$produto->produto</td>
                  <td>$produto->quantidadeProduto</td>
                  <td>$produto->valor</td>
                  <td>$situacao</td>
                  <td class='text-center'>
                    <a class='btn btn-warning btn-sm me-1' href='?pagina=editar&id=$produto->id&origem=home'>Editar</a>

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
                                    <a href='Estoque/apagar.php?id=$produto->id' class='btn btn-danger'>Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </td>";
        }
      } else {
        echo "
        <tr> 
            <td colspan='5' class='text-center text-secondary'>Nenhum Produto encontrado</td>
        </tr>";
      }
    }
    ?>
  </tbody>
</table>
</div>