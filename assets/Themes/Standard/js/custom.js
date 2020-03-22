// Div Auto-update
$(document).ready(function(){
	setInterval(function()
    {
        $("#plContainer").load(location.href + " #plContent");
    }, 60000);
});