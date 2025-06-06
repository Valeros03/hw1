function checkUsername() {
    const input = document.querySelector('#username input');

    if(!/^[a-zA-Z0-9_]{1,16}$/.test(input.value)) {
        input.parentNode.querySelector('span').textContent = "L'username non può essere più lungo di 16 caratteri\nPuò contenere lettere maiuscole, minuscole, numeri e underscore";
        input.parentNode.classList.add('errorj');
        formStatus.username = false;

    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}


function jsonCheckUsername(json) {
    
    if (formStatus.username = !json.exists) {
        document.querySelector('#username').classList.remove('errorj');
        document.querySelector('#username span').textContent = "";

    } else {
        document.querySelector('#username span').textContent = "Nome utente già utilizzato";
        document.querySelector('#username').classList.add('errorj');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}


function checkSignup(event) {
    
    if (Object.keys(formStatus).length !== 5 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
    }
}
function checkName(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkPassword() {
    const passwordInput = document.querySelector('#password input');
    if (formStatus.password = !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(passwordInput.value)) {
        document.querySelector('#password').classList.add('errorj');
         passwordInput.parentElement.querySelector('span').textContent="La password deve contenere:\n-Almeno 8 caratteri\n-Una lettera maisucola\n-Una lettera maiuscola\n-Una cifra\n-Un carattere speciale";

    } else {
        document.querySelector('#password').classList.remove('errorj');
        passwordInput.parentElement.querySelector('span').textContent="";
    }

}

function checkBirth(){

    const birthInput = document.querySelector('#birth input');
    const dataInserita = new Date(birthInput.value)
    const currentDate = new Date();
    currentDate.setHours(0,0,0,0);
    if( dataInserita > currentDate){
        document.querySelector('#birth').classList.add('errorj');
        birthInput.parentElement.querySelector('span').textContent = "La data di nascita deve essere una data trascorsa";
    }else{
        document.querySelector('#birth').classList.remove('errorj');
        birthInput.parentElement.querySelector('span').textContent = "";
    }

}

function checkConfirmPassword() {
    const confirmPasswordInput = document.querySelector('#confirm_password input');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('#password input').value) {
        document.querySelector('#confirm_password').classList.remove('errorj');
    } else {
        document.querySelector('#confirm_password').classList.add('errorj');
        confirmPasswordInput.parentNode.querySelector('span').textContent = "Le password non coincidono";
    }
}

const formStatus = {'upload': true};

document.querySelector('#name input').addEventListener('blur', checkName);
document.querySelector('#username input').addEventListener('blur', checkUsername);
document.querySelector('#birth input').addEventListener('blur', checkBirth);
document.querySelector('#password input').addEventListener('blur', checkPassword);
document.querySelector('#confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('form').addEventListener('submit', checkSignup);