# Notado API 📚

Este projeto é uma aplicação desenvolvida em Laravel que visa desenvolver um sistema de gerenciamento de notas escolares, onde professores podem lançar notas nas matérias que lecionam, e alunos podem consultar suas notas.

## ⚙️ Funcionalidades Principais

### 🧑‍🏫 Cadastro de Usuários:

Usuários podem ser registrados no sistema entre três perfis diferentes:
- Aluno: Pode visualizar notas disponíveis das matérias que participou.
- Professor: Pode adicionar nota para cada aluno de suas matérias.
- Administrador: Possui acesso total ao sistema, podendo criar, editar e excluir matérias, além de gerenciar usuários e suas permissões.

### ✏️ Cadastro e Edição de Matérias:

Administradores podem criar e gerenciar matérias, definindo detalhes como nome e quantidade de provas.
Cada matéria tem um professor associado, que será responsável por dar notas para cada prova dos alunos.

### 📋 Inscrição em Matérias:

Administradores podem definir qual é o professor da matéria e seus alunos.

## 👨‍💻 Tecnologias Utilizadas
- Laravel: Framework PHP para desenvolvimento da API.
- Breeze: Pacote do Laravel que oferece uma configuração simples de autenticação com recursos como login, registro e redefinição de senha.

## 🛠️ Como Instalar

1. Clone o repositório:

```bash
https://github.com/UB-NoneCoders/API-Notas-Escolares.git
```

2. Navegue até o diretório do projeto:
```bash
cd notado-api
```

3. Instale as dependências:
```bash
composer install
```

4. Configure o arquivo .env com suas credenciais de banco de dados:

```bash
cp .env.example .env
```

5. Gere a chave da aplicação:
```bash
php artisan key:generate
```

6. Execute as migrações para criar as tabelas no banco de dados:

```bash
php artisan migrate
```

7. Inicie o servidor local:
```
php artisan serve
```

## 📖 Sobre
Este projeto foi desenvolvido pelos alunos do curso de Sistemas de Informação do Centro Universitário Unibalsas: Matheus Augusto, Luan Kloh e Guilherme Mendonça.
