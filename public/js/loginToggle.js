$(document).ready(function() {
    $('#signup').click(function() {
        $('#loginForm').hide();
        $('#signupForm').show();
    });
    
    $('#login').click(function() {
        $('#signupForm').hide();
        $('#loginForm').show();
    });
});

