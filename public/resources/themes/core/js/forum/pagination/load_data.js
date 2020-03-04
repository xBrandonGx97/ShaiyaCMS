export function load_data(page) {
    var uid = document.querySelector('#pagination_data').dataset.id;
    //console.log(uid)

    fetch("/resources/jquery/addons/ajax/blade/init.view_topic_pagination.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: JSON.stringify({
            page: page,
            id: uid,
        })
    })
    .then((blob) => blob.text())
    .then((html) => {
         //document.querySelector("#pagination_data").innerHTML = html
        //var scriptTag = "<script src='/resources/themes/Godlike/js/godlike-init.js'></" + "script>";

            const newScript = document.createElement("script");
            newScript.src = "/resources/themes/Godlike/js/godlike-init.js";
            document.querySelector("#pagination_data").appendChild(newScript);
            document.querySelector("#pagination_data").innerHTML = html
    })
}