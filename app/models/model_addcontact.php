<?php

class model_addcontact extends Model {

    function __construct()
    {
        parent::__construct(); 
    }

    function addcontact($username, $post) {
        $response = array(
            "status"=> true,
            "message"=> "$username is you and " . $post["phone"] . " is your friend with name " . $post["name"]
        );
        return json_encode($response);
    }
}