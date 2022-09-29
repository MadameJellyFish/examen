// console.log('helooooo');
// alert('yooyoyoyoooyo');

let mainContainer = document.querySelector('#main-box');
let box = document.querySelector('#boite-comp');

//evenement wheel a 4 propriete dont deltaY (propriete de l'objet évènement) et obtenu par le parametre evt
// mainContainer.addEventListener("wheel", slide)
// function slide(evt){
//     evt.preventDefault();
//     mainContainer.scrollLeft +=evt.deltaY;
//     // scrollLeft pour faire un scroll horizontal, c'est une prpriéte du mainContainer
// }

mainContainer.addEventListener("wheel", (evt) => {
    evt.preventDefault();
    mainContainer.scrollLeft += evt.deltaY;
});

