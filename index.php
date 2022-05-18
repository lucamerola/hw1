<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hw1.css">
    <link rel="stylesheet" href="menu.css">
    <script src="script.js" defer="true"></script>
    <title>Home</title>
</head>
<body>
    <div id="div_spotify">
        <form class="hidden">
            <div>
                <input id="track" type="text" value="">
                <input type="submit" value="cerca">
            </div>
        </form>
        <img src="https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg">
    </div>
    <?php include("menu.html"); ?>
    <article>
            
        <header>
            <div id="container-header">
                <div id="text-box-header">
                    <h2>Top 5 Cocktail</h2>
                </div>
                <div id="overlay"></div>
                <img id="img-header" src="./img/img-header.png" alt="img-header">
            </div>
        </header>


        <section>
            <div id="titolo-articolo">
                <h2>Quali sono i drink più bevuti al mondo?</h2>
            </div>

            <div id="lista-schede">
                <!-- qui vanno le schede-->
            </div>

        </section>
        <section >
            <div id="brani-spotify" class="hidden"></div>
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
