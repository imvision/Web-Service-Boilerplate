<?php
// user global instance of application
global $app;

// Test method to check if service is running
$app->registerService( 'test' );

function test() {
    $r = responseObject();
    $r->response['status'] = APP_OK;
    $r->response['message'] = 'Application is healthy!';
}
