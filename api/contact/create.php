<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, emailization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Contact.php';
  include_once '../../http/Response.php';
  include_once '../../http/Request.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact object
  $contact = new Contact($db);

  // Instantiate responese objec
  $response = new Response();

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $contact->name = $data->name;
  $contact->last_name = $data->last_name;
  $contact->email = $data->email;
  $contact->phones = json_encode( $data->phones);

  if($contact->name == '' || $contact->last_name == '' || $contact->email == '' || $contact->phones == ''){

    $response->set_response(400);

  } else{

    // Create contact
    if($contact->create()) {
      
      $response->response_ok();

    } else {

      $response->set_response(500);

    }

  }



