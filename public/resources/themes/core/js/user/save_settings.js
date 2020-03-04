export function save_settings() {
    document.body.addEventListener("click", e => {
       if(e.target.closest("#save_changes_settings")) {
            e.preventDefault();

            const discord = document.querySelector('#discord').value;
            const usertitle = document.querySelector('#usertitle').value;
            const skype = document.querySelector('#skype').value;
            const steam = document.querySelector('#steam').value;

            fetch('/resources/jquery/addons/ajax/site/user/settings_submit.php', {
                method: 'post',
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    discord,
                    usertitle,
                    skype,
                    steam
                })
            })
           .then(r => r.text())
            .then(data => {
                document.querySelector("#response").innerHTML = data;
            })
            .catch(err => {

            })
       }
    });
}