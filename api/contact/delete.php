<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Contact.php';
  include_once '../../http/Response.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog contact object
  $contact = new Contact($db);

  // Instantiate responese objec
  $response = new Response();

  // Get raw contacted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $contact->id = $data->id;

  if($contact->id == ""){
    
    $response->set_response(400);

  }else{
    // Delete contact
    if($contact->delete()) {
      
      $response->response_ok();

    } else {

      $response->set_response(500);

    }
  }

  

