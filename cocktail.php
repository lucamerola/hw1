<?php
include 'auth.php';
$url="https://www.thecocktaildb.com/api/json/v1/1/filter.php?c=Cocktail";
header('Content-Type: application/json');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result=curl_exec($ch);
if ($result == false){
    die("Errore cURL: ".curl_error($ch));
}
curl_close($ch);
//echo ($result);
$list_drinks_API = json_decode($result, 1);
$list_drinks_API=$list_drinks_API['drinks'];
//echo json_encode($list_drinks_API['drinks']);

//voglio stampare SOLO i primi 12 cocktail che l'API mi torna, non tutti.
$my_drinks_List=array();
if(checkAuth()){
    //aggiungi_like_utente($list_drinks_API);
    //echo"";
    $conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']) or die (mysqli_error($conn));
    $email=$_SESSION['email'];
    $query="SELECT cod_drink FROM like_drink WHERE cod_utente = (SELECT id FROM utenti WHERE email='$email')";
    $res = mysqli_query($conn, $query);
    $drinks_code=array();
    if(mysqli_num_rows($res) > 0){
        while($cod_drink = mysqli_fetch_assoc($res)['cod_drink']){
            $drinks_code[]=$cod_drink;
        }
        mysqli_close($conn);
        for($i=0;$i<12;$i++){
            $maxJ=count($drinks_code);
            for($j=0;$j<$maxJ;$j++){
                if($drinks_code[$j]==$list_drinks_API[$i]['idDrink']){
                    $list_drinks_API[$i]['like']=true;
                }
            }
        }
    }else{
        mysqli_close($conn);
    }
}
for($i=0;$i<12;$i++){
    array_push($my_drinks_List, $list_drinks_API[$i]);
}
echo json_encode($my_drinks_List);
?>