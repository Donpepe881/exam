<?php
spl_autoload_register(function(string $type)
{
    if(file_exists("classes/$type.php"))
    {
        require_once("classes/$type.php");
    }
    elseif(file_exists("classes/APIFunctions/$type.php"))
    {
        require_once("classes/APIFunctions/$type.php");
    }
    elseif(file_exists("classes/Interfaces/$type.php"))
    {
        require_once("classes/Interfaces/$type.php");
    }
    elseif(strpos($type, "IHTTP") === 0)
    {
        require_once("classes/Interfaces/HTTPMethods.php");
    }
});