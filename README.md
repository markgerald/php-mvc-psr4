# Modelo PHP MVC PSR4

Projeto modelo de utilização da PSR4 para Autoload. Neste modelo, também há exemplos do conceito MVC em um sistema de login e um CRUD simples.

Exemplo de envio de email via smtp utilizando o *SwiftMailer*.

## Instalação ambiente Docker (PHP7.1 - MySQL 5.7)
- na pasta raiz do projeto, rodar comando "docker-compose up -d --build"
- Editar arquivo 'hosts' de sua máquina, incluindo o host "www.phpmvc.local" para o ip do docker(normalmente é 127.0.0.1).
- copiar arquivo .env-example como ".env". Editar informações a respeito de servidor de email(smtp). Não alterar os dados de banco de dados.
- acesse http://www.phpmvc.local:8081 em seu browser para verificar a aplicação.


PS: phpmyadmin rodando em http://localhost:8082 com user e pass do arquivo .env
