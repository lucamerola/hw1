<?php
    include 'auth.php';
    header('Content-Type: application/json');
    if(!checkAuth()){
        $response=array();
        $response['error']=true;
        $response['errorType']="Non hai effettuato il login";
        echo json_encode($response);
        exit;
    }
    $conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']) or die (mysqli_error($conn));
    $email=$_SESSION['email'];
    $query="SELECT cod_drink FROM like_drink WHERE cod_utente = (SELECT id FROM utenti WHERE email='$email')";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) > 0){
        while($cod_drink = mysqli_fetch_assoc($res)['cod_drink']){
            
        }
    }