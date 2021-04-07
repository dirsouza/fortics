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
