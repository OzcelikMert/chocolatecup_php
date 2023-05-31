// Delete Account
function AccountDelete(AccountID){
    var AccountName = $("#Account_"+ AccountID).attr("name");
    Swal.fire({
        title: 'Hesap Silme',
        text: "'"+AccountName+"' isimli hesabı silmek istediğinizden emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet, Sil!',
        cancelButtonText: 'Hayır, iptal!',
        confirmButtonClass: 'btn btn-success margin-5 mr-3',
        cancelButtonClass: 'btn btn-danger margin-5',
        buttonsStyling: false
    }).then(function (dismiss) {
        if (AccountID != "" && dismiss.value) {
			// OKAY
			$.ajax ({
        		url: "./pages/user_management/functions/delete_account.php",
        		method: "POST",
        		data: { account_id: AccountID },
        		success: function(data_msg){
					// OKAY MESSAGE
					var data_message = $.parseJSON(data_msg);
					if(data_message.type == "success"){
						$("#Account_"+ AccountID).remove();
                    }

					Swal.fire(
						data_message.title,
						data_message.comment,
						data_message.type
					)
                }
			});
			// end OKAY
        }
    })
}
// end Delete Account

// Update Account
function AccountUpdate(AccountID){
    var AccountName = $("#Account_"+ AccountID).attr("name");
    var AccountActive = $("#Account_"+ AccountID).attr("is_active");

    Swal.fire({
        title: 'Hesap Bilgileri Değiştirme',
        html: '<h5 style="color:darkred;">'+AccountName+'</h5>'+
        '<input type="text" id="new_account_name_swal" class="swal2-input" maxlength="30" placeholder="Hesap İsimi" value="'+AccountName+'" required>'+
        '<input type="password" id="new_account_password_swal" class="swal2-input" aria-describedby="passwordHelpBlock" maxlength="20" placeholder="Hesap Şifresi" required>'+
        'Aktiflik Durumu<input type="checkbox" class="swal2-input" style="box-shadow: none;" id="new_account_active_swal" '+((AccountActive == "1") ? "checked" : "")+'>',
        showCancelButton: true,
        cancelButtonText: "İptal",
        confirmButtonText: 'Güncelle',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve){
                var AccountNewName = $("#new_account_name_swal").val();
                var AccountNewPassword = $("#new_account_password_swal").val();
                var AccountActive = ($("#new_account_active_swal").is(":checked")) ? "1" : "0";
                $.ajax ({
        	    	url: "./pages/user_management/functions/update_account.php",
        	    	method: "POST",
        	    	data: { account_id: AccountID, account_name: AccountNewName, account_password: AccountNewPassword, account_active: AccountActive },
        	    	success: function(data_msg){
                        // OKAY MESSAGE
                        var data_message = $.parseJSON(data_msg);
			    		if(data_message.type == "success"){
                            $("#Account_"+AccountID).attr("name", AccountNewName);
                            $("#Account_"+AccountID+"_Name").html(AccountNewName);
                            $("#Account_"+AccountID).attr("is_active", data_message.account_active);
                            if(data_message.account_active == "0"){
                                $("#Account_"+AccountID).attr("style","background-color: #ff7777;");
                            }else if (data_message.account_active == "1"){
                                $("#Account_"+AccountID).removeAttr("style");
                            }
			    		    Swal.fire(
			    		    	data_message.title,
			    		    	data_message.comment,
			    		    	data_message.type
                            )
			    		}else{
                            Swal.showValidationMessage(
                                data_message.title+": "+data_message.comment
                            )
                            resolve(true);
                        }
        	    	}
                })
            })
        },
        onOpen: function() {
          //$("#new_account_name_swal").focus();
        },
        allowOutsideClick: false
    });
}
// end Update Account