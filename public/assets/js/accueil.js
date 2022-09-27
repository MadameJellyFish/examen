let lastScrollY = window.scrollY


/* lastScrollY = window.scrollY */

/* Header scroll */

/* let navbars = document.querySelector('.navbar')
let header = document.querySelector('#header')



/* window.addEventListener('scroll', () => {
  if (lastScrollY  ) {
    header.classList.add('hidden')   
    console.log('test down')
  } else {
    header.classList.remove('hidden');
    console.log('test up')
  }

  
}) */

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
