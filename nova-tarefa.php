<?php
require_once 'controllers/AutenticacaoController.php';
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

    <title>Lista de tarefas - Nova Tarefa</title>
</head>

<body class="formulario-page">
    <?php include('header.php'); ?>

    <main class="container">
        <div class="form-container">
            <h2>Cadastrar Tarefa</h2>

            <form action="controllers/TarefaController.php?acao=salvar" method="POST">

                <div class="input-group">
                    <label for="titulo">Tarefa</label>
                    <input type="text" id="titulo" name="titulo" required placeholder="Ex: Fazer compras">
                </div>

                <div class="input-group">
                    <label for="data">Data</label>
                    <input type="date" id="data" name="data" required>
                </div>

                <div class="input-group checkbox">
                    <input type="checkbox" id="concluida" name="concluida" value="1"
                        <?php echo (isset($tarefa) && $tarefa['concluida']) ? 'checked' : ''; ?>>
                    <label for="concluida">Concluída</label>
                </div>

                <button type="submit" class="botao-principal">Salvar</button>

                <a class="link" href="index.php">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Voltar para a lista
                </a>
            </form>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>