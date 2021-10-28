<?php

class responses{

    public $response = [
        'status' => 'ok',
        'result' => array()
    ];

    public function error_405()
    {
        $this->response['status'] = 'error';

        $this->response['result'] = array(
            'error_id' => '405',
            'error_log' => "Method not allowed"
        );

        return $this->response;
    }

    public function error_204()
    {
        $this->response['status'] = 'error';
        
        $this->response['result'] = array(
            'error_id' => '204',
            'error_log' => 'NOT CONTENT'
        );

        return $this->response;
    }

    public function error_200($string = '')
    {
        $this->response['status'] = 'error';
        
        $this->response['result'] = array(
            'error_id' => '200',
            'error_log' => $string
        );

        return $this->response;
    }

    public function error_400()
    {
        $this->response['status'] = 'error';
        
        $this->response['result'] = array(
            'error_id' => '400',
            'error_log' => 'BAD REQUEST'
        );

        return $this->response;
    }

    public function error_404()
    {
        $this->response['status'] = 'error';
        
        $this->response['result'] = array(
            'error_id' => '404',
            'error_log' => 'NOT FOUND'
        );

        return $this->response;
    }

    public function error_500()
    {
        $this->response['status'] = 'error';
        
        $this->response['result'] = array(
            'error_id' => '500',
            'error_log' => 'UNEXPECTED INTERNAL SERVER ERROR'
        );

        return $this->response;
    }


}