<?php

class infoCardsController extends mainController
{
    protected static $infoCardsModel;
    protected static $CrudPDO;
    protected static $returnArray;

    public function __construct($returnArray)
    {
        self::$infoCardsModel = new infoCardsModel();
        self::$CrudPDO = new CrudPDO();
        self::$returnArray = $returnArray;
    }

    public static function add()
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['session_email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'API Key does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['user_apiKey']);
            unset($postArray['tableName']);

            $add = self::$infoCardsModel::add($tableName, $postArray);

            if (@!$add['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Data added successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Data could not be added';
                self::$returnArray['exception'] = $add['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }

    public static function update(){
        if(isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['session_email']);

            if(!$apiOk) {
                self::$returnArray['message'] = 'API Key does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['user_apiKey']);
            unset($postArray['tableName']);

            $update = self::$infoCardsModel::update($tableName, $postArray);

            if(@!$update['Error']) {
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

    public static function delete()
    {
        if(isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['session_email']);

            if(!$apiOk) {
                self::$returnArray['message'] = 'API Key does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['user_apiKey']);
            unset($postArray['tableName']);

            $delete = self::$infoCardsModel::delete($tableName, $postArray);

            if(@!$delete['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Data deleted successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Data could not be deleted';
                self::$returnArray['exception'] = $delete['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }

}