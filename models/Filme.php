<?php

class Filme
{
    public $id;
    public $titulo;
    public $genero;
    public $ano;
    public $sinopse;
    public $assistido;
    public $usuario_email;

    public function __construct($titulo, $genero, $ano, $sinopse, $assistido, $usuario_email, $id = null)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->ano = $ano;
        $this->sinopse = $sinopse;
        $this->assistido = $assistido;
        $this->usuario_email = $usuario_email;
    }
}

class FilmeFactory
{
    public static function criar($titulo, $genero, $ano, $sinopse, $assistido, $usuario_email, $id = null)
    {
        return new Filme($titulo, $genero, $ano, $sinopse, $assistido, $usuario_email, $id);
    }
}
