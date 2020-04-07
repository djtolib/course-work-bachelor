<?php

class NewsController
{
    public static  function actionIndex()
    {
        $newslist = array();
        $newslist = News::getNewsList();
        require_once("/views/news.php");
        return true;
    }
    public static function actionView($category,$id)
    {
        
        $newsitem = News::getNewsById($id);
        require_once("/views/onenews.php");
        return true;
    }
}