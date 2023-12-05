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
include "../../vendor/autoload.php";
include '../../common/db.php';

$client_id = $_SESSION['client_id'];
$id_user = $_SESSION['id'];

$obj_function = new coFunction();
$obj_bdmysql = new coBdmysql();

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;

foreach ($_POST as $i_dato => $dato_) {
    $$i_dato = addslashes($obj_function->evalua_array($_POST, $i_dato));
}

switch ($method) {

    case 'listUsers':

        $sql = "select * from usert where client_id = $client_id and role = 2";
        $result = $dbconn->query($sql);

        $data = array();
        while ($obj = $result->fetch_object()) {

            $out = array();

            $buttons = '<a class="mb-2 mr-2 btn btn-warning" title="View Client" onclick="User.edit(' . $obj->id . ')"><i class="fas fa-file"></i></a>';

            $act = $obj->act ? '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" checked ><span class="slider round " onclick="User.status(' . $obj->id . ')"></span></label>'
                : '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" ><span class="slider round " onclick="User.status(' . $obj->id . ')"></span></label>';
            

            $out[] = $obj->id;         
            $out[] = $obj->full_name;
            $out[] = $obj->email;
            $out[] = $obj->movil_phone;            

            $out[] = $act;        
            $out[] = $buttons;

            $data[] = $out;
        }

        echo json_encode(['data' => $data]);
        break;

    case 'saveUser':

        if ($id == 0) {
            $code = $obj_function->randString(8);
            $fc = date('Y-m-d');
            $sql = "INSERT INTO `usert`(`code`, `client_id`, `branch_id`, `full_name`, `username`, `email`, `pass`, `movil_phone`, `role`, `at_created`) 
            VALUES ('$code','$client_id','$branch_id','$name','$username','$email','$password','$phone','2','$fc')";

            $dbconn->query($sql);
            $out['code'] = 200;
            $out['message'] = 'New User Created...!';
        }

        if ($id != 0) {
            $fc = date('Y-m-d');
            $sql = "UPDATE `usert` SET `branch_id`='$branch_id',`full_name`='$name',
            `username`='$username',`email`='$email',`pass`='$password',`movil_phone`='$phone',
            `role`='$role', `at_update`='$fc' WHERE id = $id";

            $dbconn->query($sql);
            $out['code'] = 200;
            $out['message'] = 'Client Save...!';
        }


        echo json_encode($out);
        break;

    case 'changeStatus':

        $sql = "update usert set act = CASE WHEN (act = 1) THEN 0 ELSE 1 END Where id = $id";
        $dbconn->query($sql);
        $out['code']    = 200;
        $out['message'] = 'Status Change';
        echo json_encode($out);
        break;

    case 'isAdmin':

        $sql = "update usert set is_admin = CASE WHEN (is_admin = 1) THEN 0 ELSE 1 END Where id = $id";
        $dbconn->query($sql);
        $out['code']    = 200;
        $out['message'] = 'Status Change';
        echo json_encode($out);
        break;

    case 'deleteUser':

        $url = URL_WSSERVER . 'dash/user/delete';
        $jsonData = [
            "token" => $_SESSION['token'],
            "id" => $id
        ];
        $curl = $obj_function->curlSetOpt($url, $jsonData);

        $out['code']    = $curl['code'];
        $out['message'] = $curl['message'];

        echo json_encode($out);
        break;

    case 'loadClient':
        $sql = "select * from client where status = 1";
        $result = $dbconn->query($sql);
        $data = array();
        while ($obj = $result->fetch_object()) {
            $out = array();

            $out[] = $obj->id;
            $out[] = $obj->full_name;

            $data[] = $out;
        };
        echo json_encode(["dataList" => $data]);
        break;

    case 'loadBranch':
        $sql = "select * from branch where client_id = $client_id";
        $result = $dbconn->query($sql);
        $data = array();
        while ($obj = $result->fetch_object()) {
            $out = array();

            $out[] = $obj->id;
            $out[] = $obj->full_name;

            $data[] = $out;
        };
        echo json_encode(["dataList" => $data]);
        break;

    case 'edit':
        $sql = "select * from usert where id = $id";
        $result = $dbconn->query($sql);
        $obj = $result->fetch_object();

        echo json_encode(['code' => 200, "dataList" => $obj]);
        break;

    case 'listAgents':

        $sql = "select * from usert where role = 1";
        $result = $dbconn->query($sql);

        $data = array();
        while ($obj = $result->fetch_object()) {

            $out = array();

            $buttons = '<a class="mb-2 mr-2 btn btn-warning" title="View Client" onclick="User.edit(' . $obj->id . ')"><i class="fas fa-file"></i></a>';

            $act = $obj->act ? '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" checked ><span class="slider round " onclick="User.status(' . $obj->id . ')"></span></label>'
                : '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" ><span class="slider round " onclick="User.status(' . $obj->id . ')"></span></label>';

            $admin = $obj->is_admin ? '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" checked ><span class="slider round " onclick="User.admin(' . $obj->id . ')"></span></label>'
                : '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" ><span class="slider round " onclick="User.admin(' . $obj->id . ')"></span></label>';

            if ($obj->role == 1) {
                $role = 'Agent';
            }
            if ($obj->role == 2) {
                $role = 'User';
            }

            $out[] = $obj->id;
            $out[] = $obj->code;
            $out[] = $obj->full_name;
            $out[] = $obj->email;
            $out[] = $obj->movil_phone;            

            $out[] = $act;
            $out[] = $admin;
            $out[] = $buttons;

            $data[] = $out;
        }

        echo json_encode(['data' => $data]);
        break;    
    
    case 'saveAgent':

        if ($id == 0) {
            $code = $obj_function->randString(8);
            $fc = date('Y-m-d');
            $sql = "INSERT INTO `usert`(`code`, `client_id`, `branch_id`, `full_name`, `username`, `email`, `pass`, `movil_phone`, `role`, `at_created`) 
            VALUES ('$code','$client_id','$branch_id','$name','$username','$email','$password','$phone','1','$fc')";

            $dbconn->query($sql);
            $out['code'] = 200;
            $out['message'] = 'New User Created...!';
        }

        if ($id != 0) {
            $fc = date('Y-m-d');
            $sql = "UPDATE `usert` SET `branch_id`='$branch_id',`full_name`='$name',
            `username`='$username',`email`='$email',`pass`='$password',`movil_phone`='$phone',
            `at_update`='$fc' WHERE id = $id";

            $dbconn->query($sql);
            $out['code'] = 200;
            $out['message'] = 'Client Save...!';
        }


        echo json_encode($out);
        break;
}
