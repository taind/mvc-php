<h3>Book list</h3>
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
        <td style="width: 2%"><strong>#</strong></td>
        <td style="width: 10%"><strong>Title</strong></td>
        <td style="width: 10%"><strong>Author</strong></td>
        <td style="width: 10%"><strong>Price</strong></td>
        <td style="width: 10%"><strong>Description</strong></td>
        <td style="width: 2%"><strong>Image</strong></td>
        <td style="width: 10%"><strong>Action</strong></td>


    </tr>
    <?php foreach($data['listBooks'] as $da){ ?>
        <tr>
            <td class="txtID"><?=$da['id']?></td>
            <td class="txtTitle"><?=$da['title']?></td>
            <td class="txtAuthor"><?=$da['author']?></td>
            <td class="txtPrice"><?=$da['price']?></td>
            <td class="txtEmail"><?=$da['description']?></td>
            <td class="txtImage"><?=$da['image']?></td>
            <td><a href="/admin/pages/edit/<?=$da['id']?>"><button class="btn-edit btn btn-sm btn-warning">EDIT</button> | <a href="/admin/pages/delete/<?=$da['id']?>"><button class="btn-delete btn btn-sm btn-danger">DELETE</button></td>

        </tr>
    <?php } ?>
</table>
<a href="/admin/pages/add/"><button class="btn btn-sm btn-success">New Books</button></a>


<script>
    $(document).ready(function () {
        $(".btn-delete").click(function () {
            var result = confirm("Do you want to delete this book?");
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