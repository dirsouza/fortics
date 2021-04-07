# Desafio Back-end Developer Fortics

## Sobre o desafio
[Link](https://github.com/brunoferreiras/fortics-challenges/blob/master/backend-developer.md) de acesso a descrição do desafio.

## Principais tecnologias aplicadas nos projetos
|             |Versão |Link                                           |
|-------------|-------|-----------------------------------------------|
|Docker       |20.10.5|https://docs.docker.com/engine/install/ubuntu/ |
|Laravel      |6.x    |https://laravel.com/docs/6.x                   |
|Typescript   |4.2.3  |https://www.typescriptlang.org/                |
|Telegraf     |4.3.0  |https://telegraf.js.org/                       |
|MySQL        |5.7    |https://www.mysql.com/                         |
|Nginx        |1.15.0 |https://www.nginx.com/                         |

> Os projetos estão dockerizados e as instruções a seguir, levam em consideração que, o [Docker](https://docs.docker.com/engine/install/ubuntu/
) e [Docker Compose](https://docs.docker.com/compose/install/) já encontram-se 
> devidamente instalados e em versão com suporte a versão 3 do docker-compose.yml.

## Como executar os projetos
### - API
Não se faz necessário intervenção direta no projeto da API, uma vez que ao executar os comandos do docker, as 
configurações do ambiente já serão feitas.
> Na raiz do projeto, será possível encontrar um arquivo chamado `DocRESTful.json`, esse *json* pode ser importado 
> em clientes REST como [Postman](https://www.postman.com/product/rest-client/), [Insomnia](https://insomnia.rest/) 
> entre outros.

### - Chatbot Telegram
Para esse projeto, é necessário a criação de um bot no telegram e que o token gerado, seja adicionado no `.env` na 
propriedade **BOT_TOKEN**, para isso, faça um cópia do `.env.example` renomeando para `.env`, e adicione o token na 
propriedade indicada.
> [Link](https://core.telegram.org/bots) de introdução e criação de bots no telegram.

## Docker
- Build dos projetos:
  Dentro da raiz do projeto após o clone desse repositório, e feito o descrito em **Chatbot Telegram**, execute o 
  comando abaixo no terminal.
   ```bash
   docker-compose up --build
   ```

### - Testando os projetos
- API: é possível testar a API via cliente REST através da url `http://localhost:8080/api/v1` e completando com as 
  devidas rotas, que são:
  - [ GET    ] /sessions
    > Essa rota retorna todas conversão cadastradas e ainda é possível fazer um filtro nome de uma pessoa, passando 
      a propriedade `name` como *query params*.
    >
    > Exemplos: `http://localhost:8080/api/v1/sessions` ou `http://localhost:8080/api/v1/sessions?name=fulano`
  - [ POST   ] /sessions
    > Essa rota tem por objetivo o cadastro de conversa, e para que o cadastro ocorra, os dados obrigatórios devem 
      serem enviados via **body**.
    > 
    > Exemplo: `http://localhost:8080/api/v1/sessions`
    > ```json
    > # body
    > {
    >     "name": "Fulano de Tal",
    >     "platform_type": "Insomnia",
    >     "contact_identifier": 987654321,
    >     "message": "Teste de envio de mensagem 1"
    > }
    > ```
  - [ DELETE ] /sessions/{identifier}
    > Essa rota tem por objetivo excluir uma conversa passando por parâmetro o código identificador do usuário.
    > 
    > Exemplo: `http://localhost:8080/api/v1/sessions/987654321`
  - [ POST   ] /sessions/upload
    > Essa rota tem por objetivo importar uma lista de convesas no padrão esperado e cadastrar na aplicação.
      E por se tratar de um arquivo, o **header** deve ser um `Content-Type: multipart/form-data`, e o arquivo deve 
      ser enviado por meio de um `Multipart Form`, tendo como atributo o `file`.

- Chatbot: No chat via telegram, o bot somente irá cadastrar a mensagem enviada, respondendo se a mensagem foi ou 
  não recebida. Para testar, basta escrever qualquer coisa para o bot.
