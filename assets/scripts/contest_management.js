// Get Active Button
$(window).on("load", function(){
    ChangeContestActive("1");
});

// Change Active
function ChangeActive(){
    Swal.fire({
        title: 'Yarışma Aktifliğini Değiştirme',
        text: 'Yarışma durumunda değişiklik yapmak istiyorsanız lütfen aşağıdaki kutucuğa "ACCEPT" yazın.',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        cancelButtonText: "İptal",
        confirmButtonText: 'Değiştir',
        showLoaderOnConfirm: true,
        preConfirm: function (AcceptText) {
            return new Promise(function (resolve){
                // Check AcceptText
                if(AcceptText.toLowerCase() != "accept"){
                    Swal.showValidationMessage("Lütfen kelimeyi doğru yazdığınızdan emin olun!");
                    resolve(true);
                }else{
                    // Change Contest Active
                    ChangeContestActive(0);
                }
            })
        },
        allowOutsideClick: false
    });
}

// Change Contest Active and Get Active Button
function ChangeContestActive(is_onload){
    $.ajax({
        url: "./pages/contest_management/functions/change_active.php",
        method: "POST",
        data: {is_onload: is_onload},
        success: function(result){
            var json_result = $.parseJSON(result);
            // Set Active Button
            $("#active_button_div").html(json_result.active_button);
            // Show Error Message
            if(json_result.type != "") {
                Swal.fire(
                    json_result.title,
                    json_result.comment,
                    json_result.type
                );
            }
        }
    });
}