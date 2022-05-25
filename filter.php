<?php
include 'auth.php';
header('Content-Type: application/json');
if(!isset($_GET['f']) || empty($_GET['f']) ){
    $response=array();
    $response['error']=true;
    $response['errorType']="Non è presente il nome da filtrare";
    echo json_encode($response);
    exit;
}
$filtro=$_GET['f'];
$url="https://www.thecocktaildb.com/api/json/v1/1/search.php?f=".$filtro[0];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result=curl_exec($ch);
if ($result == false){
    $response=array();
    $response['error']=true;
    $response['errorType']="cURL Error: ".curl_error($ch);
    echo json_encode($response);
    exit;
}
curl_close($ch);
$list_cocktail_to_filter=array();
$list_drinks_API = json_decode($result, 1);
$list_drinks_API=$list_drinks_API['drinks'];
$max_cocktail = count($list_drinks_API);
if($max_cocktail>12){
    $max_cocktail=12; //voglio stamparne solo 12
}
for($i=0;$i<$max_cocktail;$i++){
    if(strpos(strtolower($list_drinks_API[$i]['strDrink']), $filtro)!==false){
        $list_cocktail_to_filter[]=$list_drinks_API[$i];
    }
}

//aggiungo i like che l'utente ha messo nei vari drink
if(checkAuth()){
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
        $maxI=count($list_cocktail_to_filter);
        for($i=0;$i<$maxI;$i++){
            $maxJ=count($drinks_code);
            for($j=0;$j<$maxJ;$j++){
                if($drinks_code[$j]==$list_cocktail_to_filter[$i]['idDrink']){
                    $list_cocktail_to_filter[$i]['like']=true;
                }
            }
        }
    }else{
        mysqli_close($conn);
    }
}
echo(json_encode($list_cocktail_to_filter));
?>