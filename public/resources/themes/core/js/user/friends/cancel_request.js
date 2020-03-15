export function cancelRequest() {
    document.body.addEventListener("click", e => {

        if(e.target.closest(".cancel_request")) {
            e.preventDefault();
            const curTrgt = document.querySelector(".cancel_request");

            fetch('/resources/themes/core/js/fetch/User/Friends/cancel_request_Action.php', {
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