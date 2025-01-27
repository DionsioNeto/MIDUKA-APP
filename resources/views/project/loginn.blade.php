<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        :root{
            --preto: #000;
            --bg: #131313;
            --branco: #fff;
            --link: #676262;
            --destaque: #6762623e;
            --vermelho: red;
            --hover-card: #a9a9b5;



        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui;
            color: var(--branco);
        }

        a, a *{
            color: var(--link);
        }

        a:hover,
        a *:hover{
            color: var(--preto);
        }

        hr{
            border: 1px solid var(--link);
        }

        body{
            background-color: black;
            width: 100vw;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }



        /*-----------------------------------*\
          #RESET
        \*-----------------------------------*/

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
                    box-sizing: border-box;
          }

          a { text-decoration: none; }

          li { list-style: none; }

          button {
            background: none;
            font: inherit;
            border: none;
            cursor: pointer;
          }

          img, ion-icon, button, a { display: block; }

          span { display: inline-block; }

          html {
            font-family: "Poppins", sans-serif;
            -ms-scroll-chaining: none;
            overscroll-behavior: contain;
          }

          input:not(input[type="checkbox"]) {
            display: block;
            width: 100%;
            font: inherit;
          }

          input::-webkit-input-placeholder { font: inherit; }

          input::-moz-placeholder { font: inherit; }

          input:-ms-input-placeholder { font: inherit; }

          input::-ms-input-placeholder { font: inherit; }

          input::placeholder { font: inherit; }

          body { background: var(--branco); }

          /**
           * scrollbar style
           */

          body::-webkit-scrollbar { width: 8px; }

          body::-webkit-scrollbar-track {
            background: var(--branco);
            border-left: 1px solid var(--link);
          }

          body::-webkit-scrollbar-thumb {
            background: hsl(0, 0%, 80%);
            border: 3px solid var(--white);
            -webkit-border-radius: 10px;
                    border-radius: 10px;
          }

          body::-webkit-scrollbar-thumb:hover { background: hsl(0, 0%, 70%); }

        main{
            display: flex;
            flex-direction: row;
            width: 90%;
            min-height: 80vh;
            color: #fff;
            border: 1px solid black;
            background-color: #242323;
            border-radius: 20px;
        }
        main div.image-login,
        main div.main-login{
            width: 100%;
            padding: 20px;
        }

        @media screen and (max-width: 800px) {
            main div.image-login{
                display: none;
            }
        }

        main div.main-login{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .image-login .img{
            overflow: hidden;
            width: 100%;
            height: 100%;
            border-radius: 10px
        }

        .image-login .img img{
            width: 100%;
            height: auto;
        }

        .colloun-input{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .row-input{
            display: flex;
            flex-direction: row;
            gap: 10px;
        }

        input:not(input[type="checkbox"]){
            border: none;
            padding: 10px;
            border-radius: 5px;
            background-color: #131313;
        }
        .checkbox{
            display: flex;
            flex-direction: row;
            gap: 5px;
        }
        .botao{
            background-color: #676262;
            width: 100%;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>


    <main>
        <div class="image-login">
            <div class="img">
                <img src="./imgs/tumdavala.jpg" alt="">
            </div>
        </div>

        <div class="main-login">
            <div class="header-login">
                <h2>Criar uma conta</h2>
                <span>Se já tiver uma conta pode só iniciar sessão.</span>
                <a href="/login">Iniciar sessão.</a>
            </div>
            <div class="colloun-input">
                <input type="text" placeholder="Digite o nome da sua página">
                <input type="email" placeholder="Digite um email válido">
            </div>
            <div class="row-input">
                <input type="password" placeholder="Crie uma palavra-passe">
                <input type="password" placeholder="Confirme sua palavra-passe">
            </div>
            <div class="checkbox">
                <input type="checkbox" name="termos" id="termos"><label for="termos">Aceito todos os <a href="/termos"> Termos & condições</a></label>

            </div>
            <div class="checkbox">
                <input type="checkbox" name="" id="lembrar"><label for="lembrar">Lembra-me (opcional)</label>
            </div>
            <button type="submit" class="botao">Criar uma conta</button>
            <h4>OU</h4>
            <div class="google-login">
                Login Com Google
            </div>
        </div>
    </main>



</body>
</html>


