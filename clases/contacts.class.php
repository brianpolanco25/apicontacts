<?php

require_once 'connection/connection.php';
require_once 'responses.class.php';

class contacts extends connection
{

    private $table = 'contacts';
    private $id = '';
    private $name = "";
    private $lastname = "";
    private $email = "";
    private $phones = [];


    public function getAll()
    {

        $query = "SELECT id, name, lastname, email, phones FROM " . $this->table;

        return parent::getData($query);

    }

    public function create($json)
    {
        $data = json_decode($json, true);

        $_responses = new responses;

        if(!isset($data['name']) || !isset($data['lastname']) || !isset($data['email']) || !isset($data['phones'])){
            return  $_responses->error_400();
        } else {

            $this->name = $data['name'];
            $this->lastname = $data['lastname'];
            $this->email = $data['email'];

            if( !empty($data['phones'])){
                $this->phones = json_encode($data['phones'], true);
            }else{
                $this->phones = '';
            }

            // Request validation

            if($this->name == '' || $this->lastname == '' || $this->email == '' || $this->phones == ''){

                return  $_responses->error_200('All fields are required');

            }else {

                $resp = $this->store();

                if($resp){

                    $response = $_responses->response;
                    $response['result'] = array ('contactId' => $resp);
                    return  $response;

                }else{

                    return $_responses->error_500();

                }

            }
            
        }
        

    }

    private function store(){

        $query = "INSERT INTO ". $this->table . " (name, lastname, email, phones) 
        VALUES ('" . $this->name . "','" . $this->lastname . "','" . $this->email ."','" . $this->phones . "')";
        
        $resp = parent::nonQueryId($query);

        if($resp){
            return $resp;
        }else {
            return false;
        }
        
    }


    public function delete($json){

    $_responses = new responses;
    $data = json_decode($json,true);

    if(!isset($data['id'])){

        print_r($data['id']);

        return $_responses->error_400();

    }else{

            $this->id = $data['id'];

            $resp = $this->deleteContact();

            if($resp){

                $response = $_responses->response;
                $response["result"] = array(
                    "id" => $this->id
                );

                return $response;

            }else{
                return $_responses->error_404();
            }
        }
    }


    private function deleteContact(){

        $query = "DELETE FROM " . $this->table . " WHERE id= '" . $this->id . "'";

        $resp = parent::nonQuery($query);

        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}