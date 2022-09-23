const questions = document.querySelectorAll(".question");

questions.forEach((question) => {
    question.addEventListener('click', toggleContent);
});

function toggleContent() {
    if (this.nextElementSibling.classList.contains('hide')) {
        this.nextElementSibling.classList.remove('hide');
    } else {
        this.nextElementSibling.classList.add('hide');
    }

    const arrow = this.querySelector('.arrow');
    console.log(arrow.classList.contains('arrow__down'))
    if (arrow.classList.contains('arrow__down')) {
        arrow.classList.remove('arrow__down');
        arrow.classList.add('arrow__up');
    } else {
        arrow.classList.remove('arrow__up');
        arrow.classList.add('arrow__down');
    }
};
