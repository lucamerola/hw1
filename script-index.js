function onResponseJSON(response){
    return response.json();
}

function onJSON(json){
    const lista_cocktail = document.getElementById("lista-cocktail");
    lista_cocktail.innerHTML="";
    for(drink of json){
        let div_scheda = document.createElement('div');
        //console.log(drink);
        div_scheda.classList="scheda";
        div_scheda.dataset.cardDrink=drink.strDrink.replace(" ","_");
        div_scheda.dataset.cardId=drink.idDrink;
        let div_like = document.createElement('div');
        div_like.classList="div-like";
        let img_like = document.createElement('img');
        img_like.classList="img-like";
        img_like.alt="img-like";
        img_like.addEventListener('click', mettiTogliLike);
        if ("like" in drink){
            if(drink.like===true){
                img_like.src="/img/like.png";
            }
        }else{
            img_like.src="/img/dislike.png";
        }
       /* if(drink.like!==undefined && drink.like===true){
            
        }*/
        console.log(drink);
        let div_titolo_scheda = document.createElement('div');
        div_titolo_scheda.classList="titolo-scheda";
        let h4 = document.createElement('h4');
        h4.innerText=drink.strDrink;
        let img = document.createElement('img');
        img.classList="img-scheda";
        img.src=drink.strDrinkThumb;
        img.alt="img-"+(drink.strDrink).replace(" ", "_");

        div_titolo_scheda.appendChild(h4);
        div_like.appendChild(img_like);
        div_scheda.appendChild(div_titolo_scheda);
        div_scheda.appendChild(img);
        div_scheda.appendChild(div_like);
        lista_cocktail.appendChild(div_scheda);
    }
}

/*
Struttura di ogni scheda cocktail
<div class="scheda" data-card-drink="" data-card-id="">
    <div class="titolo-scheda">
        <h4> </h4>
    </div>
    <img class="img-scheda" src="" alt="">
    <div class="div-like">
        <img class="img-like" src="" alt="">
    </div>
</div>
*/

function onJSON_Like(json){
    if("error" in json){
        console.log(json.errorType);
        return;
    }
    const div_img_like = document.querySelector("[data-card-id='"+json.drinkId+"']");
    const img_like=div_img_like.childNodes[2].childNodes[0];
    if("like" in json){
        if(json.like===true){
            img_like.src="/img/like.png";
        }
        else{
            img_like.src="/img/dislike.png";
        }
    }
}

function mettiTogliLike(event){
    const drink_target = event.target.parentElement.parentElement.dataset.cardId;
    fetch("http://localhost/mettiTogliLike.php?drinkId="+drink_target).then(onResponseJSON).then(onJSON_Like);
}

fetch("http://localhost/cocktail.php").then(onResponseJSON).then(onJSON);