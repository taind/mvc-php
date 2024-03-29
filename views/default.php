<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=Config::get('site_name')?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><?=Config::get('sitename')?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a <?php if( App::getRouter()->getController() == 'pages') {?> class="active" <?php } ?> href="/pages/">Pages</a></li>
                <li><a <?php if( App::getRouter()->getController() == 'contacts') {?> class="active" <?php } ?> href="/contacts/">Contact</a></li>
                <?php if(Session::get('username')){ ?> //login moi hien nut logout len
                    <li><a href="/users/">My account</a> </li>
                    <li><a href="/users/logout">Logout</a> </li>
                <?php } ?>
                <?php if(!Session::get('username')){ ?> //login moi hien nut logout len
                    <li><a href="/users">Login</a> </li>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <?php
            if (Session::hasFlash()){
        ?>
                <div class="alert alert-info" role="alert">
                    <?php Session::flash(); ?>
                </div>
        <?php
            }
        ?>
    </div>

</div><!-- /.container -->



</body>
</html>