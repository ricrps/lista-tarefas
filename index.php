<?php
require_once 'controllers/AutenticacaoController.php';
AutenticacaoController::verificarAcesso();
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
    <title>Lista de tarefas</title>
</head>

<body>
    <?php include('header.php'); ?>
    <main class="container">
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
    </main>
    <?php include('footer.php'); ?>
</body>

</html>