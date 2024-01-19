<?php
class homeController extends mainController{
    protected static $homeModel;
    protected static $CrudPDO;

    protected static $returnArray;

    public function __construct($returnArray)
    {
        self::$returnArray = $returnArray;
        self::$homeModel = new homeModel();
        self::$CrudPDO = new CrudPDO();
    }

    public static function home()
    {
        if(isset($_POST)) {
            $postArray = mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $_SESSION['email']);

            if(!$apiOk) {
                self::$returnArray['message'] = 'APIKey does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }

            $id = $postArray['id'] ?? null;
            $rowName = $postArray['rowName'] ?? $postArray['tableName'] . '_id';

            $data = self::$homeModel::home($postArray['tableName'], $id, $rowName, false);

            if (@!$data['Error']){
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
}