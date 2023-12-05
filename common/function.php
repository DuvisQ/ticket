<?php
use PHPMailer\PHPMailer\PHPMailer;
use Plivo\RestClient;
use Plivo\Exceptions\PlivoRestException;
//use Plivo\RestAPI;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class coFunction{
    //VALIDA Y DEPURA VALORES DE ARREGLOS
    function evalua_array($array,$i){
        if (array_key_exists($i,$array)){
            if (isset($array[$i])) {
                $resp = $array[$i];
            }else{
                $resp = "";
            }
        }else{
            $resp = "";
        }
        return $resp;
    }

    function envia_correo($origen_nom,$asunto,$html,$mensaje,$destino,$destino_nom){
        include("phpMailer/class.phpmailer.php");
        include("phpMailer/class.smtp.php");

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = $usuario;
        $mail->Password = $clave;

        $mail->From = $usuario;
        $mail->FromName = $origen_nom;
        $mail->Subject = $asunto;
        $mail->AltBody = $mensaje;
        $mail->MsgHTML($html);
        foreach ($destino as $i => $d){
            $mail->AddAddress($d,trim(strtolower($destino_nom[$i])));
        }
        $mail->IsHTML(true);
        if(!$mail->Send()){
            return 'Error: '.trim($mail->ErrorInfo);
        }else{
            return '1';
        }
    }

    function codeQR($valor,$name, $directory = NULL){
        if (is_null($directory)){
            $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'codeqr'.DIRECTORY_SEPARATOR;
        } else {
            $PNG_TEMP_DIR = str_replace(DIRECTORY_SEPARATOR.'common','',dirname(__FILE__)).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'art_qr'.DIRECTORY_SEPARATOR;
        }
       // echo $PNG_TEMP_DIR;
        //exit;
        include_once "../../assets/phpqrcode/qrlib.php";

        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR)){
            mkdir($PNG_TEMP_DIR);
        }
        $filename = $PNG_TEMP_DIR.'test.png';
        $matrixPointSize = 10;
        $errorCorrectionLevel = 'L';
        //$filename = $PNG_TEMP_DIR.'test'.md5($valor.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        if (is_null($directory)){
            $filename = $PNG_TEMP_DIR.$name.'.png';
            QRcode::png($valor, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
            return $valor.$name;
        } else {
            $filename = $PNG_TEMP_DIR.$name.'.png';
            if (!file_exists($filename)){
                QRcode::png($valor, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
            }
            return $valor.$name;
        }
    }

    function randString($size){
        return substr(
                str_shuffle(
                    str_repeat(
                        $x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', ceil($size/strlen($x)) )
                )
                ,1
                ,$size
            );
    }

    //****** set token FIREBASE
    function setToken($token) {
        session_start();
        $url = 'https://chatbotwsdev.gosmartcrm.com:8000/ws/dash/user/settoken';
        $jsonData = [
            "token" => $_SESSION['token'],
            "token_firebase" => $token
        ];
        $curl = $this->curlSetOpt($url, $jsonData);
        $curl['url'] = $url;
        $curl['jsonData'] = $jsonData;
        echo json_encode($curl);
    }
    //****** PUSH NOTIFICATION
    function pushNotification($query, $title, $message_title) {

        foreach($query as $value){
            $fields = array(
                "to" => $value['token'],
                "data" => array(
                    "message"=> $message_title,
                    "title"=> $title,
                    "icon"=>"https://firebasestorage.googleapis.com/v0/b/chatbot-435bb.appspot.com/o/icons%2Fmessengericon.png?alt=media&token=95b28181-3816-4a31-9535-6848139aeaa6",
                    "link"=>"http://localhost/helpa2center/app/view/index.php",
                )
            );

            $url = "https://fcm.googleapis.com/fcm/send";
            $serverKey = 'AAAAskvSKHM:APA91bGOEglbsfLjK6qC3zJqOGh9Rzao1jSL_hPzKt59Ksam4-fgPGKlfXFMVEJMR7L84AIgmv0St8CQR6AwDcVfRWvUz1s--J7wbqn4Iv4F4r-jXAvkVALZX-3vcc1pp-2g4ctRfSTG';
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
                $sql = 'DELETE FROM usert_notification WHERE token = "'.$value['token'].'"';
                $query = $obj_bdmysql->query($sql, $conn);
            }
            curl_close($ch);
        }
    }

    function sendEmail($isSMTP, $host, $port, $SMTPSecure, $SMTPAuth, $from, $from_name, $password, $to, $cc, $bcc, $subject, $message, $files, $tracking, $random_id, $count, $recipient_type, $id_related, $header, $footer, $strg_pdf){
        //var_dump($isSMTP, $host, $port, $SMTPSecure, $SMTPAuth, $from, $from_name, $password, $to, $cc, $bcc, $subject, $message, $files, $tracking, $random_id, $count, $recipient_type, $id_related, $header, $footer, $strg_pdf); //die();

        require '../../vendor/autoload.php';
        $mail = new PHPMailer;

        include './general.php';
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNOM) or die("Connection failed: " . mysqli_connect_error()); /* Database connection end */
        $mail->ClearAddresses();  // each AddAddress add to list
        $mail->ClearCCs();
        $mail->ClearBCCs();

        $addAddress = explode(",", $to);
        $addCC = explode(",", $cc);
        $addBCC = explode(",", $bcc);
        if ($isSMTP == 1) {
            $mail->isSMTP();
        }
        $mail->CharSet = "utf-8";
        //$mail->SMTPDebug = 3;

        $mail->Host = $host;
        $mail->Port = $port;
        if ($SMTPSecure == 1) {
            $mail->SMTPSecure = 'tls';
        } elseif ($SMTPSecure == 2) {
            $mail->SMTPSecure = 'ssl';
        } else {
            $mail->SMTPSecure = false;
        }
        if ($SMTPAuth == 1) {
            $mail->SMTPAuth = true;
        } else {
            $mail->SMTPAuth = false;
        }
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->setFrom($from, $from_name);
        foreach ($addAddress as $email) {
            $mail->addAddress($email);
        }
        foreach ($addCC as $email) {
            $mail->addCC($email);
        }
        foreach ($addBCC as $email) {
            $mail->addBCC($email);
        }
        $mail->Subject = $subject;
        //$mail->Body = $email_plain_message;
        //$mail->AltBody = $email_plain_message;
        //$mail->addAttachment($attachment);

        if (is_array($files)) { // Armado de envio de attachs
            for ($ct = 0; $ct <= $count; $ct++) {
                $mail->AddAttachment($files['files-' . $ct]['tmp_name'], $files['files-' . $ct]['name']);
            }
        }

        if ($strg_pdf != '') { // Caso PDF de DomPDF en correo para agentes

            $mail->AddStringAttachment($strg_pdf, ''.$from_name.'.pdf', 'base64', 'application/pdf');
        }


        // Inicio tracking Pixel (construye el body con el message a enviar)
        if ($tracking == 1) {
            $originalImage = "/var/www/html/v103/img/tracking/LogoPowered.jpg";
            $userImage = "/var/www/html/v103/img/tracking/LogoPowered_" . $random_id . ".jpg";
            $urlImageSource = "https://services.gosmartcrm.com/img/tracking/LogoPowered_" . $random_id . ".jpg";
            copy($originalImage, $userImage);

            if (substr_count($message,'<html>') > 0) {
                $message = str_replace("</html>", "<img src=" . $urlImageSource . "  height='36' width='100'></html>", $message);
            } else {
                $message = "<html>".$message."<img src=" . $urlImageSource . "  height='36' width='100'></html>";
            }
        }
        //Fin tracking pixel

        // Inicio verificacion merge fields (construye el body con campos genericos)
        if ($recipient_type == 1) { //caso contact
            $sql = "SELECT * FROM contacts WHERE id = $id_related";
            $query = mysqli_query($conn, $sql) or die($sql);
            $data = mysqli_fetch_assoc($query);

        } elseif ($recipient_type == 2) { //caso lead
            $sql = "SELECT * FROM leads WHERE id = $id_related";
            $query = mysqli_query($conn, $sql) or die($sql);
            $data = mysqli_fetch_assoc($query);

        } elseif ($recipient_type == 3) { //caso user_crm
            $sql = "SELECT * FROM user_crm WHERE id = $id_related";
            $query = mysqli_query($conn, $sql) or die($sql);
            $data = mysqli_fetch_assoc($query);
        }

        $sql = "SELECT name, value, type_merge_field FROM merge_field WHERE status = 1";
        $query = mysqli_query($conn, $sql) or die($sql);
        extract(mysqli_fetch_array($query));

        foreach ($query as $row) {

            $merge_field_name = $row['name'];
            $merge_field_value = $row['value'];

            if (strpos($message, $merge_field_name) == true) {
                $value_data = $data["$merge_field_value"];
                $message = str_replace($merge_field_name, $value_data, $message);
            }
        }
        //Fin verificacion merge fields ---------------------------------------------------------------------------------------------------

        $mail->Body = $message;
        $mail->isHTML(true);

        // Inicio Caso Formularios Infinity, toca estandarizar procedimiento para otros clientes (tablas, disposicion de imagenes para otros header/footer, etc) DJ
        if ($header == 1) {
        $mail->AddEmbeddedImage('../../assets/media/img/images/header.png', 'header');
        }
        if ($footer == 1 ) {
        $mail->AddEmbeddedImage('../../assets/media/img/images/footer.png', 'footer');
        }
        // Fin Caso Formularios Infinity
        // print_r($mail->ErrorInfo);dies();
        //$mail->send();
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
            )
        );
        if (!$mail->send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
            return 'Email Error'. $mail->ErrorInfo;
        } else {
            //echo "Message sent!";
            return 'Email Sent';
        }
    }

    function sendSms($params){
        //PLIVO
        include './general.php';
        require '../../vendor/autoload.php';

        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNOM) or die("Connection failed: " . mysqli_connect_error()); /* Database connection end */
        $from = $params['src'];
        $to = $params['dst'];
        $message = $params['text'];

        $sql = "SELECT auth_id, auth_token FROM provides_number WHERE number_phone LIKE '%$from%'";
        $query = mysqli_query($conn, $sql) or die($sql);
        extract(mysqli_fetch_array($query));

       $restClient = new RestClient($auth_id, $auth_token);//20/082020 - jc puse las $auth_id, $auth_token

        try
        {
            $response = $restClient->messages->create(
                        $from, #src
                        [$to], #dst
                        $message #text
            );

            //$calluuid = $response->getmessageUuid(0)[0];
            $statusCode = $response->statusCode;

        }
        catch(PlivoRestException $ex)
        {
            //print_r($ex);
            $statusCode = $ex->getstatusCode();
            $statusMessage = $ex->getmessage();
            $error_message = date('d/m/Y h:i:s a', time()) . " || Error Sending SMS || Status Code: " . $statusCode . " || Error Message: " . $statusMessage . "\n";
        }

        if ($statusCode == 200 || $statusCode == 201 || $statusCode == 202) {

            return 'successful';

        } else {

            error_log($error_message, 3, '/var/www/html/v103/app/ws/plivoErrorLog');

            return array ('error', $statusMessage);
        }

        // $response = $restClient->messages->create(
        //     $from, #src
        //     [$to], #dst
        //     $message #text
        // );
        // // var_dump($response);
        // // var_dump("from ==$from to ==$to message ==$message");
        // // die();
        // // if ($response['statusCode'] != '202') {
        // //     return $response['response']['error'];
        // //     //var_dump($response['status']);die();
        // // }else{
        // //     return 'succeful';
        // //     //var_dump($response['status']);die();
        // // }
        // return 'succeful';

    }

    function sendMms($params){//Aldrha
        // var_dump($params);exit();
        // PLIVO
        include './general.php';
        include "/var/www/html/v103/vendor/autoload.php";

        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNOM) or die("Connection failed: " . mysqli_connect_error()); /* Database connection end */
        $mediaURLs = [$params['mediaURLs']];
        $from = $params['src'];
        $to = $params['dst'];
        $message = $params['text'];
        $type = $params['type'];

        $sql = "SELECT auth_id, auth_token FROM provides_number WHERE number_phone LIKE '%$from%'";
        $query = mysqli_query($conn, $sql) or die($sql);
        extract(mysqli_fetch_array($query));

        $restClient = new RestClient($auth_id, $auth_token);//20/082020 - jc puse las $auth_id, $auth_token

        try
        {
            $response = $restClient
                ->messages
                ->create($from, #from
                [$to], #to
                $message,
                ["type" => $type,
                "media_urls" => $mediaURLs]);
            //$calluuid = $response->getmessageUuid(0)[0];
            $statusCode = $response->statusCode;

        }
        catch(PlivoRestException $ex)
        {
            //print_r($ex);
            $statusCode = $ex->getstatusCode();
            $statusMessage = $ex->getmessage();
            $error_message = date('d/m/Y h:i:s a', time()) . " || Error Sending MMS || Status Code: " . $statusCode . " || Error Message: " . $statusMessage . "\n";
        }

        if ($statusCode == 200 || $statusCode == 201 || $statusCode == 202) {

            return 'successful';

        } else {

            error_log($error_message, 3, '/var/www/html/v103/app/ws/plivoErrorLog');

            return array ('error', $statusMessage);
        }

        // if(strpos($to, "+1") === false){

        //    return 'error';

        // }else{

        //     $response = $restClient->messages->create(
        //         $from, #src
        //         [$to], #dst
        //         $message, #text
        //         [
        //             "type" => $type,
        //             "media_urls" => $mediaURLs
        //         ]
        //     );

        //     return 'succeful';
        // }
    }

    function curlSetOpt($url, $jsonData){

        $ch = curl_init($url);//The JSON data.
        $jsonData = json_encode($jsonData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);//Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);//Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $curl = json_decode($result, true);
        curl_close($ch);
        return $curl;

    }
}

if (isset($_POST['method'])){
    if( $_POST['method']=='setToken'){
        $t = new coFunction();
        $t->setToken($_POST['token']);
    }
}