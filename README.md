## Passo a passo

- Antes tudo, crie um banco de dados com o nome "padariamirante".
- Em seguida, clone esse repositório e rode os comandos: "npm install" e "php artisan migrate:fresh --seed"
- Para iniciar o servidor: "php artisan serve".

## Sobre o projeto

- Na pasta "App\Http\Controllers" estão as funções utilizadas para se comunicar com o banco de dados e com as views.
- Em "App\Models" está uma representação de cada entidade do banco de dados, e também estão definidos os relacionamentos entre cada uma delas.
- Já em "Resources\Views" estão os códigos de cada uma das páginas.

- Existem dois tipos de usuários: administrador e cliente.
- Para utilizar a conta de administrador utilize o usuário admin@admin.com e a senha admin123admin.
