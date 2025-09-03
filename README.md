# 📚 Book Gallery - Backend

Backend do sistema **Book Gallery**, responsável por fornecer a API RESTful para gerenciamento de livros e autores.  

Desenvolvido em **Laravel**, o backend oferece rotas para CRUD completo de **books** e **authors**, além de endpoints para consultar livros por autor.

---

## 🧐 Sobre o Projeto

O **Book Gallery Backend** fornece:

- Rotas RESTful para gerenciar livros e autores.
- Associação de livros a autores.
- Validações e respostas padronizadas em JSON.
- Estrutura modular com Controllers e Repositories.
- Preparado para integração com o frontend React.

---

## 🛠 Tecnologias Utilizadas

- **PHP 8.x**
- **Laravel 10** – framework backend
- **MySQL** – banco de dados relacional
- **Composer** – gerenciamento de dependências
- **PHPUnit** – testes unitários (opcional)

---

## ⚙ Funcionalidades

### Books

- Listar todos os livros
- Adicionar novo livro
- Editar livro existente
- Deletar livro
- Associar livro a um autor

### Authors

- Listar todos os autores
- Listar livros de um autor específico
- Adicionar novo autor
- Editar autor existente
- Deletar autor

---

## 🛣 Rotas Disponíveis

### Books

| Método | Rota       | Descrição                  |
|--------|------------|----------------------------|
| GET    | `/books`   | Listar todos os livros     |
| POST   | `/books`   | Criar novo livro           |
| PUT    | `/books/{id}` | Atualizar livro existente |
| DELETE | `/books/{id}` | Deletar livro existente   |

### Authors

| Método | Rota                  | Descrição                         |
|--------|----------------------|-----------------------------------|
| GET    | `/authors`           | Listar todos os autores           |
| GET    | `/authors/books/{id}` | Listar livros de um autor         |
| POST   | `/authors`           | Criar novo autor                  |
| PUT    | `/authors/{id}`      | Atualizar autor existente         |
| DELETE | `/authors/{id}`      | Deletar autor existente           |

---

## 🚀 Como Rodar

### Pré-requisitos

- PHP >= 8.1
- Composer
- MySQL ou outro banco compatível
- Node.js e NPM/Yarn (para rodar frontend integrado, opcional)

### Passos

```bash
# 1. Clone este repositório
git clone https://github.com/seu-usuario/book-gallery-backend.git
cd book-gallery-backend

# 2. Instale dependências via Composer
composer install

# 3. Copie o arquivo .env.example para .env
cp .env.example .env

# 4. Configure a conexão do banco de dados no arquivo .env

(Para funcionar corretamente, crie um banco com o nome "book_gallery" localmente)

# DB_DATABASE=book_gallery
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Gere a chave do aplicativo
php artisan key:generate

# 6. Rode as migrations para criar as tabelas
php artisan migrate

# 8. Inicie o servidor de desenvolvimento
php artisan serve

# O backend estará disponível em
# http://127.0.0.1:8000
