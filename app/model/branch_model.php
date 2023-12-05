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

    case 'listbranch':

        $sql = "select * from branch where client_id = $client_id";
        $result = $dbconn->query($sql);

        $data = array();
        while ($obj = $result->fetch_object()) {

            $out = array();

            $buttons = '<a class="mb-2 mr-2 btn btn-warning" title="View Client" onclick="Branch.findPlanById(' . $obj->id . ')"><i class="fas fa-file"></i></a>';

            $status = $obj->status ? '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" checked ><span class="slider round " onclick="Branch.status(' . $obj->id . ')"></span></label>'
                : '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" ><span class="slider round " onclick="Branch.status(' . $obj->id . ')"></span></label>';

            $out[] = $obj->id;
            $out[] = $obj->full_name;
            $out[] = $obj->phone;
            $out[] = $obj->address;
            $out[] = $obj->email;

            $out[] = $status;
            $out[] = $buttons;

            $data[] = $out;
        }

        echo json_encode(['data' => $data]);
        break;

    case 'saveBranch':

        if ($id_branch == 0) {
            $sql = "INSERT INTO `branch`(`client_id`, `full_name`, `phone`, `address`, `state`, `email`)
             VALUES ('$client_id','$name','$phone','$address','$state','$email')";
            $dbconn->query($sql);
            $out['code']    = 200;
            $out['message'] = 'New Branch Created...!';
        }

        if ($id_branch != 0) {
            $fc = date('Y-m-d');
            $sql = "UPDATE `branch` SET  `full_name`='$name',`phone`='$phone',
            `address`='$address',`state`='$state',`email`='$email', `at_update`='$fc'  WHERE id = $id_branch";
            $dbconn->query($sql);
            $out['code']    = 200;
            $out['message'] = 'Branch Save...!';
        }

        echo json_encode($out);
        break;

    case 'findBranchById':

        $sql = "select * from branch where id = $id";
        $result = $dbconn->query($sql);
        $obj = $result->fetch_object();

        echo json_encode(['code' => 200, "dataList" => $obj]);
        break;

    case 'changeStatus':
        $sql = "update branch set status = CASE WHEN (status = 1) THEN 0 ELSE 1 END Where id = $id";
        $dbconn->query($sql);
        $out['code']    = 200;
        $out['message'] = 'Status Change';
        echo json_encode($out);
        break;

    case 'changeDisplay':

        $url = URL_WSSERVER . 'dash/plan/display';
        $jsonData = [
            "token" => $_SESSION['token'],
            "id" => $id,
            "display" => $display
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
}
