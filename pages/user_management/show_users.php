<div class="col-md-12">
    <div class="p-1">
        <!-- All Accounts -->
        <div class="panel panel-default panel-table">
          <div class="panel-body table-responsive" style="max-height: 50vh;">
            <table class="table table-striped table-bordered table-list">
                <thead>
                    <tr>
                        <th style="text-align:center; width: 100px;"><em class="mdi mdi-delete"></em></th>
                        <th style="text-align:center; width: 100px;"><em class="mdi mdi-update"></em></th>
                        <th>İsim</th>
                        <th>Yetki</th>
                    </tr> 
                </thead>
                <tbody id="AccountValues">
                    <!-- Call Values -->
                    <?php echo $Values["Users"]; ?>
                </tbody>
            </table>
          </div>
        </div>
        <!-- end All Accounts -->
    </div>
</div>