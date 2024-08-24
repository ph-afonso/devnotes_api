

---

# Simple Notes System - API

## Descrição

Esta é uma API simples desenvolvida em PHP Estrutural com MySQL para gerenciar um sistema de anotações. A API permite realizar operações de **CRUD** (Criar, Ler, Atualizar e Deletar) em anotações armazenadas em um banco de dados MySQL. Este projeto é executado localmente utilizando o XAMPP.

## Funcionalidades

A API possui os seguintes recursos:

- Listar todas as notas
- Exibir uma anotação específica
- Inserir novas notas
- Atualizar notas existentes
- Excluir notas

## Estrutura de Dados

Cada nota é armazenada com os seguintes campos:

- **ID**: Identificador único da nota
- **Título**: O título da nota
- **Corpo**: O conteúdo da anotação

## Endpoints da API

### 1. Testar a API

**Endpoint:** `ping.php`

```http
GET /api/ping.php
```

#### Resposta:

```json
{
  "result": {
    "pong": true
  },
  "error": ""
}
```

Verifique se a API está funcionando corretamente com este endpoint. Se você receber a resposta acima, a API está operacional.

---

### 2. Listar todas as notas

**Endpoint:** `getall.php`

```http
GET /api/getall.php
```

#### Resposta:

Se houver notas:

```json
{
  "result": [
    {
      "id": 1,
      "title": "Título da Nota"
    },
    {
      "id": 2,
      "title": "Outra Nota"
    }
  ],
  "error": ""
}
```

Se não houver notas:

```json
{
  "result": "No notes were found.",
  "error": ""
}
```

Se o método HTTP não for `GET`:

```json
{
  "result": [],
  "error": "Method not accepted. The expected method is: GET."
}
```

---

### 3. Exibir uma anotação específica

**Endpoint:** `get.php`

```http
GET /api/get.php
```

#### Parâmetros:

- `id` (obrigatório): O ID da nota que você deseja visualizar.

#### Exemplo de Requisição:

```http
GET /api/get.php?id=1
```

#### Resposta:

Se o ID da nota existir:

```json
{
  "result": {
    "id": 1,
    "title": "Título da Nota",
    "body": "Conteúdo da Nota"
  },
  "error": ""
}
```

Se o ID não existir:

```json
{
  "result": {},
  "error": "The ID sent does not exist."
}
```

Se o parâmetro `id` não for enviado:

```json
{
  "result": {},
  "error": "The ID parameter was not sent."
}
```

Se o método HTTP não for `GET`:

```json
{
  "result": {},
  "error": "Method not accepted. The expected method is: GET."
}
```

---

### 4. Inserir uma nova nota

**Endpoint:** `insert.php`

```http
POST /api/insert.php
```

#### Parâmetros (enviados no corpo da requisição):

- `title` (obrigatório): O título da nova nota.
- `body` (obrigatório): O conteúdo da nova nota.

#### Exemplo de Requisição:

```json
{
  "title": "Nova Nota",
  "body": "Conteúdo da nova anotação"
}
```

#### Resposta:

Se os dados forem enviados corretamente:

```json
{
  "result": [
    {
      "id": 3,
      "title": "Nova Nota",
      "body": "Conteúdo da nova anotação"
    }
  ],
  "error": ""
}
```

Se o título ou o corpo não forem fornecidos:

```json
{
  "result": [],
  "error": "To insert a note, make sure you have sent a title and body."
}
```

Se o método HTTP não for `POST`:

```json
{
  "result": [],
  "error": "Method not accepted. The expected method is: POST."
}
```

---

### 5. Atualizar uma nota existente

**Endpoint:** `update.php`

```http
PUT /api/update.php
```

#### Parâmetros (enviados no corpo da requisição):

- `id` (obrigatório): O ID da nota que será atualizada.
- `title` (obrigatório): O novo título da nota.
- `body` (obrigatório): O novo conteúdo da nota.

#### Exemplo de Requisição:

```http
PUT /api/update.php
```

Corpo da requisição:

```json
{
  "id": 1,
  "title": "Título atualizado",
  "body": "Conteúdo atualizado"
}
```

#### Resposta:

Se a nota for encontrada e atualizada:

```json
{
  "result": [
    {
      "id": 1,
      "title": "Título atualizado",
      "body": "Conteúdo atualizado"
    }
  ],
  "error": ""
}
```

Se a nota não for encontrada:

```json
{
  "result": [],
  "error": "Unable to locate the note."
}
```

Se o ID, título ou corpo não forem fornecidos:

```json
{
  "result": [],
  "error": "To update a note, make sure you have sent a id, title and body."
}
```

Se o método HTTP não for `PUT`:

```json
{
  "result": [],
  "error": "Method not accepted. The expected method is: PUT."
}
```

---

### 6. Excluir uma nota

**Endpoint:** `delete.php`

```http
DELETE /api/delete.php
```

#### Parâmetros (enviados no corpo da requisição):

- `id` (obrigatório): O ID da nota que será deletada.

#### Exemplo de Requisição:

```json
{
  "id": 1
}
```

#### Resposta:

Se a nota for deletada com sucesso:

```json
{
  "result": "Deltated successfully.",
  "error": ""
}
```

Se a nota não for encontrada:

```json
{
  "result": "",
  "error": "Unable to locate the note."
}
```

Se o ID não for fornecido:

```json
{
  "result": "",
  "error": "Unable to delete, please provide an id."
}
```

Se o método HTTP não for `DELETE`:

```json
{
  "result": "",
  "error": "Method not accepted. The expected method is: DELETE."
}
```

## Configuração

### 1. Clonar o repositório

```bash
git clone https://github.com/ph-afonso/devnotes_api.git
```

### 2. Mover os arquivos para a pasta do servidor local

Coloque os arquivos do projeto na pasta do servidor local XAMPP. No Windows, a pasta padrão é:

```
C:\xampp\htdocs\devnotes_api
```

### 3. Configurar o banco de dados MySQL

1. Inicie o Apache e o MySQL através do painel de controle do XAMPP.
2. Acesse o `phpMyAdmin` pelo navegador em: `http://localhost/phpmyadmin`.
3. Crie um banco de dados chamado `devnotes`.
4. Importe o arquivo `utils/documents/devnotes.sql` para criar a tabela de notas.

### 4. Configuração do arquivo `config.php`

O arquivo `config.php` está configurado para conectar ao banco de dados com as seguintes informações:

```php
<?php 

// Configurações do banco de dados
$db_host = 'localhost';
$db_name = 'devnotes';
$db_user = 'root';
$db_pass = '';

//Array de Retorno padrão
$array = [
    'error' => '',
    'result' => []
];

try {
    // Criando uma nova instância de PDO com as configurações do banco de dados
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8",
        $db_user,
        $db_pass
    );

    // Configurando o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Exibindo uma mensagem de erro caso a conexão falhe
    $errorMensage = "Erro ao conectar com o banco de dados: " . $e->getMessage();
    $array['error'] = $errorMensage;
}

?>
```

### 5. Iniciar o Servidor

A API pode ser acessada no seguinte endereço após a configuração:

```
http://localhost/devnotes_api/api/
```

## Ferramentas de Teste

Você pode testar as requisições da API utilizando a ferramenta online [RestTestTest](https://resttesttest.com/), que é compatível com testes em servidores locais. Configure as requisições para o seu servidor local, por exemplo:

- **GET**: `http://localhost/devnotes_api/api/getall.php`
- **GET**: `http://localhost/devnotes_api/api/get.php?id=1`
- **POST**: `http://localhost/devnotes_api/api/insert.php`
- **PUT**: `http://localhost/devnotes_api/api/update.php`
- **DELETE**: `http://localhost/devnotes_api/api/delete.php`
- **GET**: `http://localhost/devnotes_api/api/ping.php` (Para verificar se a API está funcionando)

---

Se precisar de mais alguma coisa ou tiver dúvidas, é só me chamar!

---
