<?php

date_default_timezone_set('Asia/Qatar');

/**
 * status values
 */
define('APP_OK', true);
define('APP_FAIL', false);

require_once 'registry.php';
require_once 'db.php';
require_once 'response.php';
require_once 'helper.php';
require_once 'web_service.php';


/**
 * Registry will store objects that we need to use all over the application
 */
$registry = Registry::instance();


/**
 * Create Database connection object and store in the registry
 */
$db_connection = DB::connection();
$registry->set( 'connection', $db_connection );


/**
 * Create Response object and store in the registry
 */
$Response = new Response();
$registry->set( 'response', $Response );


/**
 * do we have a valid action?
 */
$action = get_var('action');

if( $action == null ) {
    $Response->response['status'] = APP_FAIL;
    $Response->response['message'] = 'api parameter is required with all requests';
    $Response->Send();
}



// initiate the application
$app = new WebService();


//Load all services
$app->loadServices();


// run application with the requested action and send output
$app->dispatch( $action );
