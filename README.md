# 🛒 Purchase API com CodeIgniter 4

Este é um projeto de uma API simples e poderosa construída com **CodeIgniter 4** para gerenciar clientes, produtos e pedidos de compra. 🚀

## 📌 Funcionalidades
- 📁 **CRUD** para **Clientes** (CPF e/ou CNPJ, Nome e/ou Razão Social)
- 📦 **CRUD** para **Produtos**
- 🛍️ **CRUD** para **Pedidos de Compra**, com status: **Em Aberto, Pago ou Cancelado**

## 🏗️ Estrutura do Projeto
```
📂 app
 ┣ 📂 Config         # Arquivos de Configuração
 ┣ 📂 Controllers    # Controladores da API
 ┣ 📂 Controllers    # Controladores da API
 ┣ 📂 Enum           # Enums usadas na aplicação
 ┣ 📂 Exceptions     # Exceptions customizadas para a aplicação
 ┣ 📂 Models         # Modelos do Banco de Dados
 ┣ 📂 Services       # Camada de Lógica de Negócio
 ┣ 📂 Validation     # Regras de Validação Personalizadas
 ┗ 📂 Transformers   # Formatação de Respostas da API
📂 database
 ┣ 📂 Migrations     # Migrações do Banco de Dados
 ┗ 📂 Seeds          # Seeders do Banco de Dados
📂 public          # Arquivos Públicos
📂 tests           # Testes Automatizados
```

## 🛠️ Tecnologias Utilizadas
- 🏗️ **Framework:** CodeIgniter 4
- 🐘 **Banco de Dados:** MySQL
- 🐳 **Containerização:** Docker & Docker Compose
- 🔄 **ORM & Migrações:** CodeIgniter Model & Migrations
- 📜 **Validação & Transformers:** Regras de Validação Personalizadas & Formatação de Respostas

## 🚀 Como Rodar
### 🔧 Pré-requisitos
Certifique-se de ter instalado:
- 🐳 Docker & Docker Compose (para ambiente conteinerizado)
- 🐘 PHP 8+
- 🛠️ Composer
- 🗄️ MySQL

### 📥 Instalação & Configuração
#### 1️⃣ Copiar o Arquivo de Ambiente
Antes de rodar o projeto, copie o arquivo de ambiente de exemplo e ajuste as configurações necessárias:
```sh
cp .env.example .env
```

#### 2️⃣ Rodando com **Makefile** 🛠️
Para um build otimizado em produção, execute:
```sh
make prod
```

#### 3️⃣ Rodando com **Docker Compose** 🐳
Para um ambiente local conteinerizado, use:
```sh
docker compose up --build -d
docker compose exec -it app php spark migrate
```

#### 4️⃣ Rodando **Localmente** 🖥️
Se preferir rodar sem Docker:
```sh
composer install
php spark migrate
php spark serve
```

## 📌 Observações
- Certifique-se de que o **MySQL** está rodando e configurado corretamente no `.env`.
- A API segue o padrão **RESTful**, retornando respostas JSON estruturadas.

