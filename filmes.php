<?php
require_once 'controllers/AutenticacaoController.php';
require_once 'controllers/FilmeController.php';

// Garante que o usuário esteja logado
AutenticacaoController::verificarAcesso();

$controller = new FilmeController();
$filmes = $controller->listar();
?>
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
    <title>Filmes</title>
</head>

<body>
    <?php include('header.php'); ?>
    <main class="container index">
        <h2>Filmes</h2>
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="mensagem sucesso">
                <span class="material-symbols-outlined">check_circle</span>
                <?php echo $_SESSION['sucesso'];
                unset($_SESSION['sucesso']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['erro'])): ?>
            <div class="mensagem erro">
                <span class="material-symbols-outlined">error</span>
                <?php echo $_SESSION['erro'];
                unset($_SESSION['erro']); ?>
            </div>
        <?php endif; ?>

        <div class="lista-tarefas">
            <?php if (empty($filmes)): ?>
                <p class="nenhum-registro">Nenhum filme encontrado.</p>
            <?php else: ?>
                <?php foreach ($filmes as $filme): ?>
                    <div class="card-tarefa <?php echo $filme['assistido'] ? 'concluida' : ''; ?>">
                        <div class="dados-tarefa">
                            <div class="check-container">
                                <input type="checkbox" class="checkbox-tarefa"
                                    <?php echo $filme['assistido'] ? 'checked' : ''; ?>
                                    onchange="window.location.href='controllers/FilmeController.php?acao=status&id=<?php echo $filme['id']; ?>&status=<?php echo $filme['assistido']; ?>'">
                            </div>

                            <div class="info-filme">
                                <h4><?php echo htmlspecialchars($filme['titulo']); ?></h4>
                                <small><?php echo htmlspecialchars($filme['genero']); ?> • <?php echo $filme['ano']; ?></small>

                                <p class="sinopse-preview">
                                    <?php
                                    $sinopse = htmlspecialchars($filme['sinopse']);
                                    echo (mb_strlen($sinopse) > 100) ? mb_substr($sinopse, 0, 100) . "..." : $sinopse;
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="acoes">
                            <a href="editar-filme.php?id=<?php echo $filme['id']; ?>" title="Editar">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <a href="controllers/FilmeController.php?acao=excluir&id=<?php echo $filme['id']; ?>"
                                title="Excluir"
                                onclick="return confirm('Deseja realmente remover este filme?')">
                                <span class="material-symbols-outlined" style="color: #b71c1c;">delete</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <a href="novo-filme.php" class="botao-flutuante" title="Adicionar Filme">
            <span class="material-symbols-outlined">add</span>
        </a>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>