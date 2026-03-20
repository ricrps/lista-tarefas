<?php
session_start();
require_once __DIR__ . '/../config/Conexao.php';

class AutenticacaoController {    
    
    public function logar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $db = Conexao::getInstancia();
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            $usuarioBD = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioBD && password_verify($senha, $usuarioBD['senha'])) {
                $_SESSION['usuario_nome'] = $usuarioBD['nome'];
                $_SESSION['usuario_email'] = $usuarioBD['email'];
                header("Location: ../index.php");
                exit;
            } else {
                $_SESSION['erro'] = "E-mail ou senha incorretos.";
                header("Location: ../login.php");
                exit;
            }
        }
    }
    
    public function logout() {
        session_destroy();
        header("Location: ../login.php");
        exit;
    }
    
    public static function verificarAcesso() {
        if (!isset($_SESSION['usuario_email'])) {
            header("Location: login.php");
            exit;
        }
    }
}

$controller = new AutenticacaoController();
$acao = $_GET['acao'] ?? '';

if ($acao === 'logar') {
    $controller->logar();
} elseif ($acao === 'logout') {
    $controller->logout();
}