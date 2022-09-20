let btnModif = document.querySelector('#modif_link');

btnModif.addEventListener('click', seeModifForm)

// Fonction SendComm utilisé pour l'event
function seeModifForm() {
    fetch('/profil/edit', {
        method: "POST",
        headers: { 'content-type': 'Application/json' },
        body: JSON.stringify({
            'content': content.value,
        })
    })
        .then(function (res) {
            return res.json();
        }).then(function (data) {
            nbComm.textContent = data.numberOfComm;

            let comment = document.createElement("p");
            comment.classList.add("js-comment");

            if (data.userRole.includes('ROLE_EDITOR',) || data.userRole.includes('ROLE_ADMIN') || data.currentUserUsername === data.user) {
                comment.innerHTML = "<div class='fw-bolder'>" + data.user + "<small class='ms-3'>" + data.createAt + "</small></div> <div>" + data.content + "</div>  <button class='btn btn-danger rounded-3 js-remove-comment' comment-id='{{ comment.id }}'>Delete</button>"
            } else {
                comment.innerHTML = "<div class='fw-bolder'>" + data.user + "<small class='ms-3'>" + data.createAt + "</small></div> <div>" + data.content + "</div>"
            }

            containerCom.prepend(comment);

            content.value = "";

            console.log(data)
        }).catch(function (error) {
            console.log(error);
        })
}