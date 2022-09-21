## Teste Audaz

Teste de seleção da Audaz
## Instalação

1.  Clone o projeto

```shell
git clone https://github.com/KelwinJonas/audaz.git
```

2.  Gere os arquivos de dependências

```shell
composer install
```

3.  Configure o .env com os dados para o banco PostgreSQL

```shell
cp .env.example .env
```

4.  Crie as tabelas do banco de dados

```
php artisan migrate
```

5. Popule o banco de dados

```
php artisan db:seed
```

6. Inicie o sistema

```
php artisan serve
```
