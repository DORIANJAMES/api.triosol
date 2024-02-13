<?php
class addressesModel extends mainModel
{
    public static function add($tableName, $postArray)
    {
        return self::$CrudPDO::addToDB($tableName, $postArray);
    }

    public static function update($tableName, $postArray)
    {
        $id = $postArray['id'];
        unset($postArray['id']);
        return self::$CrudPDO::updateOnDB($tableName, $postArray, $id);
    }
}