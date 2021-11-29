<?php
require "service/Session.php";
require "service/Form.php";

abstract class Router 
{
    const FORBIDDEN = VIEW_PATH."403.php";
    const NOT_FOUND = VIEW_PATH."404.php";

    /**
     * @return array|false le résultat de l'appel d'une méthode d'un contrôleur, false sinon
     */
    public static function handleRequest()
    {
        //la valeur du param ctrl OU test
        $ctrl = filter_input(INPUT_GET, "ctrl", FILTER_SANITIZE_STRING) ?? DEFAULT_CTRL;
        //la valeur du param action OU index
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) ?? DEFAULT_METHOD;
        //le param id éventuel, null s'il est absent de la requête
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT) ?? null;

        $ctrlName = ucfirst($ctrl)."Controller";//test => TestController
        $ctrlFile = "controller/".$ctrlName.".php";
        //controller/TestController.php

        if(file_exists($ctrlFile)){
            include($ctrlFile);
            $controller = new $ctrlName();//new TestController()

            if(method_exists($controller, $action)){
                //response = ["view" => .../...php, "data" => les données à afficher]
                //C'EST ICI QUE LE CONTROLLER EST APPELE ET QUE SA METHODE EST EXECUTEE
                return $controller->$action($id);
            }
        }
        return false;
    }
}