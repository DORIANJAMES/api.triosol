<?php
class usersModel extends mainModel {
    public static function add($tableName, $returnArray){
        return self::$CrudPDO::addToDB($tableName, $returnArray);
    }

    public static function update($tableName, $returnArray){
        $id = $returnArray['id'];
        unset($returnArray['id']);
        return self::$CrudPDO::updateOnDB($tableName, $returnArray, $id);
    }

    public static function delete($postArray){
        return self::$CrudPDO::deleteFromDB($postArray['tableName'], $postArray['id']);
    }
}