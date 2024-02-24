<?php

class faqController extends mainController
{

    protected static $faqModel;
    protected static $CrudPDO;
    protected static $returnArray;

    public function __construct($returnArray)
    {
        self::$faqModel = new faqModel();
        self::$CrudPDO = new CrudPDO();
        self::$returnArray = $returnArray;
    }

    public static function add()
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['user_apiKey']);
            unset($postArray['session_email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'Api key is not valid';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);

            $add = self::$faqModel::add($tableName, $postArray);

            if (@!$add['Error']) {
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

    public static function update()
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['user_apiKey']);
            unset($postArray['session_email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'Api key is not valid';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);

            $update = self::$faqModel::update($tableName, $postArray);

            if (@!$update['Error']) {
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

    public static function delete()
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);
            unset($postArray['user_apiKey']);
            unset($postArray['session_email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'Api key is not valid';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['tableName']);

            $delete = self::$faqModel::delete($tableName, $postArray['id']);

            if (@!$delete['Error']) {
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