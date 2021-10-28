<?php

    class connection{

        private $server;
        private $user;
        private $password;
        private $database;
        private $port;

        function __construct()
        {
            $dataList = $this->dataConnection();
            // var_dump($dataList);
            foreach ($dataList as $key => $value)
            {
                $this->server = $value['server'];
                $this->user = $value['user'];
                $this->password = $value['password'];
                $this->database = $value['database'];
                $this->port = $value['port'];
            }

            $this->connection = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);

            if($this->connection->connect_errno)
            {
                echo "There are something wrong with connection";
                die();
            }
        }

        private function dataConnection()
        {
            $path = dirname(__File__);
            $jsonData = file_get_contents($path.'/config');
            return json_decode($jsonData, true );
        }

        private function convertUTF8($array)
        {
            array_walk_recursive($array, function(&$item, $key)
            {
                if(!mb_detect_encoding($item, `utf-8`, true))
                {
                    $item = utf8_encode($item);
                }
            });

            return $array;
        }

        public function getData($query)
        {
            $results = $this->connection->query($query);
            $resultArray = array();
            foreach($results as $key)
            {
                $resultArray[] = $key;

                
            }

            return $this->convertUTF8($resultArray);
        }

        public function nonQuery($query)
        {
            $results = $this->connection->query($query);
            return $this->connection->affected_rows;
        }

        public function nonQueryId($query)
        {
            $results = $this->connection->query($query);
            $rows = $this->connection->affected_rows;

            if($rows >= 1)
            {
                return $this->connection->insert_id;
            }
            else
            {
                return 0;
            }
        }

        protected function encrypt($string)
        {
            return md5($string);
        }

        private function isertToken($user_id){
            $val = true;
            $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
            $date = date('Y-m-d H:i');
            $status = 'active';
            $query = "INSERT INTO users_token(user_id, token, status, date) VALUES('$user_id', '$token', '$status', '$date')";
            $verify = $this->nonQuery($query);

            if($verify){
                return $token;
            }else{
                return false;
            }
        }

    }

?>
