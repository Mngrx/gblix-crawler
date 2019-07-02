# Avaliação de seleção para vaga de desenvolvedor PHP na Gblix

## Para executar o projeto

Será necessário ter os seguintes requisitos:
* PHP >= 7.1.3
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

Além do uso do 'composer' para instalar as dependências.

Abra o arquivo '.env' na pasta raiz do projeto e preencha os campos que estão vazios com informações sobre seu servidor mysql/mariadb. Se assegure de ter uma base da dados (database) chamada 'crawler' (pode alterar caso seja necessário).

Após isso, execute os seguintes comandos, na pasta raiz do projeto.

```
$ composer install
$ php artisan migrate
$ php artisan serve
```


E o sistema estará rodando.

### Alguns comando imporantes

* Para preencher o banco com informações fictícias
```
$ php artisan db:seed
```

* Para preencher o banco com informações advindas da API do Studio Ghibli
```
$ php artisan api:crawl
```

* Para executar o teste unitário que foi configurado
```
$ ./vendor/bin/phpunit
```

## Exemplos de requisições

Com a aplicação executando, pode-se fazer algumas requisições, abaixo segue alguns exemplos:

* GET /pessoas
* GET /pessoas?fmt=csv
* GET /pessoas?fmt=naoexiste
* GET /pessoas?fmt=html&order=nome_personagem&sort=asc
* GET /pessoas?order=pontuacao_filme&sort=asc&titulo_filme=2002&nome_personagem=Yuki
* GET /pessoas?order=ano_lancamento&sort=desc&pontuacao_filme=95,89

### Os parâmetros para rota pessoas

* fmt - formato do retorno (json, csv, html) - o padrão é json
* order - a coluna que deve ser ordenada
* sort - a sequência da ordenação (asc ou desc) - o padrão é asc
* nome_personagem - filtro para nome de personagem
* idade_personagem - filtro para idade de personagem
* titulo_filme - filtro para título de filme
* ano_lancamento - filtro para ano de lançamento
* pontuacao_filme - filtro para pontuação de filme

Obs: pode-se passar mais de um valor para ser pesquisado nos campos de filtro se separar cada valor por ','.

## Configurando o scheduling

Caso tenha o serviço de cron na sua máquina, é possível executar as schedules do Laravel de acordo com a programaçao delas. Os seguintes comandos, sendo executado na pasta raiz do projeto, irão programar o cron.

```
# echo "* * * * * ${USER} cd $(pwd) && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab  
# systemctl restart cron.service 
```

Obs: Caso queira executar o comando cron com um usuário diferente de 'root', altere '${USER}' pelo usuário desejado. No meu caso, ficou:

```
# echo "* * * * * igor cd $(pwd) && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab  
```

## Informações importantes

Estou usando o id retornado pela API para as relações, por ficar melhor de usar os dados que ela fornece e usar as relações já pré-estabelecidas. Porém, também dei id autoincremental para as tabelas por questão de "possibilidades futuras" e contabilidade.

Retirados os códigos de models, controllers e views que foram autogerados na criação do projeto laravel para deixar o código mais enxuto.

Utilizando 'Laracsv' para gerar csv e 'Guzzle' para requisições HTTP.
