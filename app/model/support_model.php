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
$id_client = $_SESSION['client_id'];
$id_user = $_SESSION['id'];

foreach ($_POST as $i_dato => $dato_) {
    $$i_dato = addslashes($obj_function->evalua_array($_POST, $i_dato));
}

switch ($method) {
    case 'loadagent':
        $sql = "select * from usert where role = 1 ";
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
        $sql = "select * from support where id = $id";
        $result = $dbconn->query($sql);
        $obj = $result->fetch_object();

        echo json_encode(['code' => 200, "dataList" => $obj]);
        break;

    case 'loadListBranch':

        $sql = "select * from branch where client_id = $id_client";
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

    case 'saveSupport':
        if ($id == 0) {
            $code = randString(9);
 
            $fc = date('Y-m-d H:i:s');
            $campo = "`code`, `client_id`, `branch_id`, `usert_id`, `title`, `descrip`, `status`, `at_created`";
            $valor = "'$code','$id_client','$branch_id','$id_user', '$title','$descrip','1','$fc'";
            $id_support = $obj_bdmysql->insert("support", $campo, $valor, $dbconn);

            $out['code'] = 204;
            $out['message'] = 'Error...!';

            if($id_support > 0){
                $campo = "`id_support_tickets`, `detail`, `path_image`, `url_image`, `type_details`, `type_user`, `created`, `note`, `status_response`";
                $valor = "'$id_support','$descrip','','', '2','1','$fc','','0'";
                $obj_bdmysql->insert("support_details", $campo, $valor, $dbconn);

                $out['code'] = 200;
                $out['message'] = 'New Support Created...!';

                $sql = "SELECT un.* FROM usert_notification un INNER JOIN usert u on u.id = un.usert_id WHERE u.is_admin = 1";
                $query = $obj_bdmysql->query($sql, $dbconn);

                if(is_array($query)){
                    $title = "Nuevo soporte para asignar";
                    $message_title = $title;
                    $obj_function->pushNotification($query, $title, $message_title);
                }
            }             
        }

        if ($id != 0) {
            $sql = "UPDATE `support` SET  `branch_id`='$branch_id', `title`='$title',`descrip`='$descrip' WHERE id = $id";
            $dbconn->query($sql);

            $out['code'] = 200;
            $out['message'] = 'Support Save...!';
        }

        echo json_encode($out);
        break;

    case 'loadListSupports':
        $sql = "SELECT st.id, st.code, st.title, st.descrip, st.status, st.at_created FROM support st WHERE st.status != 4 AND client_id = $id_client AND usert_id = $id_user; ";
        $result = $dbconn->query($sql);

        $data = array();
        while ($obj = $result->fetch_object()) {
            $out = array();

            $out[] = $obj->id;
            $out[] = $obj->code;
            $out[] = $obj->title;
            $out[] = $obj->descrip;
            $out[] = $obj->status;
            $out[] = $obj->at_created;

            $data[] = $out;
        }

        echo json_encode(['dataList' => $data]);
        break;

    case 'listSupportsBack':

        $sql = "SELECT spt.id,spt.code, spt.title, spt.status,spt.at_created ,ct.full_name as name_client, brh.full_name as name_branch, us.full_name as name_user, agent.full_name as name_agent FROM support spt 
        INNER JOIN client ct ON spt.client_id = ct.id 
        INNER JOIN branch brh ON spt.branch_id = brh.id 
        INNER JOIN usert us ON spt.usert_id = us.id 
        LEFT JOIN usert agent ON spt.user_assigned = agent.id";

        $result = $dbconn->query($sql);

        $data = array();
        while ($obj = $result->fetch_object()) {

            $out = array();
            $buttons = '<a class="mb-2 mr-2 btn btn-deafult" title="View support" onclick="Support.detailSupportById(' . $obj->id . ')"><i class="fas fa-eye"></i></a>';
            $buttons .= '<a class="mb-2 mr-2 btn btn-info" title="Assigner support" onclick="Support.assignerSupport(' . $obj->id . ')"><i class="fas fa-check"></i></a>';
            $buttons .= '<a class="mb-2 mr-2 btn btn-danger" title="Close support" onclick="Support.closeSupport(' . $obj->id . ')"><i class="fas fa-trash"></i></a>';

            if ($obj->status == 1) {
                $status = '<span class="badge bg-info text-dark">Request</span>';
            }
            if ($obj->status == 2) {
                $status = '<span class="badge bg-success">Working</span>';
            }
            if ($obj->status == 4) {
                $status = '<span class="badge bg-danger">Finalized</span>';
            }

            $out[] = $obj->id;
            $out[] = $obj->code;
            $out[] = $obj->name_client;
            $out[] = $obj->name_branch;
            $out[] = $obj->name_user;
            $out[] = $obj->name_agent;
            $out[] = $obj->title;

            $out[] = $status;
            $out[] = $obj->at_created;
            $out[] = $buttons;

            $data[] = $out;
        }

        echo json_encode(['data' => $data]);
        break;

    case 'saveAssigner':
        $fc = date('Y-m-d H:i:s');
        $sql = "UPDATE `support` SET `user_assigned`='$agent_id',`status`='2',`at_assigned`='$fc', `at_update`= '$fc' WHERE id = $id";
        $update = $dbconn->query($sql);

        $out['code'] = 204;
        $out['message'] = 'Error..!';

        if($update > 0){
            $out['code'] = 200;
            $out['message'] = 'Support Assigner...!';

            $sql = "SELECT un.* FROM usert_notification un WHERE un.usert_id = $agent_id";
            $query = $obj_bdmysql->query($sql, $dbconn);

            if(is_array($query)){
                $title = "Se le ha asignado un nuevo soporte";
                $message_title = $title_support;
                $obj_function->pushNotification($query, $title, $message_title);
            }
        }
        
        echo json_encode($out);
        break;

    case 'closeSupport':
        $fc = date('Y-m-d H:i:s');
        $sql = "UPDATE `support` SET  `status`='4',`at_closed`='$fc', `at_update`= '$fc' WHERE id = $id";
        $dbconn->query($sql);

        $out['code'] = 200;
        $out['message'] = 'Support Closed...!';
        echo json_encode($out);
        break;

    case 'findSupportById':
        $sql = "SELECT su.*, ag.full_name AS name_user_assigned,  sd.detail, sd.url_image, sd.type_details, sd.type_user, sd.created, sd.status_response, c.full_name AS name_client 
            FROM support su
            LEFT JOIN support_details sd ON sd.id_support_tickets = su.id
            LEFT JOIN client c ON c.id = su.client_id
            INNER JOIN usert ag ON ag.id = su.usert_id
            WHERE su.id  = $id";
        $result = $dbconn->query($sql);
        $obj = $result->fetch_object();

        // var_dump($obj);exit;

        $out['code']    = 200;
        $out['id']      = $obj->id;
        $out['code_ticket']      = $obj->code;
        $out['id_client']      = $obj->id_client;
        $out['status']  = ($obj->status);
        $out['id_agent']     = $obj->user_assigned;
        $out['agent_response']  = $obj->name_user_assigned;
        $out['date_create']  = $obj->at_created;
        $out['date_attention']  = $obj->at_assigned;
        $out['date_finish']  = $obj->at_closed;
        $out['descrip']  = $obj->descrip;
        $out['detail']  = $obj->detail;
        $out['url_image']  = $obj->url_image;
        $out['type_details']  = $obj->type_details;
        $out['created']  = $obj->created;
        $out['name_client'] = $obj->name_client;

        echo json_encode($out);
        break;

     case 'findHistoryByIdSupport':
        $sql = "SELECT * FROM support_details WHERE id_support_tickets = $id_support";
        $result = $dbconn->query($sql);

       $data = array();
        while ($obj = $result->fetch_object()) {
            $out = array();

            $out['id'] = $obj->id;
            $out['id_support_tickets'] = $obj->id_support_tickets;
            $out['detail'] = $obj->detail;
            $out['path_image'] = $obj->path_image;
            $out['url_image'] = $obj->url_image;
            $out['type_details'] = $obj->type_details;
            $out['type_user'] = $obj->type_user;
            $out['created'] = $obj->created;
            $out['note'] = $obj->note;
            $out['status_response'] = $obj->status_response;
            $data[] = $out;
        }
 
        echo json_encode(['data' => $data, 'code' => 200]);
        break;
     case 'sendReplyDetailsSupport':
        $fc = date('Y-m-d H:i:s');
        $campo = "`id_support_tickets`, `detail`, `path_image`, `url_image`, `type_details`, `type_user`, `created`, `note`, `status_response`";
        $valor = "'$id_support','$detail','$path_image','$url_image', '$type_details','$type_user','$fc','','$status_response'";
        $support = $obj_bdmysql->insert("support_details", $campo, $valor, $dbconn);

        if ($support) {
            $out['code']    = 200;
            $out['message']    = 'Support answered';
        }
        
        echo json_encode($out);
        break;

    case 'sendReplyFinalizedSupport':
        $fc = date('Y-m-d H:i:s');
        $campo = "`id_support_tickets`, `detail`, `path_image`, `url_image`, `type_details`, `type_user`, `created`";
        $valor = "'$id_support','$detail','$path_image','$url_image', '$type_details','$type_user','$fc'";
        $support = $obj_bdmysql->insert("support_details", $campo, $valor, $dbconn);

        if ($support) {
            $sql = "UPDATE `support` SET  `status`='4',`at_closed`='$fc', `at_update`= '$fc' WHERE id = $id_support";
            $dbconn->query($sql);
            $out['code']    = 200;
            $out['message']    = 'Support answered and Closed';
        }
        echo json_encode($out);
        break;
}


function randString($size)
{
    return substr(
        str_shuffle(
            str_repeat(
                $x = '0000123456789',
                ceil($size / strlen($x))
            )
        ),
        1,
        $size
    );
}
