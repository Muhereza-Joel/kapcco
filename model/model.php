<?php
namespace kapcco\model;

use kapcco\core\DatabaseConnection;
use kapcco\core\Request;
use kapcco\core\Session;

class Model{
    private $database;

    public function __construct()
    {
        $this->get_database_connection();
    }

    private function get_database_connection(){
        $database_connection = new DatabaseConnection(getenv('DB_HOST'), getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $this->database = $database_connection->get_connection();
    }

    public function add_branch(){
        $request = Request::capture();

        $branch_name = $request->input('branch-name');
        $branch_location = $request->input('branch-location');
        $user_id = Session::get('user_id');

        $query = "INSERT INTO branches(branch_name, branch_location, user_id) VALUES(?, ?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssi", $branch_name, $branch_location, $user_id);
        $stmt->execute();

        if(!$this->database->error){
            $response = ['message' => 'Branch added successfully', 'status' => '200'];
            $httpStatus = 200;
    
            Request::send_response($httpStatus, $response);

        }

    }
}
?>