this page is pages/index.html
<br>
<?php
foreach($data['page'] as $da){ ?>
    <div style="margin-top: 20px">
        <a href="/pages/view/<?=$da['alias']; ?>"> <?=$da['title']; ?></a>
    </div>
<?php } ?>


