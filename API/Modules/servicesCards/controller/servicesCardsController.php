<?php

class servicesCardsController extends mainController
{
    protected static $returnArray;
    protected static $CrudPDO;
    protected static $servicesCardsModel;

    public function __construct($returnArray)
    {
        self::$CrudPDO = new CrudPDO();
        self::$servicesCardsModel = new servicesCardsModel();
        self::$returnArray = $returnArray;
    }

    public static function update()
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['user_apiKey']);
            unset($postArray['session_email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'Api key is not valid';
                return self::$returnArray;
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);

            $update = self::$servicesCardsModel::update($tableName, $postArray);

            if(@!$update['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Updated successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Update failed';
                self::$returnArray['exception'] = $update['Error'];
                print_r(json_encode(self::$returnArray));
            }

        }
    }
    public static function add(){
        if(isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['user_apiKey']);
            unset($postArray['session_email']);

            if(!$apiOk) {
                self::$returnArray['message'] = 'Api key is not valid';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);

            $add = self::$servicesCardsModel::add($tableName, $postArray);

            if(@!$add['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Added successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Add failed';
                self::$returnArray['exception'] = $add['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }
    public static function delete(){
        if(isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['user_apiKey']);
            unset($postArray['session_email']);

            if(!$apiOk) {
                self::$returnArray['message'] = 'Api key is not valid';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);
            $id = $postArray['id'];
            unset($postArray['id']);

            $delete = self::$servicesCardsModel::delete($tableName, $id);

            if(@!$delete['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Deleted successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Delete failed';
                self::$returnArray['exception'] = $delete['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }
}