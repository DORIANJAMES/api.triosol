<?php
class mainModel extends CrudPDO
{
    public static $CrudPDO;
    public function __construct()
    {
        self::$CrudPDO = new CrudPDO();
    }
}