<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Contact.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog contact object
  $contact = new contact($db);

  // Blog contact query
  $result = $contact->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any contacts
  if($num > 0) {
    
    $contacts_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $contact_item = array(
        'id' => $id,
        'name' => $name,
        'last_name' => $last_name,
        'email' => $email,
        'phones' => json_decode($phones),
      );

      array_push($contacts_arr, $contact_item);
      
    }

    // Turn to JSON & output
    echo json_encode($contacts_arr);
    

  } else {

    $response->set_response(400);
    
  }
