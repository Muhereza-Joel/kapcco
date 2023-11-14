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

        $stmt->close();

    }

    public function get_all_branches(){
        $query = "SELECT * FROM branches";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $branches = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $branches;
    }

    public function get_branch_details($id){

        $query = "SELECT * FROM branches WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $branch_details = $result->fetch_assoc();

        $stmt->close();

        return $branch_details;

    }

    public function update_branch(){
        $request = Request::capture();

        $branch_name = $request->input('branch-name');
        $branch_location = $request->input('branch-location');
        $branch_id = $request->input('branch-edit-id');

        $query = "UPDATE branches SET branch_name = ?, branch_location = ? WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('ssi', $branch_name, $branch_location, $branch_id);
        $stmt->execute();
      
        $response = ['message' => 'Branch details updated successfully', 'status' => '200'];
        $httpStatus = 200;
    
        Request::send_response($httpStatus, $response);

        $stmt->close();
    }

    public function delete_branch(){
        $request = Request::capture();

        $id = $request->input('branch-to-delete');

        $query = "DELETE FROM branches WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $response = ['message' => 'Branch deleted successfully', 'status' => '200'];
        $httpStatus = 200;
    
        Request::send_response($httpStatus, $response);

        $stmt->close();

    }

    public function add_zone(){
        $request = Request::capture();

        $zone_name = $request->input('zone-name');
        $zone_location = $request->input('zone-location');
        $parent_branch_id = $request->input('parent-branch');

        $user_id = Session::get('user_id');

        $query = "INSERT INTO zones(zone_name, zone_location, parent_branch, user_id) VALUES(?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ssii", $zone_name, $zone_location, $parent_branch_id, $user_id);
        $stmt->execute();

        echo $this->database->error;

        if(!$this->database->error){
            $response = ['message' => 'Zone added successfully', 'status' => '200'];
            $httpStatus = 200;
    
            Request::send_response($httpStatus, $response);

        }

        $stmt->close();
    }

    public function get_all_zones(){
        $query = "SELECT * FROM zones";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $zones = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $zones;
    }
}
?>