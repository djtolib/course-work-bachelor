<?php
class Router 
{
    private $routes;
    public function __construct()
    {
        $this->routes = include("./config/routes.php");
    }
    private function getUri()
    {
        if(!empty($_SERVER["REQUEST_URI"]))
            return $_SERVER["REQUEST_URI"];
    }
    public function run()
    {
        
        $uri = $this->getUri();
        
        foreach($this->routes as $uripat => $path)
        {
           
            if(preg_match("~$uripat~",$uri))
                {
                    
                    $res = preg_replace("~$uripat~",$path,$uri);
                    $res = trim($res,"/");
                    $segments = explode("/",$res);
                    $controllername = strtolower(array_shift($segments));
                    
                    $actionindex = strtolower(array_shift($segments));
                    if(file_exists("controllers/".$controllername.".php"))
                        include("controllers/".$controllername.".php");
                    else 
                    {
                        echo "<br>File controllers/".$controllername.".php not exists<br>";
                        break;
                    }
                    $classname= ucfirst($controllername)."Controller";
                    $method = "action".$actionindex;
                    //echo $controllername.$actionindex;
                    $controller = new $classname;
                    $method_res = call_user_func_array(array($classname,$method),$segments);
                    //echo "<br>Meth_REs: $methon_res <br>";
                    break;
                }
        }
    }
}
?>
