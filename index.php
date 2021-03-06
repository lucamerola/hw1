<?php session_start(); ?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/hw1.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="/style/menu2.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="/style/fonts.css?v=<?php echo time();?>">
    <script src="/script/script-menu.js" defer="true"></script>
    <script src="/script/script-index.js" defer="true"></script>
    <title>Home</title>
</head>
<body>
    <div id="div-instagram">
        <a href="https://www.instagram.com/artincocktail/" target="_blank"><img src="img/logo-instagram.png" alt="logo-instagram"></a>
    </div>
    <?php include("menu.php"); ?>
    <article id="contenuto">
            
        <header>
            <div id="container-header">
                <div id="text-box-header">
                    <h2>Home</h2>
                </div>
                <div id="overlay"></div>
                <img id="img-header" src="./img/img-header.png" alt="img-header">
            </div>
        </header>
        <section>
            <div id="div-ricerca">
                <label>Ricerca <input type="text" id='ricerca'></label>
            </div>
            <div id="lista-cocktail-ricercati" class="hidden">

            </div>
            <div id="lista-cocktail" class="visible-flex">
                
            </div>
        </section>
        <br>
        <footer>
            <h3 class="Autore">
                Nome: Luca Merola 
                <br>
                Matricola: O46002231
            </h3>
        </footer>
    </article>

</body>
</html>
