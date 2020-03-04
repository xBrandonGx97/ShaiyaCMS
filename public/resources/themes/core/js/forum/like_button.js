export function like_button() {
    document.body.addEventListener("click", e => {

        if(e.target.closest(".like-button")) {
            e.preventDefault();
            const curTrgt = document.querySelector(".like-button");
            let isLiked = curTrgt.dataset.liked === "true";
            console.log(isLiked);
            let postID  =   curTrgt.dataset.id;
            //console.log(curTrgt.dataset.liked);
            /*if(curTrgt.dataset.liked==='true') {
                curTrgt.dataset.liked = 'false';
                console.log("true");
            } else {
                curTrgt.dataset.liked = 'true';
                console.log("false");
            }*/

            // Replace ./data.json with your JSON feed
            fetch('/resources/jquery/addons/ajax/site/forum/post.like.php', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    postID,
                    uid:       curTrgt.dataset.uid,
                    action:    isLiked ? "unlike" : "like"
                })
            })
            .then(r => r.json())
            /*.then(response => {
                return response.json()
            })*/
            .then(data => {
                console.log(data);
                // Work with JSON data here
                //console.log(data.liked);
                document.querySelector(".post" + postID).prepend(data.errors);
                document.querySelector(".num" + postID).textContent = data.newCount;
                document.querySelector(".nk-forum-topic-author-likes" + postID).textContent = "Likes: " + data.newCount;
                if (data.liked === 'false') {
                    console.log("data false");
                    curTrgt.dataset.liked = false;
                    document.querySelector(".like-text" + postID).textContent = "Like";
                } else if (data.liked === 'true') {
                    console.log("data true");
                    curTrgt.dataset.liked = true;
                    document.querySelector(".like-text" + postID).textContent = "Unlike";
                } else {
                    console.log("error");
                }
            })
            .catch(err => {
                // Do something for an error here
            })
        }
    });
}