<?php

class model_addcontact extends Model {

    function __construct()
    {
        parent::__construct(); 
    }

    function addcontact($username, $post) {
        $id = Model::session_get('id');
        $phone = $post['phone'];
        $name = $post['name'];
        $sql = "SELECT id FROM users WHERE username=?";
        $params = array($phone);
        $result = $this->doSelect($sql, $params);
        $existResultSQL = "SELECT contact_id FROM contacts where user_id=?";
        $existResultPARAMS = array("id");
        $existResult = $this->doSelect($existResultSQL, $existResultPARAMS);
        if (count($existResult) > 0) {
            $response = array(
                "status"=> false,
                "message"=> "this user has been already in your contact list"    
            );
            return json_encode($response);
        } else if (count($result) > 0) {
            if ($id == $result[0]['id']) {
                $response = array(
                    'status'=> false,
                    'message'=> "you can't add yourself to your contact list :)"
                );
            } else {
                $sql = "INSERT INTO contacts (user_id,contact_id,contact_name) VALUES (?,?,?)";
                $params = array($id, $result[0]['id'], $name);
                $this->doQuery($sql, $params);
                $response = array(
                    "status"=> true,
                    "message"=> "this user has added to your contact list with $name name"
                );
                return json_encode($response);
            }
        } else {
            $response = array(
                "status"=> false,
                "message"=> "user not found"
            );
            return json_encode($response);
        }
    }
}

