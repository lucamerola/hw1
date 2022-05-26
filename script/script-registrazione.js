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
    const pattern = /^[ a-z A-Z]{2,50}$/;
    if(!form.nome.value.match(pattern)){
        alert("Il nome deve essere composto dai 2 ai 50 caratteri a-z A-Z");
        event.preventDefault();
        return;
    }
    if(!form.cognome.value.match(pattern)){
        alert("Il cognome deve essere composto dai 2 ai 50 caratteri a-z A-Z");
        event.preventDefault();
        return;
    }
    pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if(!form.email.value.match(pattern)){
        alert("Inserisci una mail valida");
        event.preventDefault();
        return;
    }
    pattern = /^[ a-z A-Z 0-9]{8,100}$/;
    if(!form.password.value.match(pattern)){
        alert("La password deve contenere lettere maiuscole/minuscole e numeri, e deve essere composta dai 8 ai 100 caratteri");
        event.preventDefault();
        return;
    }
    if(form.password.value !== form.ripetiPassword.value){
        alert("Le password non corrispondono.");
        event.preventDefault();
        return;
    }
}