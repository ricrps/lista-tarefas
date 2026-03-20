<?php
class Conexao {
    private static $instancia = null;
    private $pdo;

    private function __construct() {
        $host = "localhost";
        $banco = "lista_tarefas";
        $usuario = "root";
        $senha = "";

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            die("Erro na conexão: " . $erro->getMessage());
        }
    }

    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new Conexao();
        }
        return self::$instancia->pdo;
    }
}