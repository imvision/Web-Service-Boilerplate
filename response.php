<?php

class Response {

    public $response = array('status' => 0, 'message' => 'Invalid request' );

    public function Send() {
        header('Content-Type: application/json');
        echo json_encode(array('result' => $this->response));
        exit;
    }
}
