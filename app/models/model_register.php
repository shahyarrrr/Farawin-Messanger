<?php

class model_register extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insert_data($post) {

        $registered = false;

        $username = $post["username"];
        $password = $post["password"];
        $repassword = $post["conf-password"];
        if ($repassword != $password) {
            echo "password must be match with re entered password";
        } else {
            $sql = "SELECT * from users WHERE username=?";
            $params = array($username);
            $result = $this->doSelect($sql, $params);
            if (sizeof($result) > 0) {
                echo "username already taken";
            } else {
                $registered = true;
                $sql = "INSERT INTO users (username,password,registered_date) VALUES (?,?,?)";
                $params = array($username, hash('sha256', $password), self::jalali_date("Y/m/d"));
                $this->doQuery($sql, $params);
            }
    }
    return $registered;
    }
}
?>