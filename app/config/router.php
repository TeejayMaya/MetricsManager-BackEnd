<?php

$router = $di->getRouter();

// Define your routes here
/**$router->add( 
    "<URI-Name>", 
    [ 
       "controller" => "<controller-name>", 
       "action"     => "<action-name>", 
    ] 
);**/

$router->handle();
