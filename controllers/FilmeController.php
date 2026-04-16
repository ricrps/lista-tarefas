<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Importação com caminhos seguros
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Filme.php';

class FilmeController
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getInstancia();
    }

    public function listar()
    {
        $usuario = $_SESSION['usuario_email'];
        // Ordenamos pelos mais recentes inseridos
        $sql = "SELECT * FROM filmes WHERE usuario = :usuario ORDER BY ano DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id)
    {
        $usuario = $_SESSION['usuario_email'];
        $sql = "SELECT * FROM filmes WHERE id = :id AND usuario = :usuario";
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
                $id        = $_POST['id'] ?? null;
                $titulo    = $_POST['titulo'];
                $genero    = $_POST['genero'];
                $ano       = $_POST['ano'];
                $sinopse   = $_POST['sinopse'];
                $usuario   = $_SESSION['usuario_email'];
                $assistido = isset($_POST['assistido']) ? 1 : 0;

                // Uso da FilmeFactory (Model que criámos anteriormente)
                $filme = FilmeFactory::criar($titulo, $genero, $ano, $sinopse, $assistido, $usuario, $id);

                if ($filme->id) {
                    $sql = "UPDATE filmes SET titulo = :titulo, genero = :genero, ano = :ano, sinopse = :sinopse, assistido = :assistido 
                            WHERE id = :id AND usuario = :usuario";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindValue(':id', $filme->id);
                } else {
                    $sql = "INSERT INTO filmes (titulo, genero, ano, sinopse, assistido, usuario) 
                            VALUES (:titulo, :genero, :ano, :sinopse, :assistido, :usuario)";
                    $stmt = $this->db->prepare($sql);
                }

                $stmt->bindValue(':titulo', $filme->titulo);
                $stmt->bindValue(':genero', $filme->genero);
                $stmt->bindValue(':ano', $filme->ano);
                $stmt->bindValue(':sinopse', $filme->sinopse);
                $stmt->bindValue(':assistido', $filme->assistido, PDO::PARAM_INT);
                $stmt->bindValue(':usuario', $filme->usuario_email);

                if ($stmt->execute()) {
                    $_SESSION['sucesso'] = "Filme salvo com sucesso!";
                }
            } catch (Exception $ex) {
                $_SESSION['erro'] = "Erro ao guardar filme: " . $ex->getMessage();
            } finally {
                header("Location: ../filmes.php");
                exit;
            }
        }
    }

    public function excluir()
    {
        try {
            $id = $_GET['id'];
            $usuario = $_SESSION['usuario_email'];

            $sql = "DELETE FROM filmes WHERE id = :id AND usuario = :usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':usuario', $usuario);

            if ($stmt->execute()) {
                $_SESSION['sucesso'] = "Filme excluído com sucesso!";
            }
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao excluir filme.";
        } finally {
            header("Location: ../filmes.php");
            exit;
        }
    }

    public function mudarStatus()
    {
        try {
            $id = $_GET['id'];
            $statusAtual = $_GET['status'];
            $usuario = $_SESSION['usuario_email'];

            $novoStatus = !$statusAtual;

            $sql = "UPDATE filmes SET assistido = :status WHERE id = :id AND usuario = :usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', $novoStatus, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':usuario', $usuario);

            if ($stmt->execute()) {
                $_SESSION['sucesso'] = $novoStatus ? "Filme assistido!" : "Film não assistido!";
            }
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao editar filme.";
        } finally {
            header("Location: ../filmes.php");
            exit;
        }
    }
}

// Processamento de Rotas
$controller = new FilmeController();
$acao = $_GET['acao'] ?? '';

if ($acao === 'salvar') {
    $controller->salvar();
} elseif ($acao === 'excluir') {
    $controller->excluir();
} elseif ($acao === 'status') {
    $controller->mudarStatus();
}
