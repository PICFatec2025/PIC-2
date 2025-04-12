<?php?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LoginScreen</title> <!--Nome do site alterado para ScreenLogin-->

        <link rel="preconnect" href="https://rsms.me/"> <!-- Preconectar a fonte-->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css"> <!--Conecta a fonte da letra exolhida e carrega na página web, permitindo ser chama no CSS -->

        <link rel="stylesheet" href="Tela.css"> <!--Link para os comandos e estilos do CSS-->
    </head>

    <body>       
            <div class="logo"> <!--Esse DIV representa o lugar onde o logo ficará-->
                <p>Logo</p>
            </div> 

            
                <form action="" method="post" class="form_login">
                    <div class="user">
                        <label for="user">Usuário</label>
                        <input type="text" name="user" id="user" required/>
                    </div>

                    <div class="password">
                        <label for="password">Senha</label>
                        <input type="number" name="password" id="password" required/>
                    </div>
                        <br>
                    <div class="button_submit">
                        <input type="submit" value="Entrar"/>
                    </div>
                </form>
    </body>

</html>