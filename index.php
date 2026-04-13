<?php
session_start(); 
$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$editData = null;

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM carro WHERE CarroID = $id");
    header("Location: index.php");
    exit;
}

if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM carro WHERE CarroID = $id");
    if ($result && $result->num_rows > 0) {
        $editData = $result->fetch_assoc();
    }
}

if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];

    if (!empty($id)) {
        $sql = "UPDATE carro SET modelo='$modelo', marca='$marca', Ano='$ano', cor='$cor' WHERE CarroID=$id";
    } else {
        $sql = "INSERT INTO carro (modelo, marca, Ano, cor, ProprietarioID, ManutencaoID) 
                VALUES ('$modelo', '$marca', '$ano', '$cor', 1, 1)";
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
    <title>Gerenciamento de Carros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="menu-navegacao">
    <a href="index.php" class="btn-menu">Carros</a>
    <a href="listamanutencao.php" class="btn-menu">Manutenções</a>
    <a href="listaproprietarios.php" class="btn-menu">Proprietários</a>

    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
        <a href="logout.php" class="btn-menu" style="background-color: #e74c3c;">Sair (<?= $_SESSION['usuario_nome'] ?>)</a>
    <?php else ?>
        <a href="login.php" class="btn-menu btn-login">Login</a>
    <?php endif ?>
</div>
</div>
</div>
    <h2><?= $editData ? "Editar Carro" : "Adicionar Novo Carro" ?></h2>
    
    <div class="form-container">
        <form method="POST">
            <input type="hidden" name="id" value="<?= $editData['CarroID'] ?? '' ?>">
            <label>Modelo: <input type="text" name="modelo" value="<?= $editData['modelo'] ?? '' ?>" required></label>
            <label>Marca: <input type="text" name="marca" value="<?= $editData['marca'] ?? '' ?>" required></label>
            <label>Ano: <input type="number" name="ano" value="<?= $editData['Ano'] ?? '' ?>" required></label>
            <label>Cor: <input type="text" name="cor" value="<?= $editData['cor'] ?? '' ?>" required></label>
            
            <button type="submit" name="salvar">Salvar Carro</button>
            
            <?php if ($editData): ?>
                <a href="index.php" class="btn-cancelar">Cancelar</a>
                <a href="index.php" class="btn-login">Login</a>

            <?php endif; ?>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Modelo</th><th>Marca</th><th>Ano</th><th>Cor</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $carros->fetch_assoc()): ?>
            <tr>
                <td><?= $row['CarroID'] ?></td>
                <td><?= $row['modelo'] ?></td>
                <td><?= $row['marca'] ?></td>
                <td><?= $row['Ano'] ?></td>
                <td><?= $row['cor'] ?></td>
                <td>
                    <a class="edit" href="?edit=<?= $row['CarroID'] ?>">Editar</a>
                    <a class="delete" href="?delete=<?= $row['CarroID'] ?>" onclick="return confirm('Excluir este carro?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
<?php 

