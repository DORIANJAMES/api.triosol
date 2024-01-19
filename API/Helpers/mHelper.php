<?php

namespace mHelper {
    class Helper
    {
        public static function prePrint($data)
        {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }

        public static function jsonPrint($data)
        {
            print_r(json_encode($data));
            exit();
        }
    }

    class mPostGet
    {
        public static function postVariable($value)
        {
            return isset($_POST[$value]) ? strip_tags($_POST[$value]) : '';
        }

        public static function postIntVariable($value)
        {
            return isset($_POST[$value]) ? intval($_POST[$value]) : 0;
        }

        public static function getVariable($value)
        {
            return isset($_GET[$value]) ? strip_tags($_GET[$value]) : '';
        }

        public static function getIntVariable($value)
        {
            return isset($_GET[$value]) ? intval($_GET[$value]) : 0;
        }

    }

    class mDataBase
    {
        public static function defaultDbValues($dbValues=[] )
        {
            $arrayKeys = array_keys($dbValues);
            $givenKeys = implode(',', $arrayKeys);

            $arrayValues = array_values($dbValues);
            //$givenValues = implode(',', $arrayValues);

            $sqlValues = implode(',', array_fill(0, count($arrayKeys), '?'));

            $defaultDbValues = ['givenKeys'=>$givenKeys, 'givenValues'=>$arrayValues, 'sqlValues'=>$sqlValues];
            return $defaultDbValues;
        }

        public static function updateDbValues(array $dbValues){
            $arrayKeys = array_keys($dbValues);
            $dbArray= mVariables::mReArray($arrayKeys, ' = ?');

            $arrayValues = array_values($dbValues);
            //$givenValues = implode(',', $arrayValues);

            $updateValues = implode(',', $dbArray);

            $updateDbValues = ['givenValues'=>$arrayValues, 'updateValues'=>$updateValues];
            return $updateDbValues;
        }
    }

    class mEncoder
    {
        public static function mixEncoders($user_password)
        {
            return md5(sha1(md5(sha1(md5(md5($user_password))))));
        }
        public static function mPasswordControl($pass) {

            if (strlen($pass) < 8 || strlen($pass) > 16) {
                $error['status'] = false;
                $error['message'] = "Password should be in between 8-16 characters";
                return $error;
            }
            if (!preg_match("/[0-9]+/", $pass)) {
                $error['status'] = false;
                $error['message'] = "Password should contain at least one number";
                return $error;
            }
            if (!preg_match("/[A-Z]+/", $pass)) {
                $error['status'] = false;
                $error['message'] = "Password should contain at least one CAPITAL letter";
                return $error;
            }
            if (!preg_match("/[a-z]+/", $pass)) {
                $error['status'] = false;
                $error['message'] = "Password should contain at least one small letter";
                return $error;
            }
            if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $pass)) {
                $error['status'] = false;
                $error['message'] = "Password should contain at least one special character";
                return $error;
            }
            return true;
        }
    }

    class mVariables{
        public static function mReArray($array, $extraValue=null){
            $newArray = [];
            foreach ($array as $key => $value) {

                if (gettype($value) == 'integer') {
                    $value = intval($value);
                } else {
                    $value = strip_tags($value);
                }
                $newArray[$key] =$value.$extraValue;
            }
            return $newArray;
        }

    }
    class mApiKey{
        public static function mApiKey(){
            $apiKey = bin2hex(uniqid(random_bytes(50)));

            $blocks = str_split($apiKey, 10);

            shuffle($blocks);
            $shuffledKey = implode('', $blocks);

            $apiKeyKey = substr($shuffledKey, 0, 100);
            $lastKey = ["user_apiKey_key" =>$apiKeyKey];

            return $lastKey;
        }
    }

}