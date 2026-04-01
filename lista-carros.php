<?php
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Oficina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Controle da Oficina</h1>
    <section id="carros">
        <h2>Listagem de Carros</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Ano</th>
                    <th>Cor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $sql_carros = "SELECT * FROM carro"; 
              $resultado_carros = $conn->query($sql_carros);

              if ($resultado_carros && $resultado_carros->num_rows > 0) {
                  while($row = $resultado_carros->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['CarroID'] . "</td>";
                      echo "<td>" . $row['modelo'] . "</td>";
                      echo "<td>" . $row['marca'] . "</td>";
                      echo "<td>" . $row['Ano'] . "</td>";
                      echo "<td>" . $row['cor'] . "</td>";
                      echo "<td>
                              <button id='editarcarro-" . $row['CarroID'] . "'>Editar</button>
                              <button id='excluircarro-" . $row['CarroID'] . "'>Excluir</button>
                            </td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='6'>Nenhum carro encontrado.</td></tr>";
              }
              ?>
            </tbody>
        </table>
    </section>

