<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir,
        $config->application->servicesDir
    ]
)->register();

/** Manual Library Classes Registration 
*$loader->registerClasses(
*    array(
*        "PHPMailer"         => "library/PHPMailer/PHPMailer.php",
*        "Request"         => "app/library/Http/Client/Request.php",
*    )
*);
*$loader->register(); //register autoloader
**/