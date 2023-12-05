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

foreach ($_POST as $i_dato => $dato_) {
    $$i_dato = addslashes($obj_function->evalua_array($_POST, $i_dato));
}

switch ($method) {

    case 'listClients':

        $sql = "select * from client";
        $result = $dbconn->query($sql);

        $data = array();
        while ($obj = $result->fetch_object()) {

            $out = array();

            $buttons = '<a class="mb-2 mr-2 btn btn-warning" title="View Client" onclick="Client.edit(' . $obj->id . ')"><i class="fas fa-file"></i></a>';

            $status = $obj->status ? '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" checked ><span class="slider round " onclick="Client.st(' . $obj->id . ')"></span></label>'
                : '<label class="switch"><input type="checkbox" class="checkbox_status"  id="customSwitch" ><span class="slider round " onclick="Client.st(' . $obj->id . ')"></span></label>';

            $out[] = $obj->id;
            $out[] = $obj->full_name;
            $out[] = $obj->descrip;
            $out[] = $status;

            $out[] = $buttons;

            $data[] = $out;
        }

        echo json_encode(['data' => $data]);
        break;

    case 'saveClient':

        if ($id == 0) {
            $fc = date('y-m-d');
            $sql = "INSERT INTO client(`full_name`, `descrip`, `at_created`)
            VALUES ('$name', '$descip','$fc')";
            $dbconn->query($sql);

            $out['code']    = 200;
            $out['message'] = 'New Client Created...!';
        }

        if ($id != 0) {
            $fc = date('y-m-d');
            $sql = "UPDATE client SET `full_name`='$name',`descrip`='$descip' WHERE id = $id";
            $dbconn->query($sql);

            $out['code']    = 200;
            $out['message'] = 'Client Save...!';
        }

        echo json_encode($out);
        break;

    case 'findClientById':

        $sql = "select * from client where id = $id";
        $result = $dbconn->query($sql);
        $obj = $result->fetch_object();

        echo json_encode(['code' => 200, "dataList" => $obj]);
        break;

    case 'changeStatus':

        $sql = "update client set status = CASE WHEN (status = 1) THEN 0 ELSE 1 END Where id = $id";
        $dbconn->query($sql);
        $out['code']    = 200;
        $out['message'] = 'Status Change';
        echo json_encode($out);
        break;
}
