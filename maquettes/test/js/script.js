// verification nom 

const validName = function (inputName) {

    let regexName = new RegExp(/^[a-z ,.'-]+$/i); 

    let span = document.getElementById("errorName");

    if (inputName.value == "") {
        span.innerHTML = "Nom requis";
        span.style.color = "red";
    } 
    else if (regexName.test(inputName.value)){
        span.innerHTML = "Nom ok";
        span.style.color = "green";
    }
    else {
        span.innerHTML = "Le nom ne doit contenir que des lettres";
        span.style.color = "red";
    }
};

// verification prenom 

const validPrenom = function (inputPrenom) {

    let regexPrenom = new RegExp(/^[a-z ,.'-]+$/i); 

    let span = document.getElementById("errorPrenom");

    if (inputPrenom.value == "") {
        span.innerHTML = "Prénom requis";
        span.style.color = "red";
    } 
    else if (regexPrenom.test(inputPrenom.value)){
        span.innerHTML = "Prénom ok";
        span.style.color = "green";
    }
    else {
        span.innerHTML = "Le prénom ne doit contenir que des lettres";
        span.style.color = "red";
    }
};

// Vérification du mail

const validMail = function (inputMail) {
    let regexMail = new RegExp(
      "^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$"
    );
  
    let span = document.getElementById("errorMail");
  
    if (regexMail.test(inputMail.value)) {
      span.innerHTML = "Adresse valide";
      span.style.color = "green";
    } else {
      span.innerHTML = "Adresse invalide";
      span.style.color = "red";
    }
  };
  
  // Vérification du mot de passe
  
  const validPassword = function (inputPassword) {
    let msg;
    let valid = false;
    if (inputPassword.value.length < 5) {
      msg = "Le mot de passe doit contenir au moins 5 caractères";
    } else if (!/[A-Z]/.test(inputPassword.value)) {
      msg = "Le mot de passe doit contenir au moins 1 majuscule";
    } else if (!/[a-z]/.test(inputPassword.value)) {
      msg = "Le mot de passe doit contenir au moins 1 miniscule";
    } else if (!/[0-9]/.test(inputPassword.value)) {
      msg = "Le mot de passe doit contenir au moins 1 chiffre";
    } else {
      msg = "Mot de passe valide";
      valid = true;
    }
    let span = document.getElementById("errorPassword");
  
    if (valid) {
      span.innerHTML = "Mot de passe valide";
      span.style.color = "green";
    } else {
      span.innerHTML = msg;
      span.style.color = "red";
    }
  };

function checkPass()
{
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password2');
    var message = document.getElementById('errorPassword2');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";

    if(pass1.value == pass2.value){
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "ok!"
    }
    else{
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = " These passwords don't match"
    }
}

let form = document.querySelector("#myForm");

form.nom.addEventListener("keyup", function () {
    validName(this);
});

form.prenom.addEventListener("keyup", function () {
    validPrenom(this);
});

form.mail.addEventListener("keyup", function () {
  validMail(this);
});

form.password.addEventListener("keyup", function () {
  validPassword(this);
});

// Vérification du mail

const validMail2 = function (inputMail) {
    let regexMail = new RegExp(
      "^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$"
    );
  
    let span = document.getElementById("errorMail2");
  
    if (regexMail.test(inputMail.value)) {
      span.innerHTML = "Adresse valide";
      span.style.color = "green";
    } else {
      span.innerHTML = "Adresse invalide";
      span.style.color = "red";
    }
  };
  
  // Vérification du mot de passe
  
  const validPassword3 = function (inputPassword) {
    let msg2;
    let valid2 = false;
    if (inputPassword.value.length < 5) {
      msg2 = "Le mot de passe doit contenir au moins 5 caractères";
    } else if (!/[A-Z]/.test(inputPassword.value)) {
      msg2 = "Le mot de passe doit contenir au moins 1 majuscule";
    } else if (!/[a-z]/.test(inputPassword.value)) {
      msg2 = "Le mot de passe doit contenir au moins 1 miniscule";
    } else if (!/[0-9]/.test(inputPassword.value)) {
      msg2 = "Le mot de passe doit contenir au moins 1 chiffre";
    } else {
      msg2 = "Mot de passe valide";
      valid2 = true;
    }
    let span = document.getElementById("errorPassword3");
  
    if (valid2) {
      span.innerHTML = "Mot de passe valide";
      span.style.color = "green";
    } else {
      span.innerHTML = msg2;
      span.style.color = "red";
    }
  };
let form2 = document.querySelector("#Form");

form2.mail2.addEventListener("keyup", function () {
    validMail2(this);
  });
  
  form2.password3.addEventListener("keyup", function () {
    validPassword3(this);
  });


function checkPassGardien() {
    if (document.getElementById("form1").gardien.value == "") {
        alert("Veuillez sélectionner un gardien");
    }

    else {
        alert("Vote valide");
    }
}

function checkPassJoueur() {
    if (document.getElementById("form").joueur.value == ""){
        alert("Veuillez sélectionner un joueur");
    }

    else {
        alert("Vote valide")
    }
}

 