$(document).ready(function() {
    $.ajax({
        url: 'getSessionInfo.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.username == 'admin') {
                $("#userInfo").html("Welcome Admin!");
            }else{
                $("#userInfo").html("Welcome Manager!");
            }
        },
        error: function() {
            console.error('Failed to fetch session data');
        }
    });
});

