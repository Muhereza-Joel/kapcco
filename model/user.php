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


    public static function login(){
        $request = Request::capture();
        
        $username = $request->input('username');
        $password = $request->input('password');

        if(!empty($username) && !empty($password)){
            
            $new_user = new User();
            $user = $new_user->get_user($username, $username);

            if($user && password_verify($password, $user['password'])){
                Session::start();
                if($user['profile_created'] == true){
                    $user_data = self::get_user_data($user['id']);
                    Session::set('user_id', $user['id']);
                    Session::set('username', $user['username']);
                    Session::set('avator', $user_data['photo']);
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
                      'username' => $user['username']
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
}

?>