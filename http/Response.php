<?php

class Response{

    protected $statusTexts = [

        204 => 'No Content', 
        400 => 'Bad Request', 
        404 => 'Not Found', 
        405 => 'Method Not Allowed', 
        500 => 'Internal Server Error',

    ];

    public $response = [
        'status' => 'ok',
        'result' => array()
    ];

    public function response_ok()
    {
            $this->response['result'] = array(
            'code' => 200,
            'log' => "Successfully"

        );

            echo json_encode($this->response);
        
    }

    public function set_response($code)
    {
        if(isset($this->statusTexts[$code])){

            $this->response['status'] = 'error';

            $this->response['result'] = array(
            'error_id' => $code,
            'error_log' => $this->statusTexts[$code]
        );

            echo json_encode($this->response);
        }
    }

}