
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

            </tbody>
        </table>
    </section>

    <section id="proprietarios">
        <h2>Proprietários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
           
            </tbody>
        </table>
    </section>

    <section id="manutencao">
        <h2>Manutenção</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_manut = "SELECT * FROM manutencao";
                $resultado_manut = $conn->query($sql_manut);
                if ($resultado_manut && $resultado_manut->num_rows > 0) {
                    while($row = $resultado_manut->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ManutencaoID'] . "</td>";
                        echo "<td>" . $row['descricao'] . "</td>";
                        echo "<td>
                                <button id='editarmanut-" . $row['ManutencaoID'] . "'>Editar</button>
                                <button id='excluirmanut-" . $row['ManutencaoID'] . "'>Excluir</button>
                              </td>";
       echo "</tr>";
               }
       } else {
       echo "<tr><td colspan='3'>Nenhuma manutenção encontrada ou erro na tabela.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>