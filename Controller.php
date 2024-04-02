<?php

abstract class Controller
{

    public static function DoCall(): void
    {
        global $conf;
        if (isset($_GET[$conf["methodParam"]])) {

            $class = htmlspecialchars($_GET[$conf["methodParam"]]);
            if (class_exists($class, true)) {
                $method = $_SERVER["REQUEST_METHOD"];
                $interfaces = class_implements($class, true);
                if ($interfaces !== false && in_array("IHTTP" . $method, $interfaces)) {
                    $obj = new $class();
                    $obj->$method();
                } else {
                    View::setResponse(new JSONResponse(array("error" => "A hívott szolgáltatás létezik, de ezen a metodikán nem szolgál ki!")));
                }
            } else {
                View::setResponse(new JSONResponse(array("error" => "A hívott szolgáltatás ($class) nem létezik!")));
            }
        } else {
            View::setResponse(new JSONResponse(array("error" => "Nincs kijelölt szolgáltatás!")));
        }
    }
}