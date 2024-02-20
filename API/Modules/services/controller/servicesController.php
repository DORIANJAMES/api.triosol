<?php

class servicesController extends mainController
{
    protected static $servicesModel;
    protected static $returnArray;
    protected static $CrudPDO;

    public function __construct($returnArray)
    {
        self::$servicesModel = new servicesModel();
        self::$returnArray = $returnArray;
        self::$CrudPDO = new CrudPDO();
    }

    public static function update()
    {
        if (isset($_POST)) {
            $postArray = mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['session_email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'API Key does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);
            unset($postArray['user_apiKey']);

            $update = self::$servicesModel::update($tableName, $postArray);

            if (@!$update['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Data updated successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Data could not be updated';
                self::$returnArray['exception'] = $update['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }
}