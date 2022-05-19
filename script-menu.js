var menu = document.querySelector("#div-user");
menu.addEventListener('click', mostra_tendina);

function mostra_tendina(event){
    var tendina = document.querySelector("#menu-tendina");
    tendina.classList.remove("hidden");
    var menu = document.querySelector("#div-user");
    menu.removeEventListener('click', mostra_tendina);
    menu.addEventListener('click', nascondi_tendina);
}

function nascondi_tendina(event){
    var tendina = document.querySelector("#menu-tendina");
    tendina.classList.add("hidden");
    var menu = document.querySelector("#div-user");
    menu.removeEventListener('click', nascondi_tendina);
    menu.addEventListener('click', mostra_tendina);
}