export function discord_modal() {
    document.body.addEventListener("click", e => {
        console.log(e.target);
        if (e.target.closest(".open_discord_modal")) {
            e.preventDefault();

            const curTrgt = e.target;
            const uid = curTrgt.dataset.id;

            document.querySelector("#discord_modal #dynamic-content").innerHTML = '';
            document.querySelector("#discord_modal #modal-loader").style.display = "block";

            fetch('/resources/jquery/addons/ajax/blade/init.forum_social_discord.php', {
                method: 'post',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({
                    id: uid
                })
            })
            .then(r => r.text())
            .then(data => {
                //console.log(data);
                document.querySelector("#discord_modal #dynamic-content").innerHTML = '';
                document.querySelector("#discord_modal #dynamic-content").innerHTML = data;
                document.querySelector("#discord_modal #modal-loader").style.display = "none";
            })
            .catch(err => {
                document.querySelector("#discord_modal #dynamic-content").innerHTML =
                    '<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...';
                document.querySelector("#discord_modal #modal-loader").style.display = "none";
            })
        }
    });
}