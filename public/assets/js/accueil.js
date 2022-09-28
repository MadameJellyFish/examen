let header = document.querySelector('#header')
let nav = document.querySelector('.navbar')
let lastScrollY = 0;

window.addEventListener('scroll', () => {
  {
    if (lastScrollY < window.scrollY) {
      header.classList.add('hidden')
         console.log('test down')
    } else {
      header.classList.remove('hidden')
          console.log('test up')
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
