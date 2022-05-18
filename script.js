/*https://www.thecocktaildb.com/api.php*/
const apiKey_Cocktail = 1; // You can use the test API key "1" during development of your app or for educational use
const urlRequestCocktail = "https://www.thecocktaildb.com/api/json/v1/"+apiKey_Cocktail+"/search.php?s=" ;
const Top_5_Cocktail = ["Old fashioned", "Negroni", "Daiquiri", "Dry Martini", "Mojito"];
let cocktailList=[];

init();


function init(){
    ricerca_top_5_cocktail();
}

function onResponse(response) {
    //console.log('Success!');
    return response.json();
}

function onError(error) {
    console.log('Error' + error);
}

/*
Struttura di ogni scheda spotify

<div class="album">
    <img src="">
    <span>Titolo: </span>
    <span>Artista: </span>
    <a href="">Ascolta su Spotify</a>
</div>

*/


// ------------ Parte dei Cocktail ----------------
 
async function ricerca_top_5_cocktail(){
    let encoded_cocktail;
    for(let cocktail of Top_5_Cocktail){
        encoded_cocktail=encodeURIComponent(cocktail);
        // Faccio la richiesta
        await fetch(urlRequestCocktail+encoded_cocktail)
        .then(onResponse, onError)
        .then(onJsonCocktail);
    }
    aggiungiCocktail();
}

function onJsonCocktail(json){
    cocktailList.push(json);
}
/*
Struttura di ogni scheda cocktail

<div class="scheda" data-card-drink="">
    <div class="titolo-scheda">
        <h4> </h4>
    </div>
    <img class="img-scheda" src="" alt="">
    <div class="contenuto-scheda">
        <p>

        </p>
    </div>
</div>
*/

function aggiungiCocktail(){
    const lista_Schede = document.querySelector("#lista-schede");
    lista_Schede.innerHTML="";
    for(let i=0;i<cocktailList.length;i++){
        let div_scheda = document.createElement('div');
        div_scheda.classList="scheda";
        div_scheda.dataset.cardDrink=cocktailList[i].drinks[0].strDrink.replace(" ","_");
        let div_titolo_scheda = document.createElement('div');
        div_titolo_scheda.classList="titolo-scheda";
        let h4 = document.createElement('h4');
        h4.innerText=cocktailList[i].drinks[0].strDrink;
        let img = document.createElement('img');
        img.classList="img-scheda";
        img.src=cocktailList[i].drinks[0].strDrinkThumb;
        img.alt="img-"+(cocktailList[i].drinks[0].strDrink).replace(" ", "_");
        let div_contenuto = document.createElement('div');
        div_contenuto.classList="contenuto-scheda";
        let p = document.createElement('p');
        p.innerHTML="Ingredienti:<br>";
        for(let j=1;j<10;j++){ 
            if(eval("cocktailList[i].drinks[0].strIngredient"+j)!==null){
                p.innerHTML+=j+") "+eval("cocktailList[i].drinks[0].strIngredient"+j)+"<br>";
            }
        }

        div_contenuto.appendChild(p);
        div_titolo_scheda.appendChild(h4);
        div_scheda.appendChild(div_titolo_scheda);
        div_scheda.appendChild(img);
        div_scheda.appendChild(div_contenuto);
        lista_Schede.appendChild(div_scheda);
    }
}