this page is pages/index.html
<br>
<?php
foreach($data['pages'] as $da){ ?>
    <div style="margin-top: 20px">
        <a href="/pages/view/<?=$da['alias']; ?>"> <?=$da['title']; ?></a>
    </div>
<?php } ?>