<div class="col-md-12">
    <!-- Create New Account -->
    <form class="p-1" method="post">
        <div class="form-group">
            <label>Yeni Hesap Oluştur</label>
            <input type="text" name="new_person_name" class="form-control" maxlength="30" placeholder="Kişi İsimi" value="<?php echo $_POST["new_person_name"]; ?>" required>
        </div>
        <div class="form-group">
            <input type="text" name="new_user_name" class="form-control" maxlength="20" placeholder="Kullanıcı İsimi" value="<?php echo $_POST["new_user_name"]; ?>" required>
            <small id="passwordHelpBlock" class="form-text text-muted">
                Kullanıcı İsimi programa girerken E-posta yerine kullandığımız isimdir.(Kişi İsimi ile karıştırılmaması gerekir.)
            </small>
        </div>
        <div class="form-group">
            <input type="password" name="new_user_password" class="form-control" aria-describedby="passwordHelpBlock" maxlength="20" placeholder="Kullanıcı Şifresi" required>
            <small id="passwordHelpBlock" class="form-text text-muted">
                Lütfen en az 1 - en fazla 20 haneli bir şifre giriniz.
            </small>
        </div>
        <div class="form-group">
            <select class="custom-select" name="new_user_permission" required>
              <option selected>Lütfen kullanıcı için bir yetki seçin...</option>
              <?php echo $Values["Permissions"]; ?>
            </select>
        </div>
        <div class="new-account-error"><?php echo $errorMessage; ?></div>
        <button class="btn btn-success my-1" id="create_new_account">Oluştur</button>
    </form>
    <!-- end Create New Account -->
</div>