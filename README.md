# SISTEMA DE CONTROLE DE PEDIDOS - DiCasa Assados e Marmitaria

![logo do restaurante](https://github.com/PICFatec2025/PIC-2/blob/main/DiCasa/public/imgs/logo.png?raw=true)

### Sobre

Esse projeto foi criado como um Projeto Integrador do 2º semestre da Fatec de Indaiatuba. Feito por um grupo de 5 amigos, [ Filipe Puerta](https://github.com/FilipePuerta), [Lucas Brito](https://github.com/LucasBrito616), [Murilo Bioni Caruso](https://github.com/MuriTG25), [Willian Junges](https://github.com/WillianJunges) e [Yuri Matheus Lago Philomeno](https://github.com/ymlp).

Este projeto utiliza PHP com Laravel, além de HTML, CSS, Blade e Tailwind.

### O projeto

Este projeto é um controle de vendas e pedidos desenvolvido para o restaurante - DiCasa Assados e Marmitaria. O objetivo é facilitar o gerenciamento de clientes, pedidos, pratos e entregas, tanto para pedidos presenciais quanto para os feitos por telefone e Whatsapp.

Ele serve para automatizar o processo de registro de pedidos, agilizar o atendimento e fornecer controle das vendas do restaurante.

### As telas

- Tela de entrada - A primeira tela que aparece, que serve como boas vindas para o sistema. Caso o usuário esteja logado, ele vai para a tela principal, se não, ele vai para a tela de login.
- Tela de Login - Serve para o usuário fazer o login e acessar o sistema
- Tela de recuperação de senha - Caso o usuário esqueça a senha, temos o serviço de recuperação de senha.
- Tela principal - é a tela inical após o login, onde vemos os ultimos pedidos feitos, os pratos disponíveis de acordo com os dias da semana, a quantidade de marmitas vendidas, além da barra de navegação, que leva para as outras telas.
- Tela de cadastro de pedidos - tela onde vamos cadastrar um pedido, inserindo os dados do usuário, dos pratos pedidos, taxa de entrega, forma de pagamento e observação.
- Tela de consulta de pedidos - onde é mostrado os pedidos feitos, onde podemos, excluir, atualizar os status do pedido.
- Tela de vendas: onde podemos consultar os pedidos já realizados e entregues. Podemos consultar vendas mensais, vendas diárias, além de vendas por data. Tela apenas acessada pelo administrador.
- Tela de perfil: tela onde o usuário pode ver seus dados e fazer a alteração de senha.
- Tela de cadastro de usuário: tela onde apenas o administrador pode criar um usuário novo.

### Instruções

Ao abrir um projeto novo, para poder ter um usuário administrador e poder acessar o sistema completo é necessário que realize o comando para que se crie esse usuário:
```
php artisan db:seed
```
Ele gera um usuário padrão, no qual o email é:
```
adm@dicasa.com
```
E a senha é:
```
adm123123
```

