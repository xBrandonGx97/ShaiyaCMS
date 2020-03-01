function load_data(page) {
    var uid = $('#pagination_data').data("id");

    fetch('/resources/jquery/addons/ajax/blade/init.view_topic_pagination.php', {
        method: 'post',
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            page: page,
            id: uid
        })
    })
    .then(r => r.json())
    .then(data => {
        console.log(data);
    })
    .catch(err => {

    })

    /*$.ajax({
        url: '/resources/jquery/addons/ajax/blade/init.view_topic_pagination.php',
        method: 'POST',
        data: {
            page: page,
            id: uid
        },
        success: function (response) {
            $('#pagination_data').html(response);
        },
    })*/
}