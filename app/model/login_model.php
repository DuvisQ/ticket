<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);
error_reporting(E_ERROR);
ini_set('display_errors', '1');
session_start();

include '../../common/general.php';
include '../../common/db.php';
include "../../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

$obj_function = new coFunction();
$obj_bdmysql = new coBdmysql();
$mail = new PHPMailer;

//$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNOM) or die("Connection failed: " . mysqli_connect_error());

foreach ($_POST as $i_dato => $dato_) {
    //var_dump($_POST);    exit();
    $$i_dato = addslashes($obj_function->evalua_array($_POST, $i_dato));
}

switch ($method) {

    case 'login':
        
        $sql = "select * from usert where email = '$ingUsuario' ;"; // para evitar boom sql
        $result  =  $dbconn->query($sql);

        $out['code']    = 204;
        $out["message"] = 'User Not valid...!';
         
        if($result->num_rows == 1){ // existe el usuario
            $obj = $result -> fetch_object();
            
            $out['code']    = 204;
            $out["message"] = 'User No Active...!'; 

            if ($obj->act == 1) {
                if ($obj->pass == $ingPassword) { // compara clave
                    $_SESSION['session']    = true;
                    $_SESSION['id'] = $obj->id;
                    $_SESSION['client_id'] = $obj->client_id;
                    $_SESSION['code'] = $obj->code;
                    $_SESSION['users_name'] = $obj->full_name;
                    $_SESSION['email'] = $obj->email;
                    $_SESSION['role'] = $obj->role;
                    $_SESSION['is_admin'] = $obj->is_admin;
        
                    $out['code']    = 200;
                    $out["message"] = 'welcome: ' . $obj->email . ' ....!';
                }          
            }                      
        }
           
       echo json_encode($out);                
    break;

    case 'logout':
        unset($_SESSION['session']);
        session_destroy();
        echo json_encode(array("code" => 200, "message" => "logout...!"));
    break;

}
