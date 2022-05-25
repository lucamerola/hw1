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
    $my_drinks_like_list=array();
    if(mysqli_num_rows($res) > 0){
        while($cod_drink = mysqli_fetch_assoc($res)['cod_drink']){
            $url="https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=".$cod_drink;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result=curl_exec($ch);
            if ($result == false){
                $list_drinks_API['idDrink']=$cod_drink;
                $list_drinks_API['error']=true;
                $list_drinks_API['errorType']="cURL Error: ".curl_error($ch);
            }else{
                $list_drinks_API = json_decode($result, 1);
                $list_drinks_API=$list_drinks_API['drinks'][0];
                $list_drinks_API['like']=true;
                $my_drinks_like_list[]=$list_drinks_API;
            }
            curl_close($ch);
        }
    }
    mysqli_close($conn);
    echo json_encode($my_drinks_like_list);
    exit;
?>