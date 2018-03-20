<h3>pages</h3>
<table class="table table-striped" style="width: 400px;">
    <?php
        foreach ($data['page'] as $da){ ?>
        <tr>
            <td><?=$da['title']?></td>
            <td align="right"><a href="/admin/pages/edit/<?=$da['id']?>"><button class="btn btn-sm btn-primary">edit</button></a></td>
            <td align="right"><a href="/admin/pages/delete/<?=$da['id']?>"><button class="del_btn btn btn-sm btn-warning">delete</button></a></td>
        </tr>
    <?php } ?>
</table>
<br>
<div>
    <a href="/admin/pages/add/"><button class="btn btn-sm btn-success">New Page</button></a>

</div>
