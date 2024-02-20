<?php
// HOME Page Operations Route
App::postAction('','/home/home');
App::postAction('/','/home/home');
App::postAction('/index','/home/home');
App::postAction('/home','/home/home');

// LOGIN Operations Routes
App::postAction('/login','/login/login');

// COMMENT Operations Routes
App::postAction('/comment/add','/comment/add');
App::postAction('/comment/list','/comment/list');

// CATEGORY Operations Routes
App::postAction('/category/list', '/categories/list');

// OPTIONS Operations Routes
App::postAction('/options/update','/options/update');

// ADDRESSES Operations Routes
App::postAction('/addresses/add','/addresses/add');
App::postAction('/addresses/update','/addresses/update');
App::postAction('/addresses/delete','/addresses/delete');

// NEWS Operations Routes
App::postAction('/news/update','/news/update');
App::postaction('/news/delete','/news/delete');
App::postAction('/news/add','/news/add');
App::postAction('/news/list','/news/list');
App::postAction('/news/is-exists','/news/isExists');

// MAINBANNER Operations Routes
App::postAction('/mainBanner/update','/mainBanner/update');

// SUBBANNER Operations Routes
App::postAction('/subBanner/update','/subBanner/update');

// PRODUCTSFRONT Operations Routes
App::postAction('/services/update','/services/update');


?>

