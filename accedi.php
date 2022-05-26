<?php
    include 'auth.php';
    if(!empty($_POST["email"]) && !empty($_POST["password"])){
        $conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']) or die (mysqli_error($conn));

        $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if(strlen($_POST["password"]) < 8) {
            $error[] = "La password deve avere più di 8 caratteri";
        }

        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $error[] = "Email non valida";
        }
        else{
            if(!isset($error)){
                $res = mysqli_query($conn, "SELECT nome FROM utenti WHERE email = '$email'");
                if(mysqli_num_rows($res) > 0){
                    $nome = mysqli_fetch_assoc($res)['nome'];
                    // email presente nel db
                    $res = mysqli_query($conn, "SELECT password FROM utenti WHERE email = '$email'");
                    //$error[]=$hashPasswordDB;
                    //$error[]=$hashPasswordInsered;
                    $hashPasswordDB=mysqli_fetch_assoc($res)['password'];
                    if(password_verify($password, $hashPasswordDB)){
                        session_destroy();
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["nome"] = $nome;
                        mysqli_close($conn);
                        header("Location: index.php");
                        exit;
                    }else{
                        $error[] = "Password errata!";
                    }
                }else{
                    $error[]= "Utente non esistente!";
                }
            }
            mysqli_close($conn);
        }
    }else if(isset($_POST["email"]) || isset($_POST["password"])){
        $error[] = "Riempi tutti i campi";
    }
?>

<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/menu2.css">
    <link rel="stylesheet" href="/style/fonts.css">
    <link rel="stylesheet" href="/style/accedi.css">
    <script src="/script/script-menu.js" defer="true"></script>
    <title>Accesso</title>
</head>
<body>
    <?php include("menu.php"); ?>
    <section id="contenuto">
        <div id="contenuto-header">
            <h2>Accesso</h2>
        </div>
        <div id="div-accesso">
            <form name="form-accesso" method="post">
                <p>
                    <label>E-mail <input type="text" name='email'></label>
                </p>
                <p>
                    <label>Password <input type="password" name='password'></label>
                </p>
                <p>
                    <label>&nbsp <input type="submit"></label>
                </p>
            </form>
        </div>
        <?php
            if(isset($error)){
                foreach($error as $errore){
                    echo ("<p class=\"error\"> $errore</p>");
                }                                
            }
            if(isset($notice)){
                foreach($notice as $note){
                    echo ("<p class=\"note\">$note</p>");
                }                                
            }
        ?>
    </section>
</body>
</html>