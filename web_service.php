<?php

class WebService {

    private $services =array();

    /**
     * verify and call the requested action then send response
     */
    public function dispatch( $action ) {
        //
        // retrieve response object
        //
        $response = responseObject();
        //
        // check if this action is callable by public
        //
        if( in_array( $action, $this->services ) ) {
            call_user_func($action);
        } else {
            $response->response['status'] = APP_FAIL;
            $response->response['message'] = 'api method is not available';
        }

        //
        // Send Response
        //
        $response->Send();
    }

    /**
     * Load all services
     */
    public function loadServices() {
        foreach (glob("services/*.php") as $filename) {
            include $filename;
        }
    }

    /**
     * To make a function callable by the public, first it should be registered
     */
    public function registerService( $callback ) {
        if( trim($callback) != "" && function_exists( $callback ) && !in_array( $callback,  $this->services) ) {
            array_push( $this->services, $callback );
        }
    }
}
