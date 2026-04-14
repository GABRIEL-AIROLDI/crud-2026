<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Oficina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <div class="form-container login-box">
            <h2>Acesso ao Sistema</h2>

            <form action="processo-login.php" method="POST">
                <label>E-mail: 
                    <input type="email" name="email" placeholder="Insira o seu e-mail" required>
                </label>
                
                <label>Senha: 
                    <input type="password" name="senha" placeholder="Digite a sua senha" required>
                </label>
                
                <button type="submit" name="entrar">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>