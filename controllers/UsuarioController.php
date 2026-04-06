<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $db = Conexao::getInstancia();

            $sqlVerifica = "SELECT email FROM usuarios WHERE email = :email";
            $stmt = $db->prepare($sqlVerifica);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['erro'] = "e-mail já cadastrado!";
                header("Location: ../cadastro.php");
                exit;
            }

            $usuario = UsuarioFactory::criar($nome, $email, $senha);

            $sqlInsert = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmtInsert = $db->prepare($sqlInsert);
            $stmtInsert->bindValue(':nome', $usuario->nome);
            $stmtInsert->bindValue(':email', $usuario->email);
            $stmtInsert->bindValue(':senha', $usuario->senha);

            if ($stmtInsert->execute()) {
                $_SESSION['sucesso'] = "Usuário cadastrado com sucesso! Faça o login.";
                header("Location: ../login.php");
                exit;
            }
        }
    }

    public function buscar()
    {
        $db = Conexao::getInstancia();
        $email = $_SESSION['usuario_email'];

        $sql = "SELECT nome, email FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $db = Conexao::getInstancia();
                $nome = $_POST['nome'];
                $novaSenha = $_POST['senha'];
                $email = $_SESSION['usuario_email'];
                
                if (!empty($novaSenha)) {
                    $senhaSegura = password_hash($novaSenha, PASSWORD_DEFAULT);
                    $sql = "UPDATE usuarios SET nome = :nome, senha = :senha WHERE email = :email";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(':senha', $senhaSegura);
                } else {                    
                    $sql = "UPDATE usuarios SET nome = :nome WHERE email = :email";
                    $stmt = $db->prepare($sql);
                }

                $stmt->bindValue(':nome', $nome);
                $stmt->bindValue(':email', $email);

                if ($stmt->execute()) {
                    $_SESSION['usuario_nome'] = $nome;
                    $_SESSION['sucesso'] = "Perfil atualizado com sucesso!";
                }
            } catch (Exception $e) {
                $_SESSION['erro'] = "Erro ao atualizar perfil.";
            }
            header("Location: ../index.php");
            exit;
        }
    }
}

$controller = new UsuarioController();

$acao = $_GET['acao'] ?? '';

if ($acao === "cadastrar") {
    $controller->cadastrar();
} elseif ($acao === "editar") {
    $controller->editar();
}
