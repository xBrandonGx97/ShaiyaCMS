function load_data(page) {
    var uid = $('#pagination_data').data("id");

    $.ajax({
        url: '/resources/jquery/addons/ajax/blade/init.view_topic_pagination.php',
        method: 'POST',
        data: {
            page: page,
            id: uid
        },
        success: function (response) {
            $('#pagination_data').html(response);
        },
    })
}