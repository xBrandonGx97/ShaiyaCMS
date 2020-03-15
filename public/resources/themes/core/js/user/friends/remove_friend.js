export function removeFriend() {
    document.body.addEventListener("click", e => {

        if(e.target.closest(".remove_friend")) {
            e.preventDefault();
            const curTrgt = document.querySelector(".remove_friend");
            const user1 =   '';
            const user2 = '';

            fetch('/resources/themes/core/js/fetch/User/Friends/remove_friend_action.php', {
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