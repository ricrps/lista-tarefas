CREATE DATABASE IF NOT EXISTS lista_tarefas;
USE lista_tarefas;

CREATE TABLE usuarios (
    email VARCHAR(100) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    PRIMARY KEY (email)
);

CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    data DATE NOT NULL, 
    concluida BOOLEAN DEFAULT FALSE,
    usuario VARCHAR(100),
    FOREIGN KEY (usuario) REFERENCES usuarios(email) ON DELETE CASCADE
);

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    genero VARCHAR(100),
    ano INT,
    sinopse TEXT,
    assistido BOOLEAN DEFAULT FALSE,
    usuario VARCHAR(255),
    FOREIGN KEY (usuario) REFERENCES usuarios(email)
);