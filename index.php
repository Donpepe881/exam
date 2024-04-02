<?php
require_once ("config.php");
require_once ("autoloader.php");
Model::Connect();
Controller::DoCall();
View::RenderAndPrint();