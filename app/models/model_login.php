<?php

class model_login extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function check_data($post) 
    {
        $phone = $post["phone"];
        $password = $post["password"];
        if (empty($phone) || empty($password)) {
            $response = array(
                "status"=> false,
                "message"=> "please fill in all fields"
            );
            return json_encode($response);
        } else if (!str_starts_with($phone, "09") || !strlen($phone) == 11) {
            $response = array(
                "status"=> false,
                "message"=> "phone number is not valid"
            );
            return json_encode($response);
        } else {
            $sql = "SELECT * FROM users WHERE username=?";
            $parms = array($phone);
            $result = $this->doSelect($sql, $parms);
            if (count($result) > 0) {
                    if (hash('sha256', $password) == $result[0]['password']) {
                        $response = array(
                            'status'=> true,
                            'message'=> 'succesfully logined'
                        );
                        Model::session_set('id', $result[0]['id']);
                        Model::session_set('username', $_POST['phone']);
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