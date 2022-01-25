# Loft Game Challenge

[![Technology][php-image]][php-url]
[![Technology][lumen-image]][lumen-url]
[![Technology][redis-image]][redis-url]
[![Package][swagger-image]][swagger-url]
[![Technology][docker-image]][docker-url]

[php-url]: https://www.php.net/
[php-image]: https://img.shields.io/badge/PHP-blue?style=for-the-badge&logo=PHP&logoColor=white

[lumen-url]: https://lumen.laravel.com
[lumen-image]: https://img.shields.io/badge/Lumen-red?style=for-the-badge&logo=Laravel&logoColor=black

[nestjs-url]: https://nestjs.com
[nestjs-image]: https://img.shields.io/badge/nestjs-black?style=for-the-badge&logo=NestJS&logoColor=red

[swagger-url]: https://swagger.io/
[swagger-image]: https://img.shields.io/badge/Swagger-green?style=for-the-badge&logo=Swagger&logoColor=black

[docker-url]: https://www.docker.com/
[docker-image]: https://img.shields.io/badge/Docker-blue?style=for-the-badge&logo=Docker&logoColor=white

[redis-url]: https://redis.io/
[redis-image]: https://img.shields.io/badge/Redis-red?style=for-the-badge&logo=Redis&logoColor=white

[amazon-sqs-url]: https://aws.amazon.com/pt/sqs
[amazon-sqs-image]: https://img.shields.io/badge/amazon.sqs-yellow?style=for-the-badge&logo=amazon&logoColor=black

[jest-url]: https://jestjs.io/pt-BR/
[jest-image]: https://img.shields.io/badge/jest-red?style=for-the-badge&logo=jest&logoColor=black


# Requirements
 - [Docker](https://www.docker.com/)
 - [Docker Compose](https://docs.docker.com/compose)
 - PHP 8.1 (já está instalado no container)
 - Composer (já está instalado no container)

## About

Este projeto se baseia em uma API RESTful. A idéia do projeto é garantir que core do projeto que é um game não seja fortemente acoplado ao framework,
por isso foi optado por seguir alguns princípios de Clean Architecture. Foi escolhido o lumen como micro framework, a ideia é usar o mínimo possível
do framewok ou implementar abstrações para facilitar uma possível troca no futuro. Do lumen estamos usando módulos de rotas, injeção de dependencia,
handler de errors e seeders. Outro ponto importante é que toda regra de negócio é possível de ser testada através de suíte de testes unitário e de integração.

Seguindo o processo de setup por completo, serão criados dois personagens inicialmente, um chamado de php_app (warrior) e node_app (Mage), acredito que assim
já é possível testar os endpoints e ver algum resultado.

Para entender estrutura e organização da aplicação assista esse curto [vídeo](https://www.loom.com/share/ce5ee94267fa47109f17b5e09fc10d40).

## Setup

Existem dois scripts (shell) que auxiliam no setup da aplicação, para isso, primeiro
garanta que scripts do diretório `./bin` tenha direito de execução e depois rode esses comandos em sequência:

```shell
# preparando o ambiente (php, nginx e redis)
$ sh ./bin/run-env.sh

# em outra janela do terminal execute:
$ sh ./bin/config-env.sh
```
Executando os dois scripts, seu ambiente estará configurado para rodar a aplicação em desenvolvimento.

Caso queira fazer a setup manualmente, siga estes passos:

```shell
# cria rede
$ docker network create loft-network

# cria containers php, nginx e redis
$ docker-compose up -d

# instala dependências do projeto (framework + lib)
$ docker container exec loft-php composer install

# aplica permissões requeridas pelo framework
$ docker container exec loft-php chown -Rf www-data:www-data ./storage

# criar os personagens iniciais
docker container exec loft-php php artisan db:seed

```


## Accessing the API

Acesse: http://localhost:5555.

Documentação da API: http://localhost:5555/docs, você encontra no swagger todos os endpoints com os schemas de requests e responses.

![image info](./resources/img/swagger1.png)

## Techs

Essa aplicação foi projetada seguindo alguns princípios e techs, tais como:

- Clean Architeture
- SOLID
- RESTfull
- Object Calisthenics
- Repositories
- Unit Tests
- Integration Tests

A idéia de seguir princípios de clean Arch é poder desenvolver soluções que não fiquem acompladas a framework do momento ou amarrar a aplicação a complexidade de domínio técnico. Isso facilita a troca de techs do projeto, protegendo o domínio da aplicação. Em caso de mudanças de framework, ORM, Client HTTP, Banco de dados e etc, exigirá esforço apenas para implementar os contratos de infra (./src/Infra) enquanto as camadas de ./src/Domain e ./src/Aplication estão blindadas a mudanças de complexidades técnicas.
Outro benefício é possibilidade de testar todas às regras de negócio que ficam nos use cases.


## Tests

Existem pelo menos três formas de rodar os testes, sendo:

- Acessar o container do PHP e rodar `composer run tests`
- Em ambiente com docker e docker-composer `./bin/exec-test.sh`
