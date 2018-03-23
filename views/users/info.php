<div class="container-fluid well span6">
    <div class="row-fluid">
        <div class="span2" >
            <img src="https://secure.gravatar.com/avatar/de9b11d0f9c0569ba917393ed5e5b3ab?s=140&r=g&d=mm" class="img-circle">
        </div>

        <div class="span8">
            <h3><?=$data['userinfo']['fullname']?></h3>
            <h6><?=$data['userinfo']['username']?></h6>
            <h6><?=$data['userinfo']['email']?></h6>
            <input type="hidden" name="id" value="<?=$data['userinfo']['id']?>" />
        </div>
        <div class="span2">
            <a href="/users/edit/<?=$data['userinfo']['username']?>">
            <button class="btn btn-success">Edit</button>
        </div>
    </div>
</div>

