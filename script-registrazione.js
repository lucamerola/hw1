const form = document.forms['form-registrazione'];
form.addEventListener('submit', validazione);

function validazione(event) {
    if(form.nome.value.length == 0 ||
       form.cognome.value.length == 0 ||
       form.email.value.length == 0 ||
       form.password.value.length == 0 ||
       form.ripetiPassword.value.length == 0) 
    {
        // Avvisa utente
        // (meglio con div nascosto)
        alert("Compilare tutti i campi.");
        // Blocca l'invio del form
        event.preventDefault();
        return;
    }
    if(form.password.value.length<8){
        alert("Lunghezza password minima 8 caratteri.");
        event.preventDefault();
        return;
    }
    if(form.password.value !== form.ripetiPassword.value){
        alert("Le password non corrispondono.");
        event.preventDefault();
        return;
    }
}