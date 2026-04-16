# Gerenciador de Tarefas e Filmes (MVC)

Este projeto é uma aplicação web desenvolvida em PHP seguindo a arquitetura **MVC (Model-View-Controller)**. O sistema permite o gerenciamento de tarefas pessoais e uma lista de filmes favoritos, com autenticação de usuários e persistência em banco de dados.

## Funcionalidades

- **Autenticação**: Login, cadastro e logout de usuários com segurança.
- **Gestão de Tarefas**: Listar, criar, editar, excluir e alternar status de conclusão.
- **Gestão de Filmes**: Listar, criar, editar e excluir filmes (incluindo título, gênero, ano e sinopse).
- **Perfil**: Edição de dados do usuário logado (Nome e Senha).
- **Segurança**: Proteção de rotas para garantir que apenas usuários autenticados acessem seus dados.

## Padrões de Projeto (Design Patterns)

O projeto implementa padrões de projeto para melhorar a organização e eficiência do código:

- **Singleton**: Aplicado na classe `Conexao.php` para garantir que exista apenas uma instância da conexão com o banco de dados (PDO) em toda a aplicação, otimizando o uso de recursos.
- **Factory**: Utilizado nos Models (`Usuario`, `Tarefa`, `Filme`) através de classes Factory para centralizar e padronizar a criação de novos objetos das entidades.

## Estrutura do Projeto

### **Controllers**

- `AutenticacaoController.php`: Responsável pelo controle de sessão e segurança.
- `UsuarioController.php`: Gerencia o cadastro de usuários e atualização de perfil.
- `TarefaController.php`: Processa todas as operações CRUD da entidade Tarefa.
- `FilmeController.php`: Processa todas as operações CRUD da entidade Filme.

### **Models**

- `Usuario.php`: Representação da entidade Usuario e sua respectiva Factory.
- `Tarefa.php`: Representação da entidade Tarefa e sua respectiva Factory.
- `Filme.php`: Representação da entidade Filme e sua respectiva Factory.

### **Views**

- `index.php` / `filmes.php`: Listagens principais.
- `nova-tarefa.php` / `editar-tarefa.php`: Telas de gerenciamento de tarefas.
- `novo-filme.php` / `editar-filme.php`: Telas de gerenciamento de filmes.
- `editar-perfil.php`: Interface para o usuário gerir seus dados.

### **Arquivos Auxiliares**

- `header.php` & `footer.php`: Fragmentos de interface reaproveitáveis.
- `styles.css`: Centralização dos estilos visuais do sistema.
- `config/Conexao.php`: Implementação do padrão Singleton para conexão PDO.

## Tecnologias Utilizadas

- **Linguagem**: PHP 8.x
- **Banco de Dados**: MySQL
- **Estilização**: CSS3 (Google Fonts & Material Symbols)
- **Arquitetura**: MVC + Design Patterns (Singleton e Factory)

---

