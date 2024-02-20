<?php
class servicesModel extends mainModel
{
    public static function update($tableName, $postArray)
    {
        $id = $postArray['id'];
        unset($postArray['id']);
        return self::$CrudPDO::updateOnDB($tableName, $postArray, $id);
    }
}