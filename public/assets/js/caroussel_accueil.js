// console.log('helooooo');
// alert('yooyoyoyoooyo');

let mainContainer = document.querySelector('#main-box');
let box = document.querySelector('#boite-comp');

mainContainer.addEventListener("wheel", (evt) => {
    evt.preventDefault();
    mainContainer.scrollLeft += evt.deltaY;
});


// box.addEventListener('wheel', slide)

// function slide(){
//     // mainContainer.style.overflow-x = 'scroll';
//     console.log(box);
// }