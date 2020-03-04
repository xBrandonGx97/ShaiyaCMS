export function reply_submit() {
    document.body.addEventListener("click", e => {
        if(e.target.closest("#reply_submit")) {
            e.preventDefault();

            const postbody = document.querySelector('#content').value;
            const topicid = document.querySelector('#topicid').value;
            const postauthor = document.querySelector('#postauthor').value;

            fetch('/resources/jquery/addons/ajax/site/forum/reply.submit.php', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    sent: 1,
                    topicid,
                    postbody,
                    postauthor
                })
            })
            .then(r => r.json())
            .then(data => {
                console.log(data);
                if(data.finished==='true') {
                    window.location.reload();
                } else {
                    data.errors.forEach((error) => {
                        //console.log(error);
                        document.querySelector("#response").innerHTML = error
                    })
                }
            })
            .catch(err => {

            })
        }
    });
}