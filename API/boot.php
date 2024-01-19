<?php
require_once 'config.php';
require_once 'Library/CrudPDO.php';
require_once 'Helpers/mHelper.php';
require_once 'System/App.php';
require_once 'System/mainModel.php';
require_once 'System/mainController.php';
require_once 'System/mainView.php';
require_once 'route.php';

spl_autoload_register(function ($class_name){
   $module = explode('Model', $class_name);
   if (file_exists($inc = DIRECTORY."/Modules/{$module['0']}/model/{$module[0]}Model.php"))
       require_once $inc;
});