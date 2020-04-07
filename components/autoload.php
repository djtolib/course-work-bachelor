<?php
function __autoload($className)
{
    $path = array(
    "./models/",
    "./components/"
    );
     $className= strtolower($className);
    foreach($path as $folder)
    {
        if(is_file($folder.$className.".php"))
        {
            require_once($folder.$className.".php");
        } 
    }
}