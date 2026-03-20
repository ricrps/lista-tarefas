<?php
session_start();
require_once '../config/Conexao.php';
require_once '../models/Usuario.php';

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
}

$controller = new UsuarioController();

$acao = $_GET['acao'] ?? '';

if ($acao === "cadastrar") {
    $controller->cadastrar();
}
