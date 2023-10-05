<?php
session_start();
if (!isset($_SESSION["user"])) {
  echo "<script language='javascript' type='text/javascript'>
    window.location.href='index.php';
    </script>";
  exit;
}
include 'cabecalho.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="content-language" content="pt-br">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .header {
      float: right;
    }
  </style>
</head>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <div class="container-fluid">
    <br><br>
    <div class="row row-cols-2 row-cols-md-1 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-2">
            <h4 class="my-0 fw-normal"><b><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
            </svg>&nbsp;&nbsp;Clientes</b></h4><br />
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Peso</th>
                  <th scope="col">Altura</th>
                  <th scope="col">IMC</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'conecta.php';
                $pesquisa = mysqli_query($conn, "SELECT * FROM treinos");
                $row = mysqli_num_rows($pesquisa);
                if ($row > 0) {
                  while ($registro = $pesquisa->fetch_array()) {
                    $id = $registro['id'];
                    echo '<tr>';
                    echo '<td>' . $registro['id'] . '</td>';
                    echo '<td>' . $registro['nome'] . '</td>';
                    echo '<td>' . $registro['peso'] . '</td>';
                    echo '<td>' . $registro['altura'] . '</td>';
                    echo '<td>' . $registro['imc'] . '</td>';

                    echo '<td><a href="cadtreinos.php?id=' . $id . '" data-bs-toggle="modal" data-id="' . $id . '" data-bs-target="#exampleModal' . $id . '" style="text-decoration: none;" data-bs-toggle="tooltip" title="Criar Treinos">✏️</a> | <a href="vertreino.php?id=' . $id . '" style="text-decoration: none;" data-bs-toggle="tooltip" title="Ver Treinos">📋</a></td>';
                    echo '</tr>';
                    echo '<div class="modal fade" id="exampleModal' . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog modal-dialog-centered">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Criar Treino</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    include 'criatreinos.php';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                  }
                  echo '</tbody>';
                  echo '</table>';
                } else {
                  echo 'Sem Clientes no momento.';
                  echo '</tbody>';
                  echo '</table>';
                }
                ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Criar Treinos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="cadtreinos.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                  <label>Digite o Treino:</label>
                  <textarea type="text" class="form-control" rows="10" name="treino" style='margin-top: 10px' required /></textarea>
                  <br />
                  <div class="d-grid gap-2 col-20 mx-auto">
                    <button type="submit" class="btn btn-success">Adicionar Treino</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>