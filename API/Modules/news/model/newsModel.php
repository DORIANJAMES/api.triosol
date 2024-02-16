<?php
class newsModel extends mainModel
{
    public static function update($tableName, $postArray)
    {
        $id = $postArray['id'];
        unset($postArray['id']);
        return self::$CrudPDO::updateOnDB($tableName, $postArray, $id);
    }

    public static function delete($postArray){
        return self::$CrudPDO::deleteFromDB($postArray['tableName'], $postArray['id']);
    }

    public static function add($postArray)
    {
        $tableName = $postArray['tableName'];
        unset($postArray['tableName']);
        return self::$CrudPDO::addToDB($tableName, $postArray);
    }
}