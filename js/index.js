$(document).ready(function() {
  $(window).on('resize', function() {
    if($( document ).width() <= 1280){
      $('#vid1, #vid2').removeClass('col-sm-5');
      $("#vid1, #vid2").addClass('col-sm-7');
    } else if($( document ).width() > 1280){
      $('#vid1, #vid2').removeClass('col-sm-7');
      $("#vid1, #vid2").addClass('col-sm-5');
    }
  });
});
