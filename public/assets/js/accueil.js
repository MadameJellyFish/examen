let nav = document.querySelector('.navbar');
let header = document.querySelector('#header');
let lastScrollY = window.scrollY; 
/* console.log(header); */
window.addEventListener('scroll', () => {
  if (
       lastScrollY < window.scrollY) {
    header.classList.add('hide')
    console.log('test down')
  } else {
    header.classList.remove('hide')
    console.log('test up')
  }

  lastScrollY = window.scrollY
})

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
