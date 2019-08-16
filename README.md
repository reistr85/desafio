![CSCore Logo](http://mgetech.com.br/projetos/desafio/logo3.png)
* Este README tem por objetivo passar todas as orientação para colocar o projeto em funcionamento.

### O PROJETO ###

* Este projeto foi desenvolvido com a finalidade de mostrar os conhecimentos técnicos do Dev. sobre as tecnologias empregadas.
* As implementações disponíveis no projeto são:
* 1 - Listar todos os usuários.
* 2 - Visualizar um determinado usuário selecionado.
* 3 - Editar um determinado usuário selecionado.
* 4 - Deletar um determinado usuário selecionado.

### TECONOLOGIAS EMPRESAGAS ###

* O projeto foi construido em PHP ultilizando o Framework Laravel como recurse de Banckend e o Vue JS para o Frontend.

### INSTALAÇÃO ###

* 1 - Faça o Clone deste repositório: (https://reistr@bitbucket.org/reistr/desafio-esig.git)
* 2 - Rode os seguintes comandos no seu terminal:
* 2.1 - composer install
* 2.2 - npm install
* 2.3 - php artisan key:gerenate

### DATABASE ###

* Crie o DB e configure o arquivo .env com as configurações do seu DB.
* Este projeto faz o uso do Eloquent ORM com isso você tem a opção de usar o DB de sua preferência.
* Após criado e configurado o DB no projeto rode o seguinte comando no seu terminal:
* 1 - php artisan migrate

### RUN EM DESENVOLVMENTO ###

* Configure em sua máquina local o seguite host para rodar o projeto:
* http://desafio.test/ e faça o apontamento para o projeto em sua máquina.
* Caso queira usar outro HOST de sua preferência altere as URL's das chamadas 'Axios' para o HOST de sua preferência.

### API EM LARAVEL ###

* O projeto dispões de duas routers http://seuhost/api/users
* http://seuhost/api/todo e http://seuhost/api/users
* Abaixo segue a lista das requições que são possíveis fazer para ambas as routers. Iremos abaixo detalhar apenas para uma das routers já que não há necessidade de detalhar as duas sendo que ambas tem os mesmos endpoints.
* Foi criado um Controller "App\Controller\UsersController.php" do tipo Resource onde o mesmo tem os seguintes Methods:
* 1 - Nome: index:
* 1.1 - Tipo de Chamada: GET
* 1.2 - Função: Responsável foi trazer a lista de todos os usuários cadastrados no projeto.
* 1.3 - Retorno: Lista dos usuários em JSON.
* 2 - Nome: store:
* 2.1 - Tipo de Chamada: POST
* 3.2 - Parâmetro: Request.
* 2.3 - Função: Responsável foi fazer a pesistência dos dados no DB do projeto.
* 2.4 - Retorno: User cadastrado em JSON.
* 3 - Nome: show:
* 3.1 - Tipo de Chamada: GET
* 3.2 - Parâmetro: ID do User.
* 3.3 - Função: Responsável por lista o determinado User.
* 3.4 - Retorno: User em JSON.
* 4 - Nome: edit:
* 4.1 - Tipo de Chamada: GET
* 4.2 - Parâmetro: ID do User.
* 4.3 - Função: Responsável por lista o determinado User para a sya Edição.
* 4.4 - Retorno: User em JSON.
* 5 - Nome: update:
* 5.1 - Tipo de Chamada: PUT
* 5.2 - Parâmetro: Request, ID do User.
* 5.3 - Função: Responsável por fazer a Edição de um determinado User.
* 5.4 - Retorno: User em JSON.
* 6 - Nome: destroy:
* 6.1 - Tipo de Chamada: DELETE
* 6.2 - Parâmetro: ID do User.
* 6.3 - Função: Responsável por excluir um determinado User do DB.
* 6.4 - Retorno: User em JSON.

### LICENSE ###

[MIT](http://opensource.org/licenses/MIT)

Copyright (c) 2019-present, Renan Reis