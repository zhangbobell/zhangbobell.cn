$(document).ready(function(){
    
  $("#submit").click(function(){

    var username = $("#myusername").val();
    var password = $("#mypassword").val();
    
    if((username == "") || (password == "")) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>");
    }
    else {
      $.ajax({
        type: "POST",
        url: "user/checklogin",
        data: "username=" + username + "&password="+ $.md5(password),
        success: function(d){
          if(d==1) {
            window.location="user/center";
          }
          else {
            $("#message").html('<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Wrong Username or Password</div>');
          }
        },
        beforeSend:function()
        {
          $("#message").html("<p class='text-center'><img src='public/images/loading.gif' alt='loading'></p>")
        }
      });
    }
    return false;
  });
});