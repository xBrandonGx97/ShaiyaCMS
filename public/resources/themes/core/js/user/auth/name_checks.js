export function check_display() {
    document.body.addEventListener("click", e => {
       if (e.target.closest(".open_verify_displayname_modal")) {
            e.preventDefault();

            document.querySelector("#verify_displayname_modal #dynamic-content").innerHTML = '';
            document.querySelector("#verify_displayname_modal #modal-loader").style.display = "block";

            const DisplayName   =   document.querySelector('input[name="DisplayName"]').value;

            fetch('/resources/themes/core/js/fetch/User/auth/check_display.php', {
                method: 'post',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({
                    DisplayName
                })
            })
            .then(r => r.text())
            .then(data => {
                //console.log(data);
                document.querySelector("#verify_displayname_modal #dynamic-content").innerHTML = '';
                document.querySelector("#verify_displayname_modal #dynamic-content").innerHTML = data;
                document.querySelector("#verify_displayname_modal #modal-loader").style.display = "none";
            })
            .catch(err => {
                document.querySelector("#verify_displayname_modal #dynamic-content").innerHTML =
                    '<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...';
                document.querySelector("#verify_displayname_modal #modal-loader").style.display = "none";
            })
        }
    });
}