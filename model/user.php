<?php
namespace kapcco\model;

use kapcco\core\DatabaseConnection;
use kapcco\core\Request;
use kapcco\core\Session;

class User{
    private $database;

    public function __construct()
    {
        $this->get_database_connection();
    }

    private function get_database_connection(){
        $database_connection = new DatabaseConnection('localhost', 'kapcco_store_db', 'root', '');
        $this->database = $database_connection->get_connection();
    }


    public  function login(){
        $request = Request::capture();
        
        $username = $request->input('username');
        $password = $request->input('password');

        if(!empty($username) && !empty($password)){
            
            $new_user = new User();
            $user = $new_user->get_user($username, $username);

            if($user && password_verify($password, $user['password'])){
                Session::start();
                if($user['profile_created'] == true){
                    $user_data = $this->get_user_data($user['id']);
                    Session::set('user_id', $user['id']);
                    Session::set('username', $user['username']);
                    Session::set('avator', $user_data['image_url']);
                    Session::set('role', $user['role']);
                    
                  } else{
                    Session::set('user_id', $user['id']);
                    Session::set('username', $user['username']);
                    Session::set('role', $user['role']);
      
                  }
      
      
                  $response = [
                      'message' => 'Authentication successful',
                      'role' => $user['role'],
                      'profileCreated' => $user['profile_created'],
                      'username' => $user['username'],
                      'approved' => $user['approved']
                  ];
                  $httpStatus = 200;
            } else{

                // Authentication failed
                $response = ['message' => 'Wrong username or password, try again'];
                $httpStatus = 401;
            }

        }

        Request::send_response($httpStatus, $response);

    }

    private function get_user($username, $email) {
        $query = "SELECT * FROM app_users WHERE username = ? OR email = ?";
        
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $stmt->close();
        
        return $user;
      }

      public function get_user_data($id){
        $query = "SELECT * FROM user_profile WHERE user_id = ?";
      
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
      
        $result = $stmt->get_result();
        $user_profile = $result->fetch_assoc();
      
        $stmt->close();
      
        return $user_profile;
      }

      public function add_user(){
        $request = Request::capture();
        
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $new_user = new User();
        $user = $new_user->get_user($username, $email);

        if($user){
            $response = ['message' => 'Username or email already taken..'];
            $httpStatus = 401;

            Request::send_response($httpStatus, $response);

        }
        
        if(!$user){
            $query = "INSERT INTO app_users(username, email, password) VALUES(?, ?, ?)";
            
            $stmt = $this->database->prepare($query);
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            $stmt->execute();

            $response = ['message' => 'Account created, you can now login'];
            $httpStatus = 200;
            
            Request::send_response($httpStatus, $response);
        }

      }

      public function check_nin(){
        $request = Request::capture();
        
        $nin = $request->input('nin');

        $query = "SELECT nin FROM user_profile WHERE nin LIKE ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $nin);
        $stmt->execute();

        $result = $stmt->get_result();
        $nin_exists = $result->fetch_assoc();

        $stmt->close();

        if($nin_exists){
            $response = ['message' => 'NIN exists already in the system'];
            $httpStatus = 401;
            
            Request::send_response($httpStatus, $response);
        }else{
            $response = ['message' => 'No body has the same NIN in the system'];
            $httpStatus = 200;
            
            Request::send_response($httpStatus, $response);
        }

      }

      public function save_profile(){
        $request = Request::capture();
        
        $image_url = $request->input('image_url');
        $fullname = $request->input('fullName');
        $nin = $request->input('nin');
        $country = $request->input('country');
        $district = $request->input('district');
        $village= $request->input('village');
        $phone = $request->input('phone');

        $user_id = Session::get('user_id');

        $insert_query = "INSERT INTO user_profile(fullname, nin, country, district, village, phone, image_url, user_id)
                 VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $this->database->begin_transaction();

        $stmt = $this->database->prepare($insert_query);
        $stmt->bind_param("sssssssi", $fullname, $nin, $country, $district, $village, $phone, $image_url, $user_id);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $stmt2 = $this->database->prepare("UPDATE app_users SET profile_created = 1 WHERE id = ?");
            $stmt2->bind_param("i", $user_id);
            $stmt2->execute();

            if($stmt2->affected_rows > 0){
                $this->database->commit();
                Session::set('avator', $image_url);

                $response = ['message' => 'Profile data saved successfully', 'status' => '200'];
                $httpStatus = 200;
                Request::send_response($httpStatus, $response);

            } else{
                $this->database->rollback();

                $response = ['message' => 'Failed To Save Profile Data due to update failure'];
                $httpStatus = 401;
                Request::send_response($httpStatus, $response);

            }

            $stmt2->close();

        }else{

            $this->database->rollback();
            $response = ['message' => 'Failed To Save Profile Data due to insert failure'];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);

        }

        $stmt->close();

      }
}

?>