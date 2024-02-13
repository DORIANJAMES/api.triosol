<?php

class loginController extends mainController
{
    protected static $loginModel;
    protected static $CrudPDO;
    protected static $returnArray;

    public function __construct($returnArray)
    {
        self::$loginModel = new loginModel();
        self::$CrudPDO = new CrudPDO();
        self::$returnArray = $returnArray;
    }

    public static function login()
    {
        if (isset($_POST)) {
            $postArray = mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $_SESSION['email']);

            if (!$apiOk) {
                self::$returnArray['message'] = "APIKey does not match";
                print_r(json_encode(self::$returnArray));
                return;
            }

            $tableName = $postArray['tableName'];
            unset($postArray['user_apiKey']);
            unset($postArray['tableName']);
            $postArray['users_password'] = mHelper\mEncoder::mixEncoders($postArray['users_password']);

            $login = self::$loginModel::login($tableName, $postArray);

            if (@!$login['Error']) {
                if ($login){
                    self::$returnArray['status'] = true;
                    self::$returnArray['message'] = 'Login successful';
                    $userDetails = self::$CrudPDO::dbControl($tableName,true, false, '*', 'users_email',$postArray['users_email'],false);
                    unset($userDetails['users_password']);
                    self::$returnArray['data'] = $userDetails;
                    print_r(json_encode(self::$returnArray));
                }
            } else {
                self::$returnArray['message'] = 'Login failed';
                self::$returnArray['exception'] = $login['Error'];
                print_r(json_encode(self::$returnArray));
            }
        }
    }
}