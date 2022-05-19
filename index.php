<?php session_start(); ?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/hw1.css">
    <link rel="stylesheet" href="/style/menu.css">
    <link rel="stylesheet" href="/style/fonts.css">
    <title>Home</title>
</head>
<body>
    <div id="div-instagram">
        <a href="https://www.instagram.com/artincocktail/" target="_blank"><img src="img/logo-instagram.png" alt="logo-instagram"></a>
    </div>
    <?php include("menu.php"); ?>
    <article>
            
        <header>
            <div id="container-header">
                <div id="text-box-header">
                    <h2>Home</h2>
                </div>
                <div id="overlay"></div>
                <img id="img-header" src="./img/img-header.png" alt="img-header">
            </div>
        </header>
        <br>
        <footer>
            <h3 class="Autore">
                Nome: Luca Merola 
                <br>
                Matricola: O46002231
                <?php
                    if(isset($error)){
                        foreach($error as $errore){
                            echo ("<p class=\"error\"> $errore</p>");
                        }                                
                    }
                ?>
            </h3>
        </footer>
    </article>

</body>
</html>
