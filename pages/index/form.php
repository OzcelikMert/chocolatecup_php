<div class="card">
	<div class="card-header">
		<h3 class="text-center" style="margin-top:20px;">Giriş</h3>
	</div>
	<div class="card-body">
		<div class="input-group form-group">
			<div class="input-group-prepend" style="height: 50px;">
				<span class="input-group-text"><i class="mdi mdi-account"></i></span>
			</div>
			<input type="text" id="user_name" class="form-control" placeholder="Kullanıcı Adı">
			
		</div>
		<div class="input-group form-group">
			<div class="input-group-prepend" style="height: 50px;">
				<span class="input-group-text"><i class="mdi mdi-key-star"></i></span>
			</div>
			<input type="password" id="password" class="form-control" placeholder="Şifre">
		</div>
		<div class="form-group">
			<button class="btn login_btn" id="login_btn" style="height: 50px;width:100%">Giriş</button>
		</div>
	</div>
	<div id="error_messages"></div>
	<div class="card-footer">
        <span>&copy; <?php echo date("Y") ?> ChocolateCup</span>
	</div>
</div>