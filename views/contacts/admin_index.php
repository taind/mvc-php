<h3>Messages</h3>
<table class="table table-striped" style="width: 100%">
    <tr>
        <td style="width: 10%">#</td>
        <td style="width: 10%">Name</td>
        <td style="width: 10%">Email</td>
        <td style="width: 10%">Message</td>
    </tr>
<?php foreach($data['page'] as $da){ ?>
    <tr>
        <td><?=$da['id']?></td>
        <td><?=$da['name']?></td>
        <td><?=$da['email']?></td>
        <td><?=$da['message']?></td>
    </tr>
<?php } ?>
</table>