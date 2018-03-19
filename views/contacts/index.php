<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=Config::get('site_name')?></title>
</head>
<body>
<h3>contact us:</h3>
<form action="" method="post">
    <?php
        if(Session::hasFlash()){
            Session::flash();
        }
    ?>
    <input type="text" class="form-control" name="name" placeholder="your name"><br>
    <input type="text" class="form-control" name="email" placeholder="your email"><br>
    <textarea name="message" class="form-control" placeholder="your message"></textarea><br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
</form>
</body>
</html>