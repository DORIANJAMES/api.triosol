<?php
class productsModel extends mainModel
{
    public static function add($tableName, $postArray) {
        return self::$CrudPDO::addToDB($tableName, $postArray);
    }

    public static function update ($tableName, $postArray) {
        $id = $postArray['id'];
        unset($postArray['id']);
        return self::$CrudPDO::updateOnDB($tableName, $postArray, $id);
    }

    public static function delete($tableName, $id) {
        return self::$CrudPDO::deleteFromDB($tableName, $id);
    }
}