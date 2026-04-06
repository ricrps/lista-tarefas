<?php
require_once 'controllers/AutenticacaoController.php';
require_once 'controllers/TarefaController.php';

AutenticacaoController::verificarAcesso();

$controller = new TarefaController();
$listaTarefas = $controller->listar();
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
    <main class="container index">
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

        <h2>Minhas Tarefas</h2>

        <div class="lista-tarefas">
            <?php if (empty($listaTarefas)): ?>
                <p style="text-align: center; color: #666; margin-top: 52px;">Nenhuma tarefa encontrada.</p>
            <?php else: ?>
                <?php foreach ($listaTarefas as $tarefa): ?>
                    <div class="card-tarefa <?php echo $tarefa['concluida'] ? 'concluida' : ''; ?>">

                        <div class="dados-tarefa">
                            <div class="check-container">
                                <input type="checkbox"
                                    class="checkbox-tarefa"
                                    <?php echo $tarefa['concluida'] ? 'checked' : ''; ?>
                                    onchange="window.location.href='controllers/TarefaController.php?acao=status&id=<?php echo $tarefa['id']; ?>&status=<?php echo $tarefa['concluida']; ?>'">
                            </div>
                            <div>
                                <h4><?php echo htmlspecialchars($tarefa['titulo']); ?></h3>
                                    <p><?php echo date('d/m/Y', strtotime($tarefa['data'])); ?></p>
                            </div>
                        </div>

                        <div class="acoes">
                            <a href="editar-tarefa.php?id=<?php echo $tarefa['id']; ?>" title="Editar">
                                <span class="material-symbols-outlined" style="color: #6200ee;">edit</span>
                            </a>
                            <a href="controllers/TarefaController.php?acao=excluir&id=<?php echo $tarefa['id']; ?>"
                                onclick="return confirm('Tem certeza que deseja excluir?')" title="Excluir">
                                <span class="material-symbols-outlined" style="color: #b71c1c;">delete</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <a href="nova-tarefa.php" class="botao-flutuante">
            <span class="material-symbols-outlined">add</span>
        </a>
    </main>


    <?php include('footer.php'); ?>
</body>

</html>