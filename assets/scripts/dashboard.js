$(window).on("load", function(){
    GetValues("onload");
});

function GetValues(Date){
    $.ajax({
        url: "./pages/dashboard/functions/get_saved_points.php",
        method: "POST",
        data: { date: Date },
        success: function(result){
            var json_result = $.parseJSON(result);
            // Set Date
            if(json_result.dates != ""){
                $("#date").html(json_result.dates);
            }
            // Set Saved Points
            if(json_result.saved_points != ""){
                $("#saved_points tbody").html(json_result.saved_points);
            }
        }
    })
}

$("#show").on("click", function(){
    var date = $("#date").children("option:selected").val();
    date = ClearVariable(date, "normal");

    var regex = /([0-9]{4}-[0-9]{2})/gi;
    if(regex.test(date))
        GetValues(date);
})