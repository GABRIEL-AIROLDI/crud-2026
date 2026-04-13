<?php
session_start(); 

$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
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
        // Atualiza
        $sql = "UPDATE proprietario SET Nome='$nome' WHERE ProprietarioID=$id";
    } else {
        // Insere novo
        $sql = "INSERT INTO proprietario (Nome) VALUES ('$nome')";
    }
    
    $conn->query($sql);
    header("Location: listaproprietarios.php");
    exit;
}

$proprietarios = $conn->query("SELECT * FROM proprietario");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Proprietários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="menu-navegacao">
    <a href="index.php" class="btn-menu">Carros</a>
    <a href="listamanutencao.php" class="btn-menu">Manutenções</a>
    <a href="listaproprietarios.php" class="btn-menu">Proprietários</a>

    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
        <a href="logout.php" class="btn-menu">
            Sair (<?= htmlspecialchars($_SESSION['usuario_nome']) ?>)
        </a>
    <?php else ?>
        <a href="login.php" class="btn-menu btn-login">Login</a>
    <?php endif ?>
</div>
    <h2><?= $editData  "Editar Proprietário"  "Cadastrar Novo Proprietário" ?></h2>
    
    <div class="form-container">
        <form method="POST">
            <input type="hidden" name="id" value="<?= $editData['ProprietarioID'] ?? '' ?>">
            
            <label>Nome Completo: 
                <input type="text" name="nome" value="<?= $editData['Nome'] ?? '' ?>" required>
            </label>
            
            <button type="submit" name="salvar">Salvar Registro</button>
            
            <?php if ($editData): ?>
                <a href="listaproprietarios.php" class="btn-cancelar">Cancelar</a>
            <?php endif ?>
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
                    <a class="edit" href="?edit=<?= $row['ProprietarioID'] ?>">Editar</a>
                    <a class="delete" href="?delete=<?= $row['ProprietarioID'] ?>" onclick="return confirm('Excluir este proprietário?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>