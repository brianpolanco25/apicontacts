<?php

class Contact
{

        // DB stuff
        private $conn;
        private $table = 'contacts';
    
        // Contact Properties
        public $id;
        public $name;
        public $last_name;
        public $email;
        public $phones;
    
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }


    public function read()
    {
        $query = "SELECT * FROM contacts " ;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

      // Execute query
        $stmt->execute();
        
        return $stmt;
    }

    public function create()
    {
        
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, last_name = :last_name, email = :email, phones = :phones';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phones = $this->phones;

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phones', $this->phones);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
