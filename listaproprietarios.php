<?php
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Oficina - Proprietários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Controle da Oficina</h1>
    <section id="proprietarios">
        <h2>Listagem de Proprietários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql_prop = "SELECT * FROM proprietario"; 
            $resultado_prop = $conn->query($sql_prop);

            if ($resultado_prop && $resultado_prop->num_rows > 0) {
                while($row = $resultado_prop->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>
                            <button id='editarprop-" . $row['id'] . "'>Editar</button>
                            <button id='excluirprop-" . $row['id'] . "'>Excluir</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum proprietário encontrado.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
</body>
</html>