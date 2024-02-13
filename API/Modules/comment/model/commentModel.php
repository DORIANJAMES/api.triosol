<?php
class commentModel extends mainModel
{
    public static function list($tableName) {
        return self::$CrudPDO::dbControl($tableName, true, false, '*' ,'users_email', $postArray['comments_email'], false  );
    }
}