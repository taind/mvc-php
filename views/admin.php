<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=Config::get('site_name')?></title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><?=Config::get('sitename')?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">


            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/admin/pages/">Pages</a></li>
                <li><a href="/admin/users/">Users</a></li>
                <li><a href="/admin/contacts/">Contacts</a></li>

                <?php if(Session::get('username')){ ?> //login moi hien nut logout len
                <li><a href="/admin/users/logout">Logout</a> </li>
            <?php } ?>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <?php
        if(Session::hasFlash()){
            Session::flash();
        };
    ?>

    <div class="starter-template">
        <?php
            echo $data['content'];
        ?>
    </div>

</div><!-- /.container -->



</body>
</html>