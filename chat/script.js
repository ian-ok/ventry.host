$(document).ready(function() {
    // check once in five seconds
    setInterval(function() {
        $.get('/refresh.php', {do: 'new_messages'}, function(response) {
        if(response == "refresh") {
            window.location.reload();
        }
        });
    }, 1000); 
});