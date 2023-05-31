const Question_Values = {
    ID: Array(),
    Point: Array(),
    Text: ""
};
// Click Event
$("#save_btn").on("click", function(){
    // Clear Const Values
    ResetQuestionConstValues();
    // Get 'tr' Count
    var question_count = $("#questions tbody tr").length;
    for (let index = 0; index < question_count; index++) {
        // Get Question Values
        var question_id = "#" + $("#questions tbody tr").get(index).id;
        var question_point = $(question_id).find("#point select").children("option:selected").val(); 
        var question_text = $(question_id).find("#text").html();
        // Check Point
        if(question_point > 0){
            // Clear Variables
            var id = ClearVariable(question_id, "normal+number");
            question_point = ClearVariable(question_point, "normal+number");
            // Set Variables
            Question_Values.ID[(Question_Values.ID.length)] = id;
            Question_Values.Point[(Question_Values.Point.length)] = question_point;
            Question_Values.Text += "<i>Soru: <b>\'" + question_text + "\'</b> | Verdiğiniz Puan: <b>" + question_point + "</b></i><br>";
        }
    }
    // Check ID Count
    if(Question_Values.ID.length > 0){
        SavePoints();
    }
})
// Save Points
function SavePoints(){
    var contestant_id = $("#contestant_id").val();
    var contestant_name = $("#contestant_name").html();
    Swal.fire({
        title: 'Puan Kayıt: ' + contestant_name,
        html: ("<div>" + Question_Values.Text + "</div>" + "<br><b>Verdiğiniz puanları kayıt etmek istediğinize emin misiniz?</b>"),
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Evet!',
        cancelButtonText: 'Hayır, iptal!',
        confirmButtonClass: 'btn btn-success margin-5 mr-3',
        cancelButtonClass: 'btn btn-danger margin-5',
        buttonsStyling: false
    }).then(function (dismiss) {
        if (dismiss.value) {
			// OKAY
			$.ajax ({
        		url: "./pages/give_point/functions/set_point.php",
        		method: "POST",
        		data: { contestant_id: contestant_id, question_id: Question_Values.ID, question_point: Question_Values.Point },
        		success: function(result){
					// OKAY MESSAGE
					var json_result = $.parseJSON(result);
					if(json_result.type == "success"){
                        // Delete Input Select
						for (let index = 0; index < Question_Values.ID.length; index++) {
                            $("#question_" + Question_Values.ID[index]).find("#point").html("<p>" + Question_Values.Point[index] + "</p>");
                        }
                    }
                    // Popup
                    Swal.fire(
						json_result.title,
						json_result.comment,
						json_result.type
					)
        		}
			});
			// end OKAY
        }
    })
}
// Reset Const Values
function ResetQuestionConstValues(){
    // Reset to Question Values
    Question_Values.ID = Array();
    Question_Values.Point = Array();
    Question_Values.Text = "";
    // Reset To Question Values
}