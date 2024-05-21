<?php

class model_login extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function check_data($post) 
    {
        $username = $post["username"];
        $password = $post["password"];
        if (empty($username) || empty($password)) {
            $response = array(
                "status"=> false,
                "message"=> "please fill in all fields"
            );
            return json_encode($response);
        }else {
            $sql = "SELECT password FROM users WHERE username=?";
            $parms = array($username);
            $result = $this->doSelect($sql, $parms);
            if (count($result) > 0) {
                if (hash('sha256', $password) == $result[0]['password']) {
                    $response = array(
                        'status'=> true,
                        'message'=> 'succesfully logined'
                    );
                    // Model::session_set('username', $_POST['username']);
                    return json_encode($response);
                } else {
                    $response = array(
                        'status'=> false,
                        'message'=> 'password or username is not correct'
                    );
                    return json_encode($response);
                }
            } else {
                $response = array(
                    'status'=> false,
                    'message'=> 'password or username is not correct'
                );
                return json_encode($response);
            }
        }
}
}
?>