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

// SERVICES Operations Routes
App::postAction('/services/update','/services/update');

// INFOAREA Operations Routes
App::postAction('/infoArea/update','/infoArea/update');

// INFOCARDS Operations Routes
App::postAction('/infoCards/add','/infoCards/add');
App::postAction('/infoCards/update','/infoCards/update');
App::postAction('/infoCards/delete','/infoCards/delete');

// BELTBANNER Operations Routes
App::postAction('/beltBanner/update','/beltBanner/update');

// FAQAREA Operations Routes
App::postAction('/faqArea/update','/faqArea/update');

// FAQQUESTIONS Operations Routes
App::postAction('/faq/add','/faq/add');
App::postAction('/faq/update','/faq/update');
App::postAction('/faq/delete','/faq/delete');

// CONTACTMAIN Operations Routes
App::postAction('/contactMain/update','/contactMain/update');

// SERVICESCARDS Operations Routes
App::postAction('/servicesCards/update','/servicesCards/update');
App::postAction('/servicesCards/add','/servicesCards/add');
App::postAction('/servicesCards/delete','/servicesCards/delete');

// PRODUCTS Operations Routes
App::postAction('/products/update','/products/update');
App::postAction('/products/add','/products/add');
App::postAction('/products/delete','/products/delete');

// USERS Operations Routes
App::postAction('/users/update','/users/update');
App::postAction('/users/add','/users/add');
App::postAction('/users/delete','/users/delete');

?>