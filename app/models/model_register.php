<?php

class model_register extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insert_data($post) {

        $username = $post["username"];
        $password = $post["password"];
        $confpassword = $post["confpassword"];

        if (empty($username) || empty($password) || empty($confpassword)) {
            $response = array(
                "status"=> false,
                "message"=> "please fill in all fields"
            );
            return json_encode($response);
        }
            
        if ($confpassword != $password) {
            $response = array(
                "status"=> false,
                "message"=> "password and re entered passwor does not match"
            );
            return json_encode($response);
        } else {
            $sql = "SELECT * from users WHERE username=?";
            $params = array($username);
            $result = $this->doSelect($sql, $params);
            if (sizeof($result) > 0) {
                $response = array(
                    "status"=> false,
                    "message"=> "username already taken"
                );
                return json_encode($response);
            } else {
                $sql = "INSERT INTO users (username,password,registered_date) VALUES (?,?,?)";
                $params = array($username, hash('sha256', $password), self::jalali_date("Y/m/d"));
                $this->doQuery($sql, $params);
                $response = array(
                    "status"=> true,
                    "message"=> "succefully registered"
                );
                // Model::session_set('username', $_POST['username']);
                return json_encode($response);
            }
    }
    }
}
?>