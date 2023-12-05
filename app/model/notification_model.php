<?php

error_reporting(E_ALL);
error_reporting(E_ERROR);
ini_set('display_errors', '1');

include '../../common/login_timeout.php';
include '../../common/general.php';
include '../../common/db.php';
$obj_function = new coFunction();
$obj_bdmysql = new coBdmysql();
//var_dump($obj_bdmysql);
// $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNOM) or die("Connection failed: " . mysqli_connect_error());
$id_client = $_SESSION['id_client'];
$id_user = $_SESSION['id'];

foreach ($_POST as $i_dato => $dato_) {
    $$i_dato = addslashes($obj_function->evalua_array($_POST, $i_dato));
}

switch ($method) {

    case 'saveTokenPushNotification':

        $sql = "INSERT INTO `usert_notification`(`usert_id`, `token`) VALUES ('$id_user','$tokenfirebase')";
        //print_r($sql);exit();
        $dbconn->query($sql);

        $out['code'] = 200;
        $out['message'] = 'New Token Created...!';

        echo json_encode($out);
    break;

    case 'sendNotificationAdmin':
        
        $sql = "SELECT un.* FROM usert_notification un INNER JOIN usert u on u.id = un.usert_id WHERE u.is_admin = 1";
        $query = $obj_bdmysql->query($sql, $conn);

        $out['code'] = 204;
        $out['message'] = 'Error...!';

        if(is_array($query)){

            $title = "Nueva Notificacíón";
            $obj_function->pushNotification($query, $title);

            $out['code'] = 200;
            $out['message'] = 'Ok...!';
        }

        echo json_encode($out);

    break;
}


function SendPushNotification($id_client, $senderId, $message, $conn){
    global $obj_bdmysql;
    global $accessToken;
    global $pageId;
    global $count_leads;
    global $lead_max;
    global $lead_limit;

    $message_text = $message['text'] != '' ? $message['text'] : '';
    $message_attachments = $message['attachments'] != '' ? $message['attachments'][0]['payload']['url'] : '';
    $message_attachments_type = $message['attachments'] != '' ? $message['attachments'][0]['type'] : '';
    $porcent = '';

    if($lead_limit == 1){
        $porcent = ($count_leads * 100) / $lead_max;
    }   

    $sql = "SELECT ut.* FROM user_token ut INNER JOIN user u on u.id = ut.id_user WHERE u.id_client = $id_client";
    $query = $obj_bdmysql->query($sql, $conn);

    if(is_array($query)){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$senderId.'?fields=name,profile_pic&access_token='.$accessToken);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $userData = json_decode($result, true);
        $full_name = $userData['name']; //full name user
        $profile_pic = $userData['profile_pic'];
        curl_close($ch);
        
        foreach($query as $value){
            if ($lead_limit == 0) {
                // code...
            }
            $fields = array(
                "to" => $value['tokenfirebase'],
                "data" => array(
                    "message"=> $message_text,
                    "message_attachments"=> $message_attachments,
                    "message_attachments_type"=> $message_attachments_type,
                    "title"=>$full_name.' respondió.',
                    "icon"=>$profile_pic,
                    "link"=>"https://chatbotdev.gosmartcrm.com/app/view/index.php",
                    "id_sender"=>$senderId,
                    "full_name"=>$full_name,
                    "profile_pic"=>$profile_pic,
                    "page_id"=>$pageId,
                    "porcent"=>$porcent,
                    "lead_limit"=>$lead_limit
                )
            );
            // old icon https://firebasestorage.googleapis.com/v0/b/chatbot-435bb.appspot.com/o/icons%2Fmessengericon.png?alt=media&token=95b28181-3816-4a31-9535-6848139aeaa6

            $url = "https://fcm.googleapis.com/fcm/send";
            $serverKey = 'AAAAJitPvQQ:APA91bHzq9mKxHswGKz4AZCCVVnCqJmW-DlEdcs_q3QhLJBkpOo8ZWwgBOMG914Ux3O99XrvQEBIFjwJUVNnZvcK1qKbci95XAjmTWhP5dA0qpoE3-bFnq0QOTS89ZKj0YFyrR2es1Bp';
            $json = json_encode($fields);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key=' . $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //Send the request
            $response = curl_exec($ch);
            $response = json_decode($response);
            //var_dump($response);
            if ($response->success == 1) {
                //error_log(print_r("si",true), 3, '/var/www/html/chatbot/webhook/jsondebug.log');
            } else {
                $sql = 'DELETE FROM user_token WHERE tokenfirebase = "'.$value['tokenfirebase'].'"';
                $query = $obj_bdmysql->query($sql, $conn);
            }
            curl_close($ch);
        }
    }
}