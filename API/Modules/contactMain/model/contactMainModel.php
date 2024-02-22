<?php
class contactMainModel extends mainModel
{
    public static function update($tableName,$returnArray) {
        $id = $returnArray['id'];
        unset($returnArray['id']);
        return self::$CrudPDO::updateOnDB($tableName,$returnArray,$id);
    }

}