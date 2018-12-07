$(document).ready(function() {
  //On click Sign up
  $('#signup').click(function() {
    $('#first').slideUp('slow', function() {
      $('#second').slideDown('slow');
    });
  });

  //On click Sign in
  $('#signin').click(function() {
    $('#second').slideUp('slow', function() {
      $('#first').slideDown('slow');
    });
  });
});
