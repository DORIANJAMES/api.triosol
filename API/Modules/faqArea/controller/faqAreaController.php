<?php

class faqAreaController extends mainController
{
    protected static $faqAreaModel;
    protected static $CrudPDO;
    protected static $returnArray;

    public function __construct($returnArray)
    {
        self::$returnArray = $returnArray;
        self::$CrudPDO = new CrudPDO();
        self::$faqAreaModel = new faqAreaModel();
    }

    public static function update()
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['user_apiKey']);
            unset($postArray['session_email']);

            if(!$apiOk) {
                self::$returnArray['message'] = 'Api Key is not valid';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);
            $update = self::$faqAreaModel::update($tableName, $postArray);

            if(@!$update['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Data updated successfully.';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = $update['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }

}