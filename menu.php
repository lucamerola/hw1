<div id="total-menu">

    <nav id="nav-bar">
        <div id="title">
            <a href="/"><h3>ArtInCocktail</h3></a>
        </div>
        <div id="menu-bar">
            <a href="/">Home</a>
            <a href="#">Ricette</a>
            <a href="#">Mixology</a>
            <a href="/top-5.php">Top 5</a>
            <a href="#">News</a>
            <a href="#">Contatti</a>
            <a href="/registrazione.php">Registrazione</a>
        </div>
        <div id="div-user">
            <div id="div-avatar">
                <img src="img/avatar.png" alt="img-avatar">
            </div>
            <div class="hidden" id="menu-tendina">
                <?php
                    require_once 'auth.php';
                    if(checkAuth()){
                        //sessione attiva
                        $elements = "<a href='/logout.php'>Logout</a>";
                    }
                    else{
                        $elements = "<a href='/registrazione.php'>Registrati</a>";
                    }
                    echo $elements;
                ?>
            </div>
        </div>
        <!--
        <div id="title">
            <a href="/"><h1>ArtInCocktail</h1></a>
        </div>-->
    </nav>

    <nav id="lateral-bar">
        ciao
    </nav>
</div>