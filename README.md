
# API BRLIGHT   
  
### Tecnologias:  
- PHP 8.3+  
- Laravel/Sail Framework  
- Composer 2.0  
- MySQL  
  
  ### Requisitos:  
- PHP 8.3+  
- Laravel/Sail Framework  
- Composer 2.0  
- Docker compose
- API com autenticação

### Desenvolvimento utilizando::  
- TDD ( Desenvolvimento Orientado a Testes)  
- Unite Tests (com PHPUnit)  
  
# Descrição  
  
Um projeto de API simples construído para processo seletivo de desenvolvedor da BRLIGHT  .
  

# Como Configurar
#### Você vai precisar de:
PHP 8.3+
Composer
qualquer banco de dados SQL

    # Clonar este Repositório
    $ git clone <repository-url>
    $ cd brlight-app
    $ composer install

    # Certifique-se de adicionar suas variáveis de ambiente no arquivo .env
    $ cp .env.example .env

    # Rodar as migrações
    $ ./vendor/bin/sail artisan migrate:fresh

    # Iniciar o servidor
    $ ./vendor/bin/sail up -d



**Sistema de Registro e Autenticação**  
----  
Cria um novo usuário no sistema. 
  
**Registro de usuário**  

* **URL**  
  
 /api/register
  
* **Método:**  
  
 `POST`  
  
* **Método:** 

  **Parâmetros do Corpo:**  

  `name=[string]`
  `email=[string]`
  `password=[string]` (min 8 caracteres)

  * **Exemplo:** 
```JSON
{
  "name": "Jane Doe",
  "email": "jane.doe@example.com",
  "password": "password123"
}

```

* **Resposta:** 

Nenhum cabeçalho específico é necessário.

* **Cabeçalhos:** 

Autentica um usuário e retorna um token de acesso.

**Login**  

* **URL**  
  
 /api/login
  
* **Método:**  
  
 `POST`  
  
* **Método:** 

  **Parâmetros do Corpo:**  

  `email=[string]`
  `password=[string]` (min 8 caracteres)

  * **Exemplo:** 
```JSON
{
  "email": "jane.doe@example.com",
  "password": "password123"
}

```

* **Resposta:** 

Retorna token de autenticação.

* **Cabeçalhos:** 

Nenhum cabeçalho específico é necessário.

**Logout**  

* **URL**  
  
 /api/logout
  
* **Método:**  
  
 `POST`  
  
* **Método:** 

  **Cabeçalhos:**  

  `Authorization: Bearer {token}`
  

  * **Resposta:** 

Mensagem indicando que o logout foi efetuado com sucesso.




 **Operações com Clientes** 
----  
**Mostrar Clientes**

Retorna uma paginação em JSON com todos os clientes. 
  
* **URL**  
  
 /api/client
  
* **Método:**  
  
 `GET`  
 
**Adicionar clientes**  
----  
Adiciona um novo cliente no banco de dados.  
  
* **URL**  
  
  /api/client
  
* **Método:**  
  
 `POST`  
*  **Parâmetros do URL**  
 `name=[string]`  
 `phone=[string]`
 `cpf=[string]` 
 `car_plate=[string]`

 **Exemplo:**  
  
 ```JSON 
{
  "name": "John Doe",   
  "phone": "123-456-7890",
  "cpf": "123.456.789-00",
  "car_plate": "ABC-1234"
}
 
  ```
**Obter Cliente por ID**  
----  
  Retorna um cliente específico. 
  
* **URL**  
  
  /api/client/
  
* **Método:**  
  
 `GET`
* **Returns Example:**
```JSON
{
  "id": 1,

  "name": "John Doe",

  "phone": "123-456-7890",

  "cpf": "123.456.789-00",

  "car_plate": "ABC-1234",

  "created_at": "2024-07-19T14:52:50.000000Z",

  "updated_at": "2024-07-19T14:52:50.000000Z"
}
```

**Atualizar Cliente**  
----  
Atualiza as informações de um cliente.  
  
* **URL**  
  
  /api/client/
  
* **Método:**  
  
 `PUT` 
 *  **Parâmetros do URL**  
 `id=[integer]`  
 `name=[string]`
 `phone=[string]` 
 `cpf=[string]` 
 `car_plate=[string]` 
* **Exemplo:**

```JSON
{
  "name": "Jane Doe",
  "phone": "098-765-4321",
  "cpf": "987.654.321-00",
  "car_plate": "XYZ-9876"
}

```

**Deletar Cliente**
---
Remove um cliente do banco de dados.

* **URL**

  `/api/client/{id}`
  
* **Método:**

  `DELETE`
  
* **Parâmetros do URL:**

  `id=[integer]` - O ID do cliente que será deletado.

* **Resposta:**

  **Código de Status:** `204 No Content` - Indica que o cliente foi deletado com sucesso e não há conteúdo adicional a ser retornado.

**Exemplo de Requisição:**

```http
DELETE /api/client/1 HTTP/1.1
Host: example.com
Authorization: Bearer {token}
```
  
  **Consultar Cliente por Último Dígito da Placa**
---
Retorna os clientes cuja placa do carro termina com o dígito especificado.
* **URL**  
 
/api/client/checkfinalplate/

 * **Método:**  
  
 `GET` 
  
  **Parâmetros do URL:** 
  `numero=[integer]`  
  
  * **Exemplo de Retorno:**

```JSON
  {
    "id": 1,
    "name": "John Doe",
    "phone": "123-456-7890",
    "cpf": "123.456.789-00",
    "car_plate": "ABC-1234",
    "created_at": "2024-07-19T14:52:50.000000Z",
    "updated_at": "2024-07-19T14:52:50.000000Z"
  }

```