<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DiCasa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

        <style>
            /* Estilo base */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
                overflow: hidden;
                font-family: 'Inter', sans-serif;
                color: white;
                text-transform: uppercase;
            }
            
            /* Botões estilizados */
            .btn-action {
                display: inline-block;
                background-color: rgb(255, 203, 106);
                color: white !important;
                border: none;
                border-radius: 7px;
                padding: 10px 30px;
                font-weight: 700;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 1px;
                text-decoration: none;
                margin: 0 10px;
                cursor: pointer;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                transition: all 0.3s ease;
            }
            
            .btn-action:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 12px rgba(0,0,0,0.15);
                background-color: rgb(255, 193, 86);
            }
        </style>
    </head>
    <body style="display: flex; height: 100vh; width: 100vw; background-color: #FBAB16;">
        <!-- Coluna Esquerda (70%) -->
        <div style="width: 60%; height: 100%; display: flex; justify-content: center; align-items: center;">
            <div style="text-align: center; padding: 20px;">
                <img src="{{ asset('build/assets/logo.jpeg') }}" alt="LOGO DO SITE" style="max-width: 100%; max-height: 80vh; height: auto;" />
            </div>
        </div>

        <!-- Coluna Direita (30%) -->
        <div style="width: 40%; height: 100%; display: flex; justify-content: center; align-items: center;">
            <div style="text-align: center;">
                @if (Route::has('login'))
                    <nav style="display: flex; justify-content: center; align-items: center;">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-action">
                                ACESSAR PERFIL
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-action">
                                ENTRAR
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-action">
                                    CADASTRAR
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </body>
</html>