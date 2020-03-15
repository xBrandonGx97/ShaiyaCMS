export function addFriend() {
    document.body.addEventListener("click", e => {

        if(e.target.closest(".add_friend")) {
            e.preventDefault();
            const curTrgt = document.querySelector(".add_friend");
            const user1 =   '';
            const user2 = '';

            fetch('/resources/themes/core/js/fetch/User/Friends/add_friend_action.php', {
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
                window.location.reload();
            })
            .catch(err => {
                // Do something for an error here
            })
        }
    });
}