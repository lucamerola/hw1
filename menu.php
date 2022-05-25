<div id="total-menu">
    <nav id="nav-bar" class="hidden">
        <div id="div-close">
            <img src="img/cancel.png" alt="img-close-menu">
        </div>
        <div id="title">
            <a href="/"><h3>ArtInCocktail</h3></a>
        </div>
        <div id="menu-bar">
            <a href="/">Home</a>
            <a href="/preferiti.php">Preferiti</a>
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
                        $elements = "<a href='/accedi.php'>Accedi</a><a href='/registrazione.php'>Registrati</a>";
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

    <nav id="central-bar">
        <div id="div-open-menu">
            <img src="img/hamburger2.png" alt="img-hamburger">
        </div>
        <div id="title-central-bar">
            <a href="/"><h1>ArtInCocktail</h1></a>
        </div>
    </nav>
</div>