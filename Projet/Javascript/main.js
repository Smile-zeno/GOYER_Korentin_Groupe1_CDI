// Dark mode

// Nouvelle version qui sauvegarde
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

// Swiper
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 4,
  spaceBetween: 30,
  centeredSlides: true,
  loop: true,
  // pagination
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

// // Glight
// var lightboxDescription = GLightbox({
//   selector: '.glightbox',
// });

// lightboxDescription.on('close', () => {
//   lightboxDescription.reload()
// });

// function choose_button(clicked_id) {
//   //loop through same data-ids
//   document.querySelectorAll('[data-id="' + clicked_id + '"]').forEach(function(el) {
//     //change text
//     el.textContent = "button text changed"
//   })

// }