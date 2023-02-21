$(document).ready(function() {
    $('#dropdown-button').click(function() {
      $('#dropdown-menu').toggle(150);
      $(this).toggleClass('active');
    });
});