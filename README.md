Model - app/Models
Controller - app/Http/Controllers
View - resources/views

Task - Tarefas (nome, feita?)

1. ...php artisan make:model -m Task
2. Editar migration (configuração da tabela)
3. ...php artisan migrate (cria as tabelas)
4. Editar o Model - configurar $fillable
5. ...php artisan make:controller -r TaskController
6. Editar o Controller - index, create, store
7. resources/views - task/create.blade.php
8. resources/views - task/index.blade.php
9. routes/web.php - Configurar o caminho/rota

Clone no repo do Github
1. composer install
2. npm install
