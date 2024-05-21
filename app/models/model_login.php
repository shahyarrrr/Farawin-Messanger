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

        $sql = "SELECT password FROM users WHERE username=?";
        $parms = array($username);
        $result = $this->doSelect($sql, $parms);
        if (count($result) > 0) {
            if (hash('sha256', $password) == $result[0]['password']) {
                echo "ok";
                return true;
            } else {
                echo "password or username is not correct";
                return false;
            }
        } else {
            echo "password or username is not correct";
            return false;
        }
    }
}
?>