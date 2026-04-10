<?php
session_start();
include_once 'conexao.php';

if (isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT UsuarioID, senha FROM usuarios WHERE email = ?");
    
    if (!$stmt) {
        die("Erro no banco: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        
        if ($senha === $usuario['senha']) {
            $_SESSION['logado'] = true;
            $_SESSION['usuario_id'] = $usuario['UsuarioID'];
            $_SESSION['usuario_email'] = $email; 
            
            header("Location: index.php");
            exit;
        }
    }
    
    echo "<script>alert('E-mail ou senha incorreto'); window.location='login.php';</script>";
}
?>