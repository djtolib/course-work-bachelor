<?php
class SiteController
{
    public static function actionindex()
    {
         require_once("/views/index.php");
        return true;
    }
}