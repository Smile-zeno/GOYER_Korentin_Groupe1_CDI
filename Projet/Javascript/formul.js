// Mode Sombre
let themeSauvegarder = localStorage.getItem("theme");

if (themeSauvegarder === "sombre") {
    document.documentElement.classList.add("dark");
}

function toggleTheme() {
    document.documentElement.classList.toggle("dark");

    if (document.documentElement.classList.contains("dark")) {
        localStorage.setItem("theme", "sombre");
    } else {   
        localStorage.setItem("theme", "claire");
    }
}

// Menu Burger
const menu = document.querySelector(".menu");
const menuItems = document.querySelectorAll(".menuItem");
const hamburger= document.querySelector(".hamburger");
const closeIcon= document.querySelector(".closeIcon");
const menuIcon = document.querySelector(".menuIcon");

function toggleMenu() {
  if (menu.classList.contains("showMenu")) {
    menu.classList.remove("showMenu");
    closeIcon.style.display = "none";
    menuIcon.style.display = "block";
  } else {
    menu.classList.add("showMenu");
    closeIcon.style.display = "block";
    menuIcon.style.display = "none";
  }
}

hamburger.addEventListener('click', toggleMenu);

menuItems.forEach( 

  function(menuItem) { 

    menuItem.addEventListener('click', toggleMenu);

  }

)

// Formulaire
let form = document.querySelector('form');

form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Vérification pour le formulaire

    let errorContainer = document.querySelector('.message-error');
    let errorList = document.querySelector('.error-list');

    // Enlever les anciens messages d'erreur
    let Liste = errorList.childElementCount

    if (Liste > 0) {
        for (let i = 0; i < Liste; i++) {
            let el = document.getElementById("error-name");
            el.remove();
        }
    }

    // Vérification Email

    let email = document.querySelector('#email');

    if (email.value == '') {
        errorContainer.classList.add('visible');
        email.classList.remove('success');

        let err = document.createElement('li');
        err.id = "error-name";
        err.innerText = "Le champ email doit contenir un email existant";

        errorList.appendChild(err);
    } else {
        email.classList.add('success');
    }

    // Vérification Pseudo

    let pseudo = document.querySelector('#pseudo');

    if (pseudo.value.length < 6) {
        errorContainer.classList.add('visible');
        pseudo.classList.remove('success');

        let err = document.createElement('li');
        err.id = "error-name";
        err.innerText = "Le champ pseudo doit contenir au moins 6 caractères"

        errorList.appendChild(err);
    } else {
        pseudo.classList.add('success');
    }

    // Vérification Mot de passe

    let password = document.querySelector('#password');

    let passCheck = new RegExp(
        "^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-+_!@#$%^&*.,?]).+$"
    );

    if (password.value.length < 10 || passCheck.test(password.value) == false) {
        errorContainer.classList.add('visible');
        password.classList.remove('success');

        let err = document.createElement('li');
        err.id = "error-name";
        err.innerText = 'Le mot de passe doit faire 10 caractères minimum, contenir minuscule, majuscule, chiffre, caractères spécial'

        errorList.appendChild(err);
    } else {
        password.classList.add('success');
    }

    // Vérification Deuxième mot de passe

    let passwordRepeat = document.querySelector('#password2');

    if (passwordRepeat.value !== password.value || passwordRepeat.value === '') {
        errorContainer.classList.add('visible');
        passwordRepeat.classList.remove('success');

        let err = document.createElement('li');
        err.id = "error-name";
        err.innerText = 'Le mot de passe doit être le même dans les deux cases'

        errorList.appendChild(err);
    } else {
        passwordRepeat.classList.add('success');
    }

    // Vérification qu'un choix a été faix dans le select

    let selector = document.querySelectorAll('.choixFilm input[type=checkbox]');
    let selection = 0;
    let boxChecked = false

    selector.forEach(ckbox => {
        if (ckbox.checked) {
            ckbox.classList.add('success');
            selection += 1
            // console.log(ckbox + 'is checked')
        } else {

            ckbox.classList.remove('success');
            // console.log(ckbox + 'is not checked')
        }
    });

    // on vérifie qu'aux moins une case soit coché

    if (selection <= 0) {
        errorContainer.classList.add('visible');

        let err = document.createElement('li');
        err.id = "error-name";
        err.innerText = 'Cocher une case indiquant votre type de film préféré'
        
        let boxChecked = false

        errorList.appendChild(err);
    } else {
        // pour obliger a cocher une case pour 'envoyer' le formulaire
        boxChecked = true;
    }

    // Vérification finale pour afficher le 'Success'

    let successContainer = document.querySelector('.message-success');
    successContainer.classList.remove('visible');
    console.log(errorList.children);

    if (pseudo.classList.contains('success') && 
        email.classList.contains('success') && 
        password.classList.contains('success') && 
        passwordRepeat.classList.contains('success') &&
        boxChecked == true)
        {
        errorContainer.classList.remove('visible');
        successContainer.classList.add('visible');
    }
});

