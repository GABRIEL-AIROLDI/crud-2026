<?php
session_start();
include_once 'conexao.php';

$editData = null;

// Lógica de Apagar
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM carro WHERE CarroID = $id");
    header("Location: index.php");
    exit;
}

// Lógica de Editar (Carregar dados)
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM carro WHERE CarroID = $id");
    $editData = $result->fetch_assoc();
}

// Lógica de Salvar
if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];

    if (!empty($id)) {
        $sql = "UPDATE carro SET modelo='$modelo', marca='$marca', Ano='$ano', cor='$cor' WHERE CarroID=$id";
    } else {
        $sql = "INSERT INTO carro (modelo, marca, Ano, cor, ProprietarioID, ManutencaoID) VALUES ('$modelo', '$marca', '$ano', '$cor', 1, 1)";
    }
    $conn->query($sql);
    header("Location: index.php");
    exit;
}

$carros = $conn->query("SELECT * FROM carro");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Oficina - Carros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_SESSION['logado'])): ?>
        <a href="logout.php" class="btn-sair-topo">SAIR</a>
    <?php endif; ?>

    <div class="menu-navegacao">
        <a href="index.php" class="btn-menu">Carros</a>
        <a href="listamanutencao.php" class="btn-menu">Manutenções</a>
        <a href="listaproprietarios.php" class="btn-menu">Proprietários</a>
    </div>

    <h1>Gerenciamento de Carros</h1>

    <div class="form-container">
        <h2><?= $editData ? "Editar Carro" : "Cadastrar Novo Carro" ?></h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $editData['CarroID'] ?? '' ?>">
            <input type="text" name="modelo" placeholder="Modelo" value="<?= $editData['modelo'] ?? '' ?>" required>
            <input type="text" name="marca" placeholder="Marca" value="<?= $editData['marca'] ?? '' ?>" required>
            <input type="number" name="ano" placeholder="Ano" value="<?= $editData['Ano'] ?? '' ?>" required>
            <input type="text" name="cor" placeholder="Cor" value="<?= $editData['cor'] ?? '' ?>" required>
            <button type="submit" name="salvar">Salvar Dados</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Modelo</th><th>Marca</th><th>Ano</th><th>Cor</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $carros->fetch_assoc()): ?>
            <tr>
                <td><?= $row['CarroID'] ?></td>
                <td><?= $row['modelo'] ?></td>
                <td><?= $row['marca'] ?></td>
                <td><?= $row['Ano'] ?></td>
                <td><?= $row['cor'] ?></td>
                <td>
                    <a href="?edit=<?= $row['CarroID'] ?>" class="edit">Editar</a>
                    <a href="?delete=<?= $row['CarroID'] ?>" class="delete" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>