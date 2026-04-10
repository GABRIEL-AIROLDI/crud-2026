<?php 
include_once 'conexao.php'; 

$editData = null;

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM manutencao WHERE ManutencaoID = $id");
    header("Location: listamanutencao.php");
    exit;
}

if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM manutencao WHERE ManutencaoID = $id");
    if ($result && $result->num_rows > 0) {
        $editData = $result->fetch_assoc();
    }
}

if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];

    if (!empty($id)) {
        $sql = "UPDATE manutencao SET descricao='$descricao' WHERE ManutencaoID=$id";
    } else {
        $sql = "INSERT INTO manutencao (descricao) VALUES ('$descricao')";
    }
    
    $conn->query($sql);
    header("Location: listamanutencao.php");
    exit;
}

$manutencoes = $conn->query("SELECT * FROM manutencao");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Manutenção</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="menu-navegacao">
    <a href="index.php" class="btn-menu">Carros</a>
    <a href="listamanutencao.php" class="btn-menu">Manutenções</a>
    <a href="listaproprietarios.php" class="btn-menu">Proprietários</a>

    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
        <a href="logout.php" class="btn-menu" style="background-color: #e74c3c;">Sair (<?= $_SESSION['usuario_email'] ?>)</a>
    <?php else: ?>
        <a href="login.php" class="btn-menu btn-login">Login</a>
    <?php endif; ?>
</div>
    <h2><?= $editData ? "Editar Manutenção" : "Registrar Nova Manutenção" ?></h2>
    
    <div class="form-container">
        <form method="POST">
            <input type="hidden" name="id" value="<?= $editData['ManutencaoID'] ?? '' ?>">
            
            <label>Descrição do Serviço: 
                <input type="text" name="descricao" value="<?= $editData['descricao'] ?? '' ?>" required>
            </label>
            
            <button type="submit" name="salvar">Salvar Serviço</button>
            
            <?php if ($editData): ?>
                <a href="listamanutencao.php" class="btn-cancelar">Cancelar</a>
            <?php endif; ?>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $manutencoes->fetch_assoc()): ?>
            <tr>
                <td><?= $row['ManutencaoID'] ?></td>
                <td><?= $row['descricao'] ?></td>
                <td>
                    <a class="edit" href="?edit=<?= $row['ManutencaoID'] ?>">Editar</a>
                    <a class="delete" href="?delete=<?= $row['ManutencaoID'] ?>" onclick="return confirm('Excluir este registro?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>