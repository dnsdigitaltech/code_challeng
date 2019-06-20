# Como configurar o sistema

#### Baixando o projeto
* Execute o git clone no seu local onde ficará o sistem ex: /www/html;
#### Atualizando o composer
* Acesse o terminal e execute, vá até o diretório do sistema e execute o composer para atualizar as dependências conforme o exemplo: `composer update`;
#### configurando a base de dados .env
* Após atualizar o composer, renomeie o arquivo `example.env` para `.env`. Crie sua base de dados, exemplo: `CREATE DATABASE db_name COLLATE utf8mb4_unicode_ci`, configure seu banco de dados no .env;
#### Instalando as Migrations
* No terminal do seu projeto execute o comando `php artisan migrate:fresh`, todas as tabelas serão criadas;
#### Executando o servidor
* Para executar o servidor ainda no terminal digite o comando `php artisan serve`;
* Aparecerá o seguinte log `<http://127.0.0.1:8000>`;
#### Acessando o sistema
* Para acessar o sistema basta digitar `http://localhost:8000/` no navegador, irá aparecer uma tela de login e senha, se for seu primeiro acesso clique em cadastrar;

### Para mais informações como usar o sistema [clique aqui](https://drive.google.com/file/d/1Ij9-r5J9q-UdTkzgoGmbuiB6ifIcSEKd/view)
