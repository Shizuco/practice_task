<?php

class Router{

    private $routes;

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this -> routes = include($routesPath);
    }

    /*
      Возвращает строку запроса
    */
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){
           return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run(){

        $uri = $this->getURI();
        
        foreach($this->routes as $uriPattern => $path){
            if(preg_match("~$uriPattern~", $uri)){

               $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segment = explode('/', $internalRoute);

                $controllerName = array_shift($segment).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_pop($segment));

                $parameters = $segment;

                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;
                //!!!!!!!!
                $result = $controllerObject->$actionName($parameters, $segment);
                if($result != null){
                    break;
                }
            }
        }
    }
}