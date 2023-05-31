$("#login_btn").on("click", function(){
    var user_name = ClearVariable($("#user_name").val(), "normal"); 
    var password =  ClearVariable($("#password").val(), "normal");
    var nav_page = ClearVariable($("#nav_page").val(), "normal");

    if(user_name != "" && password != ""){
        $.ajax({
            url: "./pages/index/functions/login.php",
            method: "POST",
            data: {user_name: user_name, password: password},
            success: function(result){
                var json_result = $.parseJSON(result);
                if(json_result.type == "error"){
                    $("#password").val("");
                    $("#error_messages").html(json_result.comment);
                }else if(json_result.type == "success"){
                    $("#error_messages").html("");
                    if(nav_page != "")
                        document.location = nav_page;
                    else
                        document.location = json_result.location;
                }
            }
        });
    }else{
        $("#error_messages").html("Lütfen Gerekli Yerleri Doldurunuz.");
    }
})