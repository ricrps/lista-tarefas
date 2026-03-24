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
                <a href="tarefa-nova.php">Cadastrar Tarefa</a>
            </div>

            <div class="usuario">
                <?php if (isset($_SESSION['usuario_nome'])): ?>
                    <span><?php echo $_SESSION['usuario_nome']; ?></span>
                    <a href="controllers/AutenticacaoController.php?acao=logout" title="Sair">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>