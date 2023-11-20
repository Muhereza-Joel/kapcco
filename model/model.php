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
            $response = ['message' => 'Store added successfully', 'status' => '200'];
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

    public function get_zone_details($id){

        $query = "SELECT * FROM zones WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $zone_details = $result->fetch_assoc();

        $stmt->close();

        return $zone_details;

    }

    public function edit_zone(){
        $request = Request::capture();

        $zone_name = $request->input('zone-name');
        $zone_location = $request->input('zone-location');
        $parent_branch = $request->input('parent-branch');
        $zone_id = $request->input('zone-id-to-edit');

        $query = "UPDATE zones SET zone_name = ?, zone_location = ?, parent_branch = ? WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('sssi', $zone_name, $zone_location, $parent_branch, $zone_id);
        $stmt->execute();
      
        $response = ['message' => 'Store details updated', 'status' => '200'];
        $httpStatus = 200;
    
        Request::send_response($httpStatus, $response);

        $stmt->close();
    }


    public function delete_zone(){
        $request = Request::capture();

        $id = $request->input('zone-to-delete');

        $query = "DELETE FROM zones WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $response = ['message' => 'Store deleted successfully', 'status' => '200'];
        $httpStatus = 200;
    
        Request::send_response($httpStatus, $response);

        $stmt->close();

    }

    public function get_all_farmers(){
        $query = "SELECT user_profile.id, app_users.id AS farmer_id, app_users.approved, user_profile.fullname, user_profile.phone, user_profile.image_url
                  FROM app_users JOIN user_profile
                  ON app_users.id = user_profile.user_id 
                  WHERE app_users.role = 'Farmer'";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $zones = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $zones;
    }

    public function get_user_details($id){
        $query = "SELECT * FROM user_profile WHERE id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user_details = $result->fetch_assoc();

        $stmt->close();

        return $user_details;
    }

    public function set_current_season(){
        $request = Request::capture();

        $start_date = $request->input('start-date');
        $end_date = $request->input('end-date');

        $start_date_formatted = date('Y-m-d H:i:s', strtotime($start_date));
        $end_date_formatted = date('Y-m-d H:i:s', strtotime($end_date));
        
        $stmt = $this->database->prepare('CALL SetCurrentSeason(?, ?)');
        $stmt->bind_param("ss", $start_date_formatted, $end_date_formatted);
        $stmt->execute();

        $response = ['message' => 'Season Saved Successfully'];
        $httpStatus = 200;
        
        Request::send_response($httpStatus, $response);

        $stmt->close();
    }

    public function set_scale(){
        $request = Request::capture();

        $product_name = $request->input('product-name');
        $product_type = $request->input('product-type');
        $unit_price = $request->input('unit-price');
        $current_season = $request->input('current-season-id');
        $user_id = Session::get('user_id');

        $stmt = $this->database->prepare('CALL InsertOrUpdatePriceScales(?, ?, ?, ?, ?)');
        $stmt->bind_param("ssiii", $product_name, $product_type, $unit_price, $current_season, $user_id);
        $stmt->execute();


        $response = ['message' => 'Scale Saved Successfully'];
        $httpStatus = 200;
        
        Request::send_response($httpStatus, $response);

        $stmt->close();

    }


    public function get_current_season(){
        $query = "SELECT * FROM season WHERE status = 'Ongoing'";

        $stmt = $this->database->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $season = $result->fetch_assoc();

        $stmt->close();

        return $season;
    }

    public function get_scales_for_current_season($id){
        $query = "SELECT * FROM price_scales WHERE season_id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $scales = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $scales;
    }

    public function approve_all($ids){
        $ids = json_decode(urldecode($ids), true);

        $query = "UPDATE app_users SET approved = '1' WHERE id = ?";

        $stmt = $this->database->prepare($query);

        foreach($ids as $id){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->reset();
        }

        
        $response = ['message' => 'Selected Farmers Approved'];
        $httpStatus = 200;
        
        Request::send_response($httpStatus, $response);
        
        $stmt->close();
    }

    public function get_stores_to_assign($id){
        $query = "SELECT z.id AS store_id, z.zone_name, b.branch_name
                  FROM zones z
                  LEFT JOIN store_assignments sa ON z.id = sa.store_id AND sa.farmer_id = ?
                  LEFT JOIN branches b ON z.parent_branch = b.id
                  WHERE sa.id IS NULL OR sa.farmer_id IS NULL
                  ";

         $stmt = $this->database->prepare($query);
         $stmt->bind_param("i", $id);
         $stmt->execute();
 
         $result = $stmt->get_result();
         $stores = $result->fetch_all(MYSQLI_ASSOC);
 
         $stmt->close();
 
         return $stores;

    }

    public function get_farmer_assignments($id){

        $query = "SELECT sa.id AS store_id, z.zone_name, b.branch_name
                  FROM zones z
                  JOIN store_assignments sa ON z.id = sa.store_id AND sa.farmer_id = ?
                  LEFT JOIN branches b ON z.parent_branch = b.id
                  ";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stores = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $stores;          
    }

    public function assign_stores_to_farmer($farmer_id, $Ids) {
  
        $ids = json_decode(urldecode($Ids), true);
        $stmt = $this->database->prepare("CALL assignStoreToFarmer(?, ?)");
        
        foreach ($ids as $id) {
            $stmt->bind_param('ii', $farmer_id, $id);
            $stmt->execute();
            $stmt->reset();
        }
  
        $stmt->close();
        $response = ['message' => 'Assignments Saved'];
        $httpStatus = 200;
  
    Request::send_response($httpStatus, $response);
    
  }

  public function get_stores_by_parent_branch_id($id){
    $query = "SELECT * FROM zones WHERE parent_branch = ?";

    $stmt = $this->database->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $stores = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $stores;
}

}
?>