<?php

namespace kapcco\model;

use kapcco\core\DatabaseConnection;
use kapcco\core\Request;
use kapcco\core\Session;

class User
{
    private $database;

    public function __construct()
    {
        $this->get_database_connection();
    }

    private function get_database_connection()
    {
        $database_connection = new DatabaseConnection(getenv('DB_HOST'), getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $this->database = $database_connection->get_connection();
    }

    public function check_password($password)
    {
        $new_user = new User();
        $user = $new_user->get_user(Session::get('username'), Session::get('email'));

        if ($user && password_verify($password, $user['password'])) {
            $response = ['message' => 'Password matches your current password'];
            $httpStatus = 200;
            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => 'Password does not match your current password'];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }
    }


    public  function login()
    {
        $request = Request::capture();

        $username = $request->input('username');
        $password = $request->input('password');

        if (!empty($username) && !empty($password)) {

            $new_user = new User();
            $user = $new_user->get_user($username, $username);

            if ($user && password_verify($password, $user['password'])) {
                Session::start();
                if ($user['profile_created'] == true) {
                    $user_data = $this->get_user_data($user['id']);
                    Session::set('user_id', $user['id']);
                    Session::set('username', $user['username']);
                    Session::set('email', $user['email']);
                    Session::set('avator', $user_data['image_url']);
                    Session::set('role', $user['role']);
                } else {
                    Session::set('user_id', $user['id']);
                    Session::set('username', $user['username']);
                    Session::set('email', $user['email']);
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
            } else {

                // Authentication failed
                $response = ['message' => 'Wrong username or password, try again'];
                $httpStatus = 401;
            }
        }

        Request::send_response($httpStatus, $response);
    }

    private function get_user($username, $email)
    {
        $query = "SELECT * FROM app_users WHERE username = ? OR email = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();

        return $user;
    }

    public function get_user_data($id)
    {
        $query = "SELECT * FROM user_profile WHERE user_id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user_profile = $result->fetch_assoc();

        $stmt->close();

        return $user_profile;
    }

    public function get_all_user_data($id)
    {
        $query = "SELECT app_users.id, app_users.username, app_users.email, app_users.role, user_profile.fullname, user_profile.nin, user_profile.country, user_profile.district, user_profile.village, user_profile.phone, user_profile.image_url, user_profile.creared_at, user_profile.updated_at 
                  FROM `app_users` LEFT JOIN user_profile 
                  ON app_users.id = user_profile.user_id 
                  WHERE app_users.id = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user_profile = $result->fetch_assoc();

        $stmt->close();

        return $user_profile;
    }

    public function add_user()
    {
        $request = Request::capture();

        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $new_user = new User();
        $user = $new_user->get_user($username, $email);

        if ($user) {
            $response = ['message' => 'Username or email already taken..'];
            $httpStatus = 401;

            Request::send_response($httpStatus, $response);
        }

        if (!$user) {
            $query = "INSERT INTO app_users(username, email, password) VALUES(?, ?, ?)";

            $stmt = $this->database->prepare($query);
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            $stmt->execute();

            $response = ['message' => 'Account created, you can now login'];
            $httpStatus = 200;

            Request::send_response($httpStatus, $response);
        }
    }

    public function check_email()
    {
        $request = Request::capture();

        $email = $request->input('email');

        $query = "SELECT email FROM app_users WHERE email LIKE ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $email_exists = $result->fetch_assoc();


        if ($email_exists) {
            $response = ['message' => 'Email exists already in the system'];
            $httpStatus = 401;

            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => 'No body has the same email in the system'];
            $httpStatus = 200;

            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function check_nin()
    {
        $request = Request::capture();

        $nin = $request->input('nin');

        $query = "SELECT nin FROM user_profile WHERE nin LIKE ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $nin);
        $stmt->execute();

        $result = $stmt->get_result();
        $nin_exists = $result->fetch_assoc();


        if ($nin_exists) {
            $response = ['message' => 'NIN exists already in the system'];
            $httpStatus = 401;

            Request::send_response($httpStatus, $response);
        } else {
            $response = ['message' => 'No body has the same NIN in the system'];
            $httpStatus = 200;

            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function save_profile()
    {
        $request = Request::capture();

        $image_url = $request->input('image_url');
        $fullname = $request->input('fullName');
        $nin = $request->input('nin');
        $country = $request->input('country');
        $district = $request->input('district');
        $village = $request->input('village');
        $phone = $request->input('phone');

        $user_id = Session::get('user_id');

        $insert_query = "INSERT INTO user_profile(fullname, nin, country, district, village, phone, image_url, user_id)
                 VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $this->database->begin_transaction();

        $stmt = $this->database->prepare($insert_query);
        $stmt->bind_param("sssssssi", $fullname, $nin, $country, $district, $village, $phone, $image_url, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt2 = $this->database->prepare("UPDATE app_users SET profile_created = 1 WHERE id = ?");
            $stmt2->bind_param("i", $user_id);
            $stmt2->execute();

            if ($stmt2->affected_rows > 0) {
                $this->database->commit();
                Session::set('avator', $image_url);

                $response = ['message' => 'Profile data saved successfully', 'status' => '200'];
                $httpStatus = 200;
                Request::send_response($httpStatus, $response);
            } else {
                $this->database->rollback();

                $response = ['message' => 'Failed To Save Profile Data due to update failure'];
                $httpStatus = 401;
                Request::send_response($httpStatus, $response);
            }

            $stmt2->close();
        } else {

            $this->database->rollback();
            $response = ['message' => 'Failed To Save Profile Data due to insert failure'];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }

        $stmt->close();
    }

    public function update_profile()
    {
        $request = Request::capture();

        $user_id = $request->input('current-user-id');
        $fullname = $request->input('fullName');
        $nin = $request->input('nin');
        $email = $request->input('email');
        $country = $request->input('country');
        $district = $request->input('district');
        $village = $request->input('village');
        $phone = $request->input('phone');

        $email_update_query = "UPDATE app_users SET email = ? WHERE id = ?";

        $this->database->begin_transaction();

        $stmt = $this->database->prepare($email_update_query);
        $stmt->bind_param("si", $email, $user_id);
        $stmt->execute();

        echo $this->database->error;

        if ($stmt->affected_rows >= 0) {
            $profile_update_query = "UPDATE user_profile
                                     SET fullname = ?, nin = ?, country = ?, district = ?, village = ?, phone = ?
                                     WHERE user_id = ?";

            $stmt2 = $this->database->prepare($profile_update_query);
            $stmt2->bind_param("ssssssi", $fullname, $nin, $country, $district, $village, $phone,  $user_id);
            $stmt2->execute();

            echo $this->database->error;

            if ($stmt2->affected_rows >= 0) {
                $this->database->commit();

                $response = ['message' => 'Profile data updated successfully', 'status' => '200'];
                $httpStatus = 200;
                Request::send_response($httpStatus, $response);
            } else {
                $this->database->rollback();

                $response = ['message' => 'Failed To Update Profile Data due to update failure'];
                $httpStatus = 401;
                Request::send_response($httpStatus, $response);
            }

            $stmt2->close();
        } else {
            $this->database->rollback();
            $response = ['message' => 'Failed To Update Profile Data due to email update failure'];
            $httpStatus = 401;
            Request::send_response($httpStatus, $response);
        }
    }


    public function update_photo()
    {
        $request = Request::capture();
        $image_url = $request->input("image_url");

        $query = "UPDATE user_profile SET image_url = ? WHERE user_id = ?";
        $current_user = Session::get('user_id');

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("si", $image_url, $current_user);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            Session::set('avator', $image_url);
            $response = ['message' => 'Profile Photo Updated Successfully'];
            $httpStatus = 200;
        } else {
            $response = ['message' => 'Profile Photo Update failed']; //TODO chage alert error class
            $httpStatus = 401;
        }

        Request::send_response($httpStatus, $response);
    }


    public function change_password()
    {
        $request = Request::capture();
        $password = $request->input("newpassword");

        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $current_user_id = Session::get('user_id');

            $query = "UPDATE app_users SET password = ? WHERE id = ?";

            $stmt = $this->database->prepare($query);
            $stmt->bind_param("si", $hashed_password, $current_user_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                Session::destroy();

                $response = ['message' => 'Password Updated Successfully'];
                $httpStatus = 200;
                Request::send_response($httpStatus, $response);
            } else {
                $response = ['message' => 'An Error Occured, Failed to Change Password!'];
                $httpStatus = 401;
                Request::send_response($httpStatus, $response);
            }
        }
    }
}
