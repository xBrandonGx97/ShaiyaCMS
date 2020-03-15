export function acceptFriend() {
    document.body.addEventListener("click", e => {

        if(e.target.closest(".accept_friend")) {
            e.preventDefault();
            const curTrgt = document.querySelector(".accept_friend");

            fetch('/resources/themes/core/js/fetch/User/Friends/accept_friend_action.php', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: curTrgt.dataset.id,
                })
            })
            .then(r => r.text())
            .then(data => {
                console.log(data);
            })
            .catch(err => {
                // Do something for an error here
            })
        }
    });
}