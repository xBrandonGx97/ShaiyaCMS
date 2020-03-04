export function close_topic() {
    document.body.addEventListener("click", e => {
        if(e.target.closest(".close_topic")) {
            e.preventDefault();
            const curTrgt = document.querySelector(".close_topic");
            let isClosed = curTrgt.dataset.closed  === 'true';
            let container = document.body;
            console.log(typeof(isClosed));
            // Replace ./data.json with your JSON feed
            fetch('/resources/jquery/addons/ajax/site/forum/topic/close.topic.php', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    topicID: curTrgt.dataset.id,
                    action:    isClosed ? "open" : "closed"
                })
            })
            .then(r => r.json())
            /*.then(response => {
                return response.json()
            })*/
            .then(data => {
                // Work with JSON data here
                console.log(data);
                document.querySelector(".alert").style.display = "block";
                if (data.closed === 'false') {
                    curTrgt.dataset.closed = false;
                    document.querySelector(".close-text1").textContent = "Close Topic";
                    document.querySelector(".close-text2").textContent = "Close Topic";
                    document.querySelector(".close-text3").textContent = "Close Topic";
                    document.querySelector(".alert-text").textContent = "Topic has been opened successfully.";
                } else {
                    curTrgt.dataset.closed = true;
                    document.querySelector(".close-text1").textContent = "Open Topic";
                    document.querySelector(".close-text2").textContent = "Open Topic";
                    document.querySelector(".close-text3").textContent = "Open Topic";
                    document.querySelector(".alert-text").textContent = "Topic has been closed successfully.";
                }
                container.scrollIntoView({behavior: 'smooth'});
            })
            .catch(err => {
                // Do something for an error here
            })
        }
    });
}