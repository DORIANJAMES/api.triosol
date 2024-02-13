<?php

class optionsController extends mainController
{
    protected static $optionsModel;
    protected static $returnArray;
    protected static $CrudPDO;

    public function __construct($returnArray)
    {
        self::$returnArray = $returnArray;
        self::$optionsModel = new optionsModel();
        self::$CrudPDO = new CrudPDO();
    }

    public static function update()
    {
        $postArray = \mHelper\mVariables::mReArray($_POST);
        $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $postArray['session_email']);

        if (!$apiOk) {
            self::$returnArray['message'] = 'APIKey does not match.';
            print_r(json_encode(self::$returnArray));
            return;
        }

        unset($postArray['user_apiKey']);

        $update = self::$optionsModel::update($postArray);

        print_r(json_encode($update));
    }
}