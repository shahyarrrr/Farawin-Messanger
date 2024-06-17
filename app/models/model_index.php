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
                "src"=> 'public/images/user-default-image.jpg',
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

    function chatContainer($post) {
        $contact_id = $post['contact_id'];
        $sql = "SELECT contact_name FROM contacts WHERE contact_id=?";
        $params = array($contact_id);
        $result = $this->doSelect($sql, $params);
        $response = array(
            "status"=> true,
            "name"=> $result[0]['contact_name']
        );
        return json_encode($response);
    }

    function sendMessage($post) {
        $message = $this->encrypt($post['message'], 1383);
        $recv_id = $post['contact_id'];
        $sender_id = $_SESSION['id'];
        $sql = "INSERT INTO messages (sender_id, reciver_id, send_date, text) VALUES (?, ?, ?, ?)";
        $params = array($sender_id, $recv_id, self::jalali_date("Y/m/d H:i:s"), $message);
        $this->doQuery($sql, $params);
        $response = array(
            "status"=>true,
            "message"=> $message
        );
        return json_encode($response);
    }

    function refreshChat($post) {

        function addBooleanValue(&$array, $booleanValue) {
            foreach ($array as &$item) {
                $item['boolean'] = $booleanValue;
            }
        }

        $reciver_id = $post['recv_id'];
        $sender_id = $_SESSION['id'];

        $sql = "SELECT id,text FROM messages WHERE sender_id=? AND reciver_id=?";
        $params = array($sender_id, $reciver_id);
        $sent_result = $this->doSelect($sql, $params);
        addBooleanValue($sent_result, true);

        $second_sql = "SELECT id,text FROM messages WHERE sender_id=? AND reciver_id=?";
        $second_params = array($reciver_id, $sender_id);
        $recived_result = $this->doSelect($second_sql, $second_params);
        addBooleanValue($recived_result, false);

        $result = array_merge($sent_result, $recived_result);

        for ($i = 0; $i < count($result); $i ++) {
            
            $decrypted_message = $this->decrypt($result[$i]['text'], 1383);
            $result[$i]['text'] = $decrypted_message;

        }

        function comparebyId($a, $b) {
            return $a['id'] - $b['id'];
        }
        usort($result, 'comparebyId');

        $response = array(
            "status"=> true,
            "messages"=> $result
        );
        return json_encode($response);
    }

}



?>