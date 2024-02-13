<?php

class commentController extends mainController
{
    protected static $homeModel;
    protected static $CrudPDO;

    protected static $returnArray;

    public function __construct($returnArray)
    {
        self::$returnArray = $returnArray;
        self::$homeModel = new homeModel();
        self::$CrudPDO = new CrudPDO();
    }

    public static function list($userId=null, $commentId = null)
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            if($userId != null) {
                $postArray['comments_user'] = htmlspecialchars($userId);
            }
            if($commentId != null) {
                $postArray['comments_id'] = htmlspecialchars($commentId);
            }
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $_SESSION['email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'APIKey does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }
            $tableName = $postArray['tableName'];
            unset($postArray['user_apiKey']);
            unset($postArray['tableName']);

            $data = self::$homeModel::home($tableName, $postArray);
            if (@!$data['Error']) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Required data fetched successfully';
                self::$returnArray['data'] = $data;
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Required data could not be fetched';
                self::$returnArray['exception'] = $data['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }

    public static function add()
    {
        if (isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $_SESSION['email']);

            if (!$apiOk) {
                self::$returnArray['message'] = 'APIKey does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $emailControl = self::$CrudPDO::dbControl('users', true, false, '*', 'users_email', $postArray['comments_email'], false);

            if (!$emailControl) {
                $postArray['comments_user'] = 0;
                print_r(json_encode($postArray));
            } else {
                $postArray['comments_user'] = $emailControl['users_id'];
                $postArray['comments_email'] = $emailControl['users_email'];
                $postArray['comments_name'] = $emailControl['users_name'];
                $postArray['comments_surname'] = $emailControl['users_surname'];
                print_r(json_encode($postArray));
            }

            $tableName = $postArray['tableName'];
            unset($postArray['user_apiKey']);
            unset($postArray['tableName']);

            $add = self::$CrudPDO::addToDB($tableName, $postArray);

            if ($add) {
                self::$returnArray['status'] = true;
                self::$returnArray['message'] = 'Comment added successfully';
                print_r(json_encode(self::$returnArray));
            } else {
                self::$returnArray['message'] = 'Comment could not be added';
                print_r(json_encode(self::$returnArray));
            }
        }
    }


}