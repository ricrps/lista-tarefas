<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <div class="container">
        <nav>
            <div class="links">
                <a href="index.php">Home</a>
                <a href="nova-tarefa.php">Nova Tarefa</a>
            </div>

            <div class="usuario">
                <?php if (isset($_SESSION['usuario_nome'])): ?>
                    <a href="usuario-perfil.php" title="Editar perfil">
                        <?php echo $_SESSION['usuario_nome']; ?>
                    </a>
                    <a href="controllers/AutenticacaoController.php?acao=logout" title="Sair">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>