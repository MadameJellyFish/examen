let btnModif = document.querySelector('#edit_utilisateur_submit');
let formModif = document.querySelector('.formModif');
let inputForm = [formModif[0], formModif[1], formModif[2], formModif[3], formModif[4],
formModif[5], formModif[6]];
console.log(inputForm)

btnModif.addEventListener('click', modifForm)

function modifForm(e) {
    e.preventDefault();
    let dataId = btnModif.getAttribute('data-id');

    if (dataId == "modifier") {
        btnModif.setAttribute('data-id', "valider");
        btnModif.textContent = "Valider";

        inputForm.forEach(element => {
            element.removeAttribute('disabled');
        });

    } else if (dataId == "valider") {
        btnModif.setAttribute('data-id', "modifier");
        btnModif.textContent = "Modifier mon profil";

        inputForm.forEach(element => {
            element.setAttribute('disabled', 'disabled');
        });

        fetch('/profil/edit', {
            method: "POST",
            headers: { 'content-type': 'Application/json' },
            body: JSON.stringify({
                'email': inputForm[0].value,
                'nom': inputForm[1].value,
                'prenom': inputForm[2].value,
                'date_day': inputForm[3].value,
                'date_month': inputForm[4].value,
                'date_year': inputForm[5].value,
                'telephone': inputForm[6].value,
            })
        })
            .then(function (res) {
                return res.json();
            }).then(function (data) {
                console.log(data)
            }).catch(function (error) {
                console.log(error);
            })
    }
}