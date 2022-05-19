<?php
    include 'auth.php';
    /*if(checkAuth()){
        header("Location: index.php");
        exit;
    }*/
    if(!empty($_POST["nome"]) && !empty($_POST["cognome"]) && 
    !empty($_POST["email"]) && !empty($_POST["password"]) && 
    !empty($_POST["ripetiPassword"])){
        $conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']) or die (mysqli_error($conn));

        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
        $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $ripetipassword = mysqli_real_escape_string($conn, $_POST['ripetiPassword']);
        if(strlen($_POST["password"]) < 8) {
            $error[] = "La password deve avere più di 8 caratteri";
        }

        if(strcmp($_POST["password"], $_POST["ripetiPassword"]) !=0){
            $error[] = "Le password non coincidono";
        }

        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $error[] = "Email non valida";
        }
        else{
            $res = mysqli_query($conn, "SELECT email FROM utenti WHERE email = '$email'");
            if(mysqli_num_rows($res) > 0){
                $error[] = "Email già in uso";               
            }
        }
        if(!isset($error)){
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO utenti (id, nome, cognome, email, password) VALUES (null, '$nome', '$cognome', '$email', '$password')";
            if(mysqli_query($conn, $query)){
                $_SESSION["email"] = $email;
                $_SESSION["nome"] = $nome;
                mysqli_close($conn);
                header("Location: index.php");
                exit;
            }
            else{
                $error[] = "Errore di connessione al server"; 
                echo "<h2>Errore</h2>";
            }
        }
        mysqli_close($conn);
    }else if(isset($_POST["email"])){
        $error[] = "Riempi tutti i campi";
    }
?>

<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/menu2.css">
    <link rel="stylesheet" href="/style/registrazione.css">
    <link rel="stylesheet" href="/style/fonts.css">
    <script src="script-registrazione.js" defer="true"></script>
    <script src="script-menu.js" defer="true"></script>
    <title>Registrazione</title>
</head>
<body>
    <?php include("menu.php"); ?>
    <section>
        <div id="div-registrazione">
            <form name="form-registrazione" method="post">
                <p>
                    <label>Nome <input type="text" name='nome'></label>
                </p>
                <p>
                    <label>Cognome <input type="text" name='cognome'></label>
                </p>
                <p>
                    <label>E-mail <input type="text" name='email'></label>
                </p>
                <p>
                    <label>Password <input type="password" name='password'></label>
                </p>
                <p>
                    <label>Ripeti Password <input type="password" name='ripetiPassword'></label>
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