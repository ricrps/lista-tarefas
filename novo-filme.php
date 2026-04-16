<?php
require_once 'controllers/AutenticacaoController.php';
// Garante que apenas usuários logados acessem
AutenticacaoController::verificarAcesso();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="css/styles.css" type="text/css" />
    <title>Adicionar Filme</title>
</head>

<body class="formulario-page">
    <?php include('header.php'); ?>

    <main class="container">
        <div class="form-container">
            <h2>Cadastrar Filme</h2>

            <form action="controllers/FilmeController.php?acao=salvar" method="POST">

                <div class="input-group">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>

                <div class="row" style="display: flex; gap: 15px;">
                    <div class="input-group" style="flex: 2;">
                        <label for="genero">Gênero</label>
                        <input type="text" id="genero" name="genero" placeholder="Drama, Ficção" required>
                    </div>
                    <div class="input-group" style="flex: 1;">
                        <label for="ano">Ano</label>
                        <input type="number" id="ano" name="ano" min="1888" max="2099" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="sinopse">Sinopse</label>
                    <textarea id="sinopse" name="sinopse" rows="5"></textarea>
                </div>

                <div class="input-group checkbox">
                    <input type="checkbox" id="assistido" name="assistido" value="1">
                    <label for="assistido">Assistido</label>
                </div>

                <button type="submit" class="botao-principal">Salvar</button>

                <a href="filmes.php" class="link">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Voltar para a lista
                </a>
            </form>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>