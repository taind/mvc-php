<h3>Edit User</h3>
<?php
if((Session::get('error'))){
    foreach (Session::get('error') as $err){
        echo $err."<br>";
    }
    Session::set('error', null);
}else if(Session::get('success')){
    echo Session::get('success');
    Session::set('success', null);
}
?>
<div class="row">
    <div class="col-sm-6">
        <form method="POST" action="">
            <input type="hidden" name="id" value="" />
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?=$data['userinfo']['username']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="new-password">New password</label>
                <input type="new-password" id="new-password" name="new-password" value="" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="re-password">Retype new password</label>
                <input type="text" id="re-password" name="re-password" value="" class="form-control" >
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" id="email" name="email" value="<?=$data['userinfo']['email']?>" class="form-control" >
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <?php
                    if(Session::get('username') == 'admin'){
                        foreach(Config::get('account.role') as $role){
                    ?>
                        <option value="<?=$role?>" <?php if($role === $data['userinfo']['username']){ echo "selected='selected'";} ?> ><?=$role?></option>
                    <?php    }}

                    ?>
                </select>
            </div>
            <input type="submit" class="btn btn-success">
        </form>
    </div>
    <div class="col-sm-6">
        <div clas="col-sm-6">
            <strong>Avatar</strong>
            <img class="img-responsive" src="data:<?=$data['userinfo']['img_mime']?>;base64,<?=$data['userinfo']['img_b64']?>">
        </div>
    </div>

</div>