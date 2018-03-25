<h3>User List</h3>
<?php
if(Session::get('admin_delete')){ ?>
    <div class="alert alert-success">
        <strong><?php echo Session::get('admin_delete');?></strong>
    </div>
<?php Session::set('admin_delete', null);
}
?>
<table class="table table-striped" style="width: 100%">
    <tr>
        <td style="width: 2%">#</td>
        <td style="width: 10%">Fullname</td>
        <td style="width: 10%">Username</td>
        <td style="width: 10%">Email</td>
        <td style="width: 10%">Role</td>
        <td style="width: 10%">Avatar</td>
        <td style="width: 10%">Action</td>


    </tr>
    <?php foreach($data['listUser'] as $da){ ?>
        <tr>
            <td class="txtID"><?=$da['id']?></td>
            <td class="txtUsername"><?=$da['fullname']?></td>
            <td class="txtUsername"><?=$da['username']?></td>
            <td class="txtEmail"><?=$da['email']?></td>
            <td class="txtRole"><?=$da['role']?></td>
            <td class="txtAvatar"><?=$da['image']?></td>
            <td><a href="/admin/users/edit/<?=$da['id']?>"><button class="btn-edit btn btn-sm btn-warning">EDIT</button> | <a href="/admin/users/delete/<?=$da['id']?>"><button class="btn-delete btn btn-sm btn-danger">DELETE</button></td>

        </tr>
    <?php } ?>
</table>
<a href="/admin/users/add/"><button class="btn btn-sm btn-success">New User</button></a>


<script>
    $(document).ready(function () {
       $(".btn-delete").click(function () {
          var result = confirm("Do you want to delete this user?");
          if(result) {
              return true;
          }
          return false;
       });
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove();
            });
        }, 3000);
    });
</script>