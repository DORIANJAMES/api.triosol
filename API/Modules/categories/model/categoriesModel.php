<?php
class categoriesModel extends mainModel {
    public static function list($tableName)
    {
        return self::$CrudPDO::dbControl($tableName, true);
    }
}