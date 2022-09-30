let header = document.querySelector('#header')
let nav = document.querySelector('.navbar')
let lastScrollY = 0;

window.addEventListener('scroll', () => {
  {
    if (lastScrollY < window.scrollY) {

if(window.scrollY >= 500){
  nav.classList.add('hide');
}/* 
      header.classList.add('hidden')
      nav.classList.add("fixed");
         console.log('test down') */
    } else {
/*      header.classList.remove('hidden')
      nav.classList.remove("fixed");
          console.log('test up') */
    }
    lastScrollY = window.scrollY

  }
})

/* scrollY
console.log(scrollY) */

/* MENU DEROULANT */
let btnmenu = document.querySelector('.navbar-toggler')
let element = document.querySelector('#navbarNav')

btnmenu.addEventListener('click', navbar)
function navbar() {
  if (element.style.display == 'block') {
    element.style.display = 'none'
  } else {
    element.style.display = 'block'
  }
}
