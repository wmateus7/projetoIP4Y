1 - Executar
# php artisan migrate
# php artisan bd:seed

Usuários
# admin@projects.com
# senha:12345678

# user@projects.com
# 12345678

1 - O Eloquent ORM é um construtor que trabalha com os registros do banco de dados usando seus próprio métodos.
Sua vantagem é algo mais seguro, padronizado com a linguagem em um código limpo e uma desvantagem, (se pode dizer
desvantagem, é algo mais fechado, isto é, o iniciante terá de reaprender a sua consulta).
O Query Builder escrevemos consultas SQL. Cada um que inicia o desenvolvimento nesta área, se familiariza (INNER JOIN,
LEFT JOIN, etc...), porém, não é tão seguro quanto o Eloquent.

2 - 
2.1 Configuração HTTPS: Minha opinião, quase 50% já de segurança para transmissão dos dados
2.2 Autenticação em 2 fatore: Seja Dispositivos móveis ou e-mail
2.3 Minha opinião novamente, acho muito interessante o Middleware, quando possível, sempre inserindo
para deupurar e restringer acesso as rotas.

3 - Como se fosse um "segurança" confere a autorização do usuário que está acessando, por exemplo,
em uma rota de login, quero verificar se o usuário está logado ou não:
Route::group(['middleware' => 'auth'], function () {
    ***** ROTAS ****
})

4 - As migrations já facilitam para criação do banco de dados. Em um caso de fazer download do projeto
ou uma nova instalação, configurar as migrations com suas tabelas, chaves estrangeira, ao lado do seeders
criando registros fundamentais, a base de dados estará pronta para receber os dados entrados pelo sistema.
4.1-> criando uma migration
## php artisan make:mitrate nome-da-migration
4.2 ao gerar o arquivo em database/migration, inserindo os dados na função "up', por exemplo:
  # Schema::create('tasks', function (Blueprint $table) {
  #          $table->id();
  #          $table->string('title');
  #          $table->text('description');
  #          $table->foreignId('status_id')->constrained(('status'));
  #          $table->foreignId('project_id')->constrained(('projects'));
  #          $table->foreignId('user_id')->constrained(('users'));
  #          $table->date('expiredDate');
  #          $table->timestamps();
  #      });

5 - transaction monitora o processo que está sendo executado na controller, iniciando com segurança (begin)
e parando quando há algo errado (rollback) e finalizando com segurança (commit).

 O savepoint manipula as transações deixando (podemos dizer) um "ponto seguro" dentro do processo.