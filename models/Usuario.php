<?php
class Usuario {
    public $nome;
    public $email;
    public $senha;

    public function __construct($nome, $email, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }
}

class UsuarioFactory {
    public static function criar($nome, $email, $senha) {        
        $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);
        return new Usuario($nome, $email, $senhaSegura);
    }
}