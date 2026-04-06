<?php
require_once 'controllers/AutenticacaoController.php';
require_once 'controllers/UsuarioController.php';

AutenticacaoController::verificarAcesso();

$userController = new UsuarioController();
$usuario = $userController->buscar();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <title>Editar Perfil</title>
</head>

<body class="formulario-page">
    <?php include('header.php'); ?>

    <main class="container">
        <div class="form-container">
            <h2>Meu Perfil</h2>

            <form action="controllers/UsuarioController.php?acao=editar" method="POST">

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" readonly
                        style="background-color: #f3ebff; cursor: not-allowed; border-color: #e1d0f5;">
                </div>

                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome"
                        value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                </div>

                <div class="input-group">
                    <label for="senha">Nova Senha</label>
                    <input type="password" id="senha" name="senha"
                           placeholder="Deixe em branco para manter a atual">
                </div>

                <button type="submit" class="botao-principal">Salvar</button>

                <a href="index.php" class="link">Voltar</a>
            </form>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>