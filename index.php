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
            <h2>Bem-vindo ao conteúdo principal!</h2>
            <p>Graças ao <code>flex: 1</code> no CSS, esta seção sempre empurrará o rodapé para a base da tela, mesmo que você tenha apenas uma linha de texto aqui.</p>
        </main>
        <?php include('footer.php'); ?>
    </body>
</html>



