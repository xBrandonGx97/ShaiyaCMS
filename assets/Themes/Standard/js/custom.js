// Div Auto-update
$(document).ready(function(){
	setInterval(function()
    {
        $("#plContainer").load(location.href + " #plContent");
    }, 60000);
});

// Autoloader

function fadeOut(){
    $(".fadeout").fadeToggle(500, "swing",function(){
        this.remove();
    });

    document.getElementById("myDiv").style.display = "block";
}

var delay = 4000; //4 seconds
setTimeout(fadeOut, delay);

// Popovers
$(function () {
    $('[data-toggle="popover"]').popover()
  })

  $('[data-toggle=popover]').popover({
    html: true,
    content: function () {
        return $('#content').html();
    }
}).click(function (e) {
    $('[data-toggle=popover]').not(this).popover('hide');
});