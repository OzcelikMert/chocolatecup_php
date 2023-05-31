<div class="col-12" style="padding:10px;">
    <input type="hidden" id="contestant_id" value="<?php echo $_GET["id"]; ?>"/>
    <h3 id="contestant_name"><?php echo $Values["title"]; ?></h3>
    <?php 
    if($Values["type"] == "success"){
        echo '
        <table id="questions" class="table">
            <thead class="bg-white">
                <tr>
                <th style="width:75%;" scope="col">Sorular</th>
                <th style="width:25%;" scope="col">Puan</th>
                </tr>
            </thead>
            <tbody>
                '.$Values["questions"].'
            </tbody>
        </table>
        <button id="save_btn">Kaydet</button>
        ';
    }
    ?>
</div>