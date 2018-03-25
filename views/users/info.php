<div class="container-fluid well span6">
    <div class="row-fluid">
        <div class="col-sm-2" >
            <img class="info-responsive" src="data:<?=$data['userinfo']['img_mime']?>;base64,<?=$data['userinfo']['img_b64']?>">
        </div>
        <div class="col-sm-8">
            <h3><?=$data['userinfo']['fullname']?></h3>
            <h6><?=$data['userinfo']['username']?></h6>
            <h6><?=$data['userinfo']['email']?></h6>
            <input type="hidden" name="id" value="<?=$data['userinfo']['id']?>" />
            <a href="/users/edit/<?=$data['userinfo']['username']?>">
            <button class="btn btn-success">Edit</button>
        </div>
    </div>
</div>

