<?php
class Validator
{
    public static function isEmailValid($mail)
    {
        if(filter_var($mail,FILTER_VALIDATE_EMAIL))
            return true;
        return false;
    }
    public static function isNameValid($name)
    {
        if(strlen($name)>2)
            return true;
        return false;
    }
    public static function isPasswordValid($password)
    {
        if(strlen($password)>2)
            return true;
        return false;
    }
    public static function isEmailExists($email)
    {
        $db = Db::getConnection();
        $sql = "SELECT count(*) FROM user WHERE email = :email";
        $res = $db->prepare($sql);
        $res->bindParam(":email",$email,PDO::PARAM_STR);
        $res->execute();
        if($res->fetchColumn())
            return true;
        return false;
    }
}