$('document').ready(function() { 
  $('.icon').click(function(){
    var icon = $('i.icon');
    if($(this).hasClass('closed')){
      $('.sidebar').animate({
        marginLeft: '0px'
      }, 250);
      $(this).removeClass('closed');
      $(this).addClass('open');
      icon.addClass('mdi-chevron-left');
      icon.removeClass('mdi-chevron-right');   
    }
    else{
      $('.sidebar').animate({
        marginLeft: '-270px'
      }, 250);
      
      $(this).removeClass('open');
      $(this).addClass('closed');
      icon.addClass('mdi-chevron-right');
      icon.removeClass('mdi-chevron-left');    
    }
  });
});
function Account_Exit(){
  $.ajax({
    url: "./sameparts/account_control/account_exit.php",
    method: "POST",
    success: function(result){
      location.reload();
    }
  });
}