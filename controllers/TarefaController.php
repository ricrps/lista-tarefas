<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Tarefa.php';

class TarefaController
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getInstancia();
    }

    public function listar()
    {
        $usuario = $_SESSION['usuario_email'];
        $sql = "SELECT * FROM tarefas WHERE usuario = :usuario ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id)
    {
        $usuario = $_SESSION['usuario_email'];
        $sql = "SELECT * FROM tarefas WHERE id = :id AND usuario = :usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id     = $_POST['id'] ?? null;
                $titulo = $_POST['titulo'];
                $data   = $_POST['data'];
                $usuario   = $_SESSION['usuario_email'];                
                
                $concluida = isset($_POST['concluida']) ? 1 : 0;

                $tarefa = TarefaFactory::criar($titulo, $data, $usuario, $concluida, $id);

                if ($id) {
                    $sql = "UPDATE tarefas SET titulo = :titulo, data = :data, concluida = :concluida 
                            WHERE id = :id AND usuario = :usuario";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindValue(':id', $tarefa->id);
                } else {
                    $sql = "INSERT INTO tarefas (titulo, data, concluida, usuario) VALUES (:titulo, :data, :concluida, :usuario)";
                    $stmt = $this->db->prepare($sql);
                }

                $stmt->bindValue(':titulo', $tarefa->titulo);
                $stmt->bindValue(':data', $tarefa->data);
                $stmt->bindValue(':usuario', $tarefa->usuario);                
                $stmt->bindValue(':concluida', $tarefa->concluida, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $_SESSION['sucesso'] = "Tarefa salva com sucesso!";
                }
            } catch (Exception $ex) {
                $_SESSION['erro'] = "Erro ao salvar tarefa: " . $ex->getMessage();
            } finally {
                header("Location: ../index.php");
                exit;
            }
        }
    }

    public function excluir()
    {
        try {
            $id = $_GET['id'];
            $usuario = $_SESSION['usuario_email'];

            $sql = "DELETE FROM tarefas WHERE id = :id AND usuario = :u";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':u', $usuario);
            if ($stmt->execute()) {
                $_SESSION['sucesso'] = "Tarefa excluída com sucesso!";
            }
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao excluir tarefa: " . $ex->getMessage();
        } finally {
            header("Location: ../index.php");
            exit;
        }
    }

    public function mudarStatus() {
        try {
            $id = $_GET['id'];
            $status = $_GET['status'];
            $usuario = $_SESSION['usuario_email'];

            $status = !$status;

            $sql = "UPDATE tarefas SET concluida = :status WHERE id = :id AND usuario = :usuario";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindValue(':status', $status, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':usuario', $usuario);
            
            if ($stmt->execute()) {
                $_SESSION['sucesso'] = $status ? "Tarefa concluída!" : "Tarefa não concluída!";
            }
            
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao editar tarefa: " . $ex->getMessage();
        } finally {
            header("Location: ../index.php");
            exit;
        }
    }
}

$controller = new TarefaController();
$acao = $_GET['acao'] ?? '';

if ($acao === 'salvar') {
    $controller->salvar();
} elseif ($acao === 'excluir') {
    $controller->excluir();
} elseif ($acao === 'listar') {
    $controller->listar();
} elseif ($acao === 'status') {
    $controller->mudarStatus();
}
