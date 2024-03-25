# Phonebook (Agenda Telefonica)

### Documentação Swagger

Acesse:
[http://localhost:9090/api/documentation](http://localhost:9090/api/documentation)

### Passo a passo

Clone Repositório

```sh
git clone https://github.com/trevvos/phonebook phonebook
```

```sh
cd phonebook
```

Crie o Arquivo .env

```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env

```dosini
APP_NAME="Phonebook"
APP_URL=http://localhost:9090

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

```

Suba os containers do projeto

```sh
docker-compose up -d
```

Acesse o container app

```sh
docker-compose exec app bash
```

Instale as dependências do projeto

```sh
composer install
```

Gere a key do projeto Laravel

```sh
php artisan key:generate
```

Acesse o projeto
[http://localhost:9090](http://localhost:9090)
