<?php

class model_index extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addcontact($post) {

        $id = Model::session_get('id');
        $phone = $post["phone"];
        $name = $post["name"];

        $sql = "SELECT id FROM users WHERE username=?";
        $params = array($phone);
        $result = $this->doSelect($sql, $params);

        $existResultSQL = "SELECT contact_id FROM contacts where user_id=?";
        $existResultPARAMS = array($id);
        $existResult = $this->doSelect($existResultSQL, $existResultPARAMS);

        if (count($result) > 0) {
            if ($id == $result[0]['id']) {
                $response = array(
                    "status"=> false,
                    "message"=> "you cant add yourself as your contact!"
                );
                return json_encode($response);
            } else {
                if (count($existResult) > 0) {
                    $mergedExist = [];
                    for ($i = 0; $i < count($existResult); $i ++) {
                        $mergedExist[] = $existResult[$i]['contact_id'];
                    }
                    if (in_array($result[0]['id'], $mergedExist)) {
                        $response = array(
                            "status"=> false,
                            "message"=> "this user is existed in your contact list"
                        );
                        return json_encode($response);
                    } else {
                        $sql = "INSERT INTO contacts (user_id, contact_id, contact_name) VALUES (?,?,?)";
                        $params = array($id, $result[0]['id'], $name);
                        $this->doQuery($sql, $params);

                        $response = array(
                            "status"=> true,
                            "message"=> "succefully added to your contacts"
                        );
                        return json_encode($response);
                    }
                } else {

                    $sql = "INSERT INTO contacts (user_id, contact_id, contact_name) VALUES (?,?,?)";
                    $params = array($id, $result[0]['id'], $name);
                    $this->doQuery($sql, $params);

                    $response = array(
                        "status"=> true,
                        "message"=> "succefully added to your contacts"
                    );
                    return json_encode($response);

                }
            }
        } else {
                $response = array(
                    "status"=> false,
                    "message"=> "user not found"
                );
                return json_encode($response);
        }
    }

    function getcontact() {

        $id = Model::session_get('id');
        $sql = "SELECT * FROM contacts WHERE user_id=?";
        $params = array($id);
        $result = $this->doSelect($sql, $params);

        $contacstData = [];
        for ($i = 0; $i < count($result); $i ++) {
            $this_contact = $result[$i];
            $contact_id = $this_contact['contact_id'];
            $contact_name = $this_contact['contact_name'];
            $contactsData[] = array(
                "name"=> $contact_name,
                "src"=> 'public/images/default-profile.png',
                "text"=> '-',
                "id"=> $contact_id
            );
        }

        $response = array(
            "status"=> true,
            "message"=> "nice",
            "data"=> $contactsData
        );
        return json_encode($response);
    }

    function editcontact($post) {
        $new_name = $post['new-name'];
        $contact_id = $post['contact-id'];
        $sql = "UPDATE contacts SET contact_name=? WHERE contact_id=?";
        $params = array($new_name, $contact_id);
        $this->doQuery($sql, $params);
        $response = array(
            "status"=>true,
            "message"=>"contact succefully edited"
        );
        return json_encode($response);
    }

}



?>