$(document).ready(function(){
    $('.background').css("height",$(window).height());  
});

$(window).resize(function() {
  $('.background').css("height",$(window).height());
});
