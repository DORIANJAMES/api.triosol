<?php
class categoriesController extends mainController {
    protected static $categoriesModel;
    protected static $CrudPDO;
    protected static $returnArray;

    public function __construct($returnArray)
    {
        self::$categoriesModel = new categoriesModel();
        self::$CrudPDO = new CrudPDO();
        self::$returnArray = $returnArray;
    }

    public static function list (){
        if(isset($_POST)) {
            $postArray = \mHelper\mVariables::mReArray($_POST);
            $apiOk = self::$CrudPDO::apiKeyControl($postArray['user_apiKey'], $_SESSION['email']);

            if(!$apiOk) {
                self::$returnArray['message'] = 'APIKey does not match';
                print_r(json_encode(self::$returnArray));
                return;
            }



            $data = self::$categoriesModel::list($postArray);

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