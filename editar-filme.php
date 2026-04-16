<?php
require_once 'controllers/AutenticacaoController.php';
require_once 'controllers/FilmeController.php';

AutenticacaoController::verificarAcesso();

$id = $_GET['id'] ?? null;
$controller = new FilmeController();
$filme = $controller->buscar($id);


if (!$filme) {
    header("Location: filmes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="css/styles.css" type="text/css" />
    <title>Editar Filme</title>
</head>

<body class="formulario-page">
    <?php include('header.php'); ?>

    <main class="container">
        <div class="form-container">
            <h2>Editar Filme</h2>

            <form action="controllers/FilmeController.php?acao=salvar" method="POST">
                <input type="hidden" name="id" value="<?php echo $filme['id']; ?>">

                <div class="input-group">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo"
                        value="<?php echo htmlspecialchars($filme['titulo']); ?>" required>
                </div>

                <div class="row" style="display: flex; gap: 15px;">
                    <div class="input-group" style="flex: 2;">
                        <label for="genero">Gênero</label>
                        <input type="text" id="genero" name="genero"
                            value="<?php echo htmlspecialchars($filme['genero']); ?>" required>
                    </div>
                    <div class="input-group" style="flex: 1;">
                        <label for="ano">Ano</label>
                        <input type="number" id="ano" name="ano"
                            value="<?php echo $filme['ano']; ?>" min="1888" max="2099" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="sinopse">Sinopse</label>
                    <textarea id="sinopse" name="sinopse" rows="5"><?php echo htmlspecialchars($filme['sinopse']); ?></textarea>
                </div>

                <div class="input-group checkbox">
                    <input type="checkbox" id="assistido" name="assistido" value="1"
                        <?php echo ($filme['assistido']) ? 'checked' : ''; ?>>
                    <label for="assistido">Assistido</label>
                </div>

                <button type="submit" class="botao-principal">Salvar</button>

                <a href="filmes.php" class="link">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Cancelar
                </a>
            </form>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>