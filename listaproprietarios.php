<?php
session_start(); 
include_once 'conexao.php'; 

$editData = null;

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM proprietario WHERE ProprietarioID = $id");
    header("Location: listaproprietarios.php");
    exit;
}

if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM proprietario WHERE ProprietarioID = $id");
    if ($result && $result->num_rows > 0) {
        $editData = $result->fetch_assoc();
    }
}

if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    if (!empty($id)) {
        $sql = "UPDATE proprietario SET Nome='$nome' WHERE ProprietarioID=$id";
    } else {
        $sql = "INSERT INTO proprietario (Nome) VALUES ('$nome')";
    }
    $conn->query($sql);
    header("Location: listaproprietarios.php");
    exit;
}

$proprietarios = $conn->query("SELECT * FROM proprietario");
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Proprietários</title>
</head>
<body>
    
    <div class="menu-navegacao">
        <a href="index.php" class="btn-menu"> Carros</a>
        <a href="listaproprietarios.php" class="btn-menu"> Proprietários</a>
        <a href="listamanutencao.php" class="btn-menu">Manutenção</a>
        <?php if (isset($_SESSION['logado'])): ?>
            <a href="logout.php" class="btn-menu">SAIR</a>
        <?php endif; ?>
    </div>

    <h2><?= $editData ? "Editar Proprietário" : "Cadastrar Novo Proprietário" ?></h2>
    
    <div class="form-container">
        <form method="POST">
            <input type="hidden" name="id" value="<?= $editData['ProprietarioID'] ?? '' ?>">
            <label>Nome Completo: 
                <input type="text" name="nome" value="<?= $editData['Nome'] ?? '' ?>" required>
            </label>
            <button type="submit" name="salvar">Salvar Registro</button>
            
            <?php if ($editData): ?>
                <a href="listaproprietarios.php" style="margin-left:10px; color: #666;">Cancelar</a>
            <?php endif; ?>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $proprietarios->fetch_assoc()): ?>
            <tr>
                <td><?= $row['ProprietarioID'] ?></td>
                <td><?= $row['Nome'] ?></td>
                <td>
                    <a href="?edit=<?= $row['ProprietarioID'] ?>" class="edit">Editar</a>
                    <a href="?delete=<?= $row['ProprietarioID'] ?>" class="delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>