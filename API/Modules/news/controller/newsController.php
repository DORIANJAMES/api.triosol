<?php

class newsController extends mainController
{
    protected static $newsModel;
    protected static $returnArray;
    protected static $CrudPDO;

    public function __construct($returnArray)
    {
        self::$returnArray = $returnArray;
        self::$newsModel = new newsModel();
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

            $update = self::$newsModel::update($tableName, $postArray);

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

    public static function delete()
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

            unset($postArray['user_apiKey']);

            $delete = self::$newsModel::delete($postArray);

            if (@!$delete['Error']) {
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

    public static function add()
    {
        if (isset($_POST)) {
            $postArray = mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['session_email']);
            unset($postArray['user_apiKey']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'API Key does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $data = self::$newsModel::add($postArray);

            if (@!$data['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Data added successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Data could not be added';
                self::$returnArray['exception'] = $data['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }
}