$(document).ready(function() {

    //Process signup with out loading a page
    $("#signupmodal").click(function(event) {
        event.preventDefault();
        $('#loading').addClass('loading');
        $.ajax({
            url: "core/register.php",
            method: "POST",
            data:  $(".signupForm").serialize(),
            beforeSend: function() {
                $(".loading").show();
            },
            complete: function() {
                $(".loading").hide();
            },
            success: function(data) {
                $("#signup_error").html(data);
            }
        })
    })

    //Process Login user without loading the page
    $("#loginModal").click(function(event) {
       event.preventDefault();
       $('#loading').addClass('loading');
       var email = $("#login_email").val();
       var pass = $("#login_password").val();
       $.ajax({
           url: "core/action.php",
           method: "POST",
           data: { userLogin: 1, email: email, password: pass },
           beforeSend: function() {
               $(".loading").show();
           },
           complete: function() {
               $(".loading").hide();
           },
           success: function(data) {
               $("#login_error").html(data);
               if (data == "?$#") {
                   window.location.href = "index.html";
               }
           }
       })
   })
});