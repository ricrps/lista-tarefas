<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <title>Lista de tarefas - Cadastro</title>    
    </head>

    <body class="login-page">
        
        <main class="container login">
            <h1>Lista de Tarefas</h1>
            
            <div class="form-container">
                <h2>Criar Conta</h2>
                
                <form action="cadastro.php" method="POST">
                    <div class="input-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" required placeholder="Seu nome completo">
                    </div>

                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required placeholder="seu@email.com">
                    </div>

                    <div class="input-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required placeholder="Crie uma senha">
                    </div>

                    <div class="input-group">
                        <label for="confirma_senha">Confirmar Senha</label>
                        <input type="password" id="confirma_senha" name="confirma_senha" required placeholder="Repita a senha">
                    </div>

                    <button type="submit" class="btn-entrar">Cadastrar</button>                    
                    
                    <a href="login.php">Já tenho uma conta</a>
                    
                </form>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>
</html>