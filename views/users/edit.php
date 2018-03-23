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
<form method="POST" action="">
    <input type="hidden" name="id" value="" />
    <div class="form-group">
        <label for="fullname">Fullname</label>
        <input type="text" id="fullname" name="fullname" value="<?=$data['userinfo']['fullname']?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?=$data['userinfo']['username']?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="cur-password">Current password</label>
        <input type="password" id="cur-password" name="cur-password" value="" class="form-control" placeholder="">
    </div>
    <div class="form-group">
        <label for="new-password">New password (leave if you dont want to change)</label>
        <input type="password" id="new-password" name="new-password" value="" class="form-control" placeholder="">
    </div>
    <div class="form-group">
        <label for="re-password">Retype new password</label>
        <input type="password" id="re-password" name="re-password" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input type="text" id="email" name="email" value="<?=$data['userinfo']['email']?>" class="form-control" >
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>