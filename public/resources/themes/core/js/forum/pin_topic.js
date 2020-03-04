export function pin_topic() {
    document.body.addEventListener("click", e => {
       if(e.target.closest(".pin_topic")) {
            e.preventDefault();
            const curTrgt = document.querySelector(".pin_topic");
            let isPinned = curTrgt.dataset.pinned === 'true';
            let container = document.body;
            console.log(curTrgt.dataset.pinned);

            // Replace ./data.json with your JSON feed
            fetch('/resources/jquery/addons/ajax/site/forum/topic/pin.topic.php', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    topicID: curTrgt.dataset.id,
                    action:    isPinned ? "unpin" : "pin"
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
                if (data.pinned === 'false') {
                    curTrgt.dataset.pinned = false;
                    document.querySelector(".pin-text1").textContent = "Pin Topic";
                    document.querySelector(".pin-text2").textContent = "Pin Topic";
                    document.querySelector(".pin-text3").textContent = "Pin Topic";
                    document.querySelector(".alert-text").textContent = "Topic has been unpinned successfully.";
                } else {
                    curTrgt.dataset.pinned = true;
                    document.querySelector(".pin-text1").textContent = "Unpin Topic";
                    document.querySelector(".pin-text2").textContent = "Unpin Topic";
                    document.querySelector(".pin-text3").textContent = "Unpin Topic";
                    document.querySelector(".alert-text").textContent = "Topic has been pinned successfully..";
                }
                container.scrollIntoView({behavior: 'smooth'});
            })
            .catch(err => {
                // Do something for an error here
            })
        }
    });
}