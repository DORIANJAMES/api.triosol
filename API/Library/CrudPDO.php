<?php

class CrudPDO
{
    private static $db;
    private $dbhost = DBHOST;
    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;

    function __construct()
    {
        try {
            self::$db = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->exec("SET CHARACTER SET utf8");
            self::$db->exec("SET NAMES utf8");
        } catch (PDOException $e) {
            return ["Error" => $e->getMessage()];
        }
    }

    public static function apiKeyControl($apiKey, $users_email = null)
    {
        try {
            $apiKeyControl = self::$db->prepare("SELECT user_apiKey_key from user_apiKey WHERE user_apiKey_key = ? AND users_id = (SELECT users_id FROM users WHERE users_email = ?)");
            $apiKeyControl->execute(array($apiKey, $users_email));
            return $apiKeyControl->rowCount();
        } catch (Exception $e) {
            return ["Error" => $e->getMessage()];
        }
    }

    public static function dbControl($tableName, $returnType = false, $except = false, $columnName = '*', $rowName = null, $toBeControlled = null, $isArray = false, $onlyOne=true)
    {
        if (!$toBeControlled && !$rowName && $returnType == true && $except == false && !$isArray) {
            try {
                $control = self::$db->prepare("SELECT {$columnName} FROM {$tableName}");
                $control->execute();
                return $control->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return ["Error" => $e->getMessage()];
            }
        } else if ($tableName && $rowName && $toBeControlled && $returnType == true && $except == false && !$isArray) {

            try {
                $control = self::$db->prepare("SELECT {$columnName} FROM {$tableName} WHERE {$rowName} = ?");
                $control->execute(array($toBeControlled));
                return $onlyOne?$control->fetch(PDO::FETCH_ASSOC):$control->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["Error" => $e->getMessage()];
            }
        } else if ($tableName && $rowName && $toBeControlled && $returnType == false && $except == false && !$isArray) {
            try {
                $control = self::$db->prepare("SELECT {$columnName} FROM {$tableName} WHERE {$rowName} = ?");
                $control->execute(array($toBeControlled));
                return $control->rowCount();
            } catch (Exception $e) {
                return ["Error" => $e->getMessage()];
            }
        } else if ($tableName && $rowName && $toBeControlled && $columnName && $returnType == true && $except == true && !$isArray) {
            try {
                $control = self::$db->prepare("SELECT {$columnName} FROM {$tableName} WHERE {$rowName} != ?");
                $control->execute(array($toBeControlled));
                return $control->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return ["Error" => $e->getMessage()];
            }
        } else if ($tableName && $rowName && $toBeControlled && !$returnType && !$except && $isArray) {
            try {
                $control = self::$db->prepare("SELECT {$columnName} FROM {$tableName} WHERE {$rowName[0]} = ? AND {$rowName[1]} = ?");
                $control->execute(array($toBeControlled['users_email'], $toBeControlled['users_password']));
                $count = $control->rowCount();
                if ($count == 1) {
                    return true;
                } else {
                    return ['Error' => 'One or more of your information is wrong.'];
                }
            } catch (PDOException $e) {
                return ["Error" => $e->getMessage()];
            }
        } else {
            exit("Error: Please check your parameters.");
        }
    }

    public static function addToDB(string $tableName, array $dbValues)
    {
        $dbValue = mHelper\mDataBase::defaultDbValues($dbValues);
        $sqlQuery = "INSERT INTO {$tableName}({$dbValue['givenKeys']}) values({$dbValue['sqlValues']})";

        try {
            $add = self::$db->prepare($sqlQuery);
            $addingResult = $add->execute($dbValue['givenValues']);
            return $addingResult;
        } catch (PDOException $e) {
            return ["Error" => $e->getMessage()];
        }
    }

    public static function deleteFromDB($tableName, $deleteID)
    {
        if (self::dbControl($tableName, true, false, '*', "{$tableName}_id", $deleteID)) {

            try {
                $delete = self::$db->prepare("DELETE from {$tableName} WHERE {$tableName}_id = ?");
                $result = $delete->execute(array($deleteID));
                return $result;
            } catch (Exception $e) {
                return ["Error" => $e->getMessage()];
            }
        } else {
            return false;
        }
    }

    public static function updateOnDB($tableName, array $values, $id)
    {
        unset($values[$tableName . '_id']);

        $dbValue = mHelper\mDataBase::updateDbValues($values);
        $sqlQuery = "UPDATE {$tableName} SET {$dbValue['updateValues']} WHERE {$tableName}_id = {$id}";

        try {
            $update = self::$db->prepare($sqlQuery);
            $result = $update->execute($dbValue['givenValues']);
            return $result;
        } catch (PDOException $e) {
            return ["Error" => $e->getMessage()];
        }


    }
}