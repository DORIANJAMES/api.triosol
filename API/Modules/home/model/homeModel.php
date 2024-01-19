<?php

class homeModel extends mainModel
{
    public static function home($tablename, $id = null, $rowName=null, $onlyOne = false)
    {
        if ($id == null) {
            return self::$CrudPDO::dbControl($tablename, true);
        } else {
            $rowName==null?$rowName=$tablename.'_id':$rowName;
            return self::$CrudPDO::dbControl($tablename, true,false,'*', $rowName ,$id,false, $onlyOne);
        }
    }
}
