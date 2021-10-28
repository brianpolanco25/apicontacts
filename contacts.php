<?php

require_once 'clases/responses.class.php';
require_once 'clases/contacts.class.php';

$_responses = new responses;
$_contacts = new contacts;

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $contacts = $_contacts->getAll();
    echo json_encode($contacts, true);
    header('Content-type: application/json');
    http_response_code(200);

}

else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $postBody = file_get_contents("php://input");

    $result = $_contacts->create($postBody);

    $arrayData = $_contacts->create($postBody);

    header('Content-type: application/json');

    if(isset($arrayData['result']['error_id'])){

        $responseCode = $arrayData['result']['error_id'];
        http_response_code($responseCode);

    }else { 

        http_response_code(200);

    }

    echo json_encode($arrayData);

}

else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){


    $postBody = file_get_contents("php://input");
        
    $arrayData = $_contacts->delete($postBody);
        
    header('Content-Type: application/json');

    if(isset($arrayData["result"]["error_id"])){

        $responseCode = $arrayData["result"]["error_id"];
        http_response_code($responseCode);
        
    }else{
        http_response_code(200);
    }

    echo json_encode($arrayData);
}

else{

    header('Content-type: application/json');
    $arrayData = $_responses->error_405();
    echo json_encode($arrayData, true); 

}



