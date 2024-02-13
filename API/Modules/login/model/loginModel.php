<?php
class loginModel extends mainModel
{
    public static function login($tableName, $postArray){
        return self::$CrudPDO::dbControl($tableName, false, false, '*', ['users_email', 'users_password'], $postArray, true);
    }
}