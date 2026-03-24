<?php

class Tarefa {
    public $id;
    public $titulo;
    public $data;
    public $concluida;
    public $usuario;

    public function __construct($titulo, $data, $usuario, $concluida, $id = null) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->data = $data;
        $this->concluida = $concluida;
        $this->usuario = $usuario;
    }
}

class TarefaFactory {    
    public static function criar($titulo, $data, $usuario, $concluida = 0, $id = null) {        
        return new Tarefa($titulo, $data, $usuario, $concluida, $id);
    }
}