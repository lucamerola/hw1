<?php
    include 'auth.php';
    if(!checkAuth()){
        exit;
    }
    $idDrinkLike=$_GET['drinkId'];
    if(!$idDrinkLike){
        exit;
    }
    header('Content-Type: application/json');
    $conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']) or die (mysqli_error($conn));
    $email=$_SESSION['email'];
    $query="SELECT cod_drink FROM like_drink WHERE cod_utente = (SELECT id FROM utenti WHERE email='$email')";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) > 0){
        while($cod_drink = mysqli_fetch_assoc($res)['cod_drink']){
            if($cod_drink==$idDrinkLike){
                //allora devo togliere il like
                $query="DELETE FROM like_drink WHERE cod_utente=(SELECT id FROM utenti WHERE email='$email') AND cod_drink='$idDrinkLike'";
                $res = mysqli_query($conn, $query);
                if($res==true){
                    mysqli_close($conn);
                    $response=array();
                    $response['drinkId']=$idDrinkLike;
                    $response['like']=false;
                    echo json_encode($response);
                    exit;
                }
                else{
                    mysqli_close($conn);
                    $response=array();
                    $response['drinkId']=$idDrinkLike;
                    $response['error']=true;
                    echo json_encode($response);
                    exit;
                }
            }
        }
    }
    //se non l'ho trovato nel while o se non ha mai messo like a niente
    // metto ora il like
    $query="INSERT INTO like_drink(cod_utente, cod_drink) value ( (SELECT id FROM utenti WHERE email='$email'), '$idDrinkLike')";
    $res = mysqli_query($conn, $query);
    if($res==true){
        mysqli_close($conn);
        $response=array();
        $response['drinkId']=$idDrinkLike;
        $response['like']=true;
        echo json_encode($response);
        exit;
    }
    else{
        mysqli_close($conn);
        $response=array();
        $response['drinkId']=$idDrinkLike;
        $response['error']=true;
        echo json_encode($response);
        exit;
    }
?>