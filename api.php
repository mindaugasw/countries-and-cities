<?php

include 'Startup.php';
list($module, $action, $id) = Startup::Start();

$actionFile = "controls/api/{$module}/{$action}.php";
if (empty($module) || empty($action) || !file_exists($actionFile))
    MiscUtils::APIReturn(['errors'=>['Action could not be completed.']], 400);

include $actionFile;