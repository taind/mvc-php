<h3>Add User</h3>
<?php
    if((Session::get('error'))){
        foreach (Session::get('error') as $da){
            echo $da."<br>";
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
        <input type="text" id="fullname" name="fullname" value="" placeholder="your fullname" class="form-control" >
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="" placeholder="your username" class="form-control" >
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" id="password" name="password" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="re-password">Retype your password</label>
        <input type="text" id="re-password" name="re-password" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input type="text" id="email" name="email" value="" class="form-control" >
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select id="role" name="role">
            <?php
                foreach(Config::get('account.role') as $da){?>
                <option value="<?=$da?>"><?=$da?></option>
            <?php    }
            ?>
        </select>
    </div>

    <input type="submit" class="btn-success">
</form>