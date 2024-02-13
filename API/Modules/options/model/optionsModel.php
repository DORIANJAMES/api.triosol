<?php
class optionsModel extends mainModel
{
    public static function list($postArray)
    {
        print_r(json_encode($postArray));
    }

    public static function update($postArray)
    {
        $tableName = $postArray['tableName'];
        $id = $postArray['id'];
        unset($postArray['id']);
        unset($postArray['tableName']);
        unset($postArray['session_email']);
        return self::$CrudPDO::updateOnDB($tableName,$postArray,$id);
    }
}