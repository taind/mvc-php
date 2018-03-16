<?php
//we set something
Config::set('site_name', 'Viettel Book Store');

Config::set('languages', array('en', 'vi'));

Config::set('routes',array(
    'default' => '',
    'admin' => 'admin_',
));

Session::setFlash('flash message here');
Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');


//db
Config::set('db.host','127.0.0.1');
Config::set('db.port','3306');
Config::set('db.username','bookstore');
Config::set('db.password','123123');
Config::set('db.db_name','mvc');
