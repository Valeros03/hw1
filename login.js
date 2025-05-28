const errorPara = document.querySelector('#error-message');
const errorDiv = document.querySelector('#error');
const form = document.querySelector('#form-panel');


function validation(event){

if(form.username.value.length == 0 || form.password.value.length == 0){

    errorPara.textContent = "Riempire i campi del login";
    errorDiv.classList.remove('hidden');
    event.preventDefault();
}

}


form.addEventListener('submit', validation);
