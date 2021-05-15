<?php
include ('connect.php');

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//Lấy app_name
$url = $_SERVER['SERVER_NAME'];

$app_name = null;
$stmt_app_name = $conn->prepare('select app_name from tblApps where url=:url');

$stmt_app_name->setFetchMode(PDO::FETCH_ASSOC);
$stmt_app_name->bindParam(":url", $url);
$stmt_app_name->execute();
$resultName = $stmt_app_name->fetchAll();

if ($resultName != null){
    $app_name = $resultName[0]['app_name'];
}

function register($app_name,$conn)
{
    $email = $_POST['email'];
    $gaid = $_POST['gaid'];
    $IP = get_client_ip();
    $created_at = date('Y-m-d H:i:s');

    $query = "insert into tblUsers set email=:email, gaid=:gaid, app_name=:app_name, IP=:IP, created_at=:created_at";

    $stmt_register = $conn->prepare($query);

    $email = htmlspecialchars(strip_tags($email));
    $gaid = htmlspecialchars(strip_tags($gaid));

    $stmt_register->bindParam(":email", $email);
    $stmt_register->bindParam(":gaid", $gaid);
    $stmt_register->bindParam(":app_name", $app_name);
    $stmt_register->bindParam(":IP", $IP);
    $stmt_register->bindParam(":created_at", $created_at);

    if ($stmt_register->execute()) {
        user($conn);
    } else {
        http_response_code(503);
        $response['success'] = 0;
        $response['error'] = 1;
        $response['message'] = "Unable to login";
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

function user($conn)
{
    $gaid = $_POST['gaid'];

    $query = "select * from tblUsers where gaid=:gaid";
    $stmt = $conn->prepare($query);
    $gaid = htmlspecialchars(strip_tags($gaid));
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(":gaid", $gaid);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "";
        $resultSet_user = $stmt->fetchAll();

        foreach ($resultSet_user as $row) {
            $response['data'] = array(
                "id" => $row['id'],
                "email" => $row['email'],
                "gaid" => $row['gaid'],
                "coins" => $row['coins'],
                "IP" => $row['IP'],
                "created_at" => $row['created_at']
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(503);
        $response['success'] = 0;
        $response['error'] = 1;
        $response['message'] = "Unable to login";
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

function gaid_exist($gaid){
    $conn = new PDO('mysql:host=localhost;dbname=QuangPMOffers', 'quangpm', 'Nhomai@2017');
    $query = "select gaid from tblUsers where gaid='$gaid'";
    $stmt = $conn->prepare($query);


    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmt->execute();

    if($stmt->rowCount() > 0){
        return true;
    } else return false;
}

function check_email($email){
    $conn = new PDO('mysql:host=localhost;dbname=QuangPMOffers', 'quangpm', 'Nhomai@2017');
    $query = "select email from tblUsers where email='$email'";
    $stmt = $conn->prepare($query);


    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmt->execute();

    if($stmt->rowCount() > 0){
        return true;
    } else return false;
}

function check_IP($conn){
    $IP = get_client_ip();
    $query = 'select IP from tblIP where IP=:IP';

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(":IP", $IP);
    $stmt->execute();
    if($stmt->rowCount() == 0){
        return true;
    } else return false;
}

function get_coins($conn){
    $id = $_POST['userid'];
    $query = "select coins from tblUsers where id=:id";

    $stmt = $conn->prepare($query);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(":id", $id);

    if($stmt->execute()){
        $resultSet_user = $stmt->fetchAll();
        $response['success'] = true;
        $response["message"] = "";
        foreach ($resultSet_user as $row) {
            $response['data'] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }else{
        http_response_code(503);
        header('Content-Type: application/json');
        echo json_encode(array("message" => "Unable to get coins."));
    }
}

if (isset($_POST['tag'])) {
    switch ($_POST['tag']) {
        case 'register':
            if (isset($_POST['email']) && isset($_POST['gaid'])) {
                //Kiểm tra email, gaid
                if (check_email($_POST['email']) == false && gaid_exist($_POST['gaid']) == false) {
                    register($app_name,$conn);
                } else {
                    $response['success'] = false;
                    $response["message"] = "Email or GAID exist";
                    $response["data"] = (object)[];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
            break;
        case 'get_user_by_device':
            if (isset($_POST['gaid'])) {
                //Kiểm tra xem IP có bị block k
                if (check_IP($conn)) {
                    if (gaid_exist($_POST['gaid'])) {
                        user($conn);
                    } else {
                        $response['success'] = false;
                        $response["message"] = "Gaid doesn't exist";
                        $response["data"] = (object)[];
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    }
                } else {
                    $response['success'] = false;
                    $response["message"] = "IP Blocked";
                    $response["data"] = (object)[];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
            break;
        case 'get_coins':
            if (isset($_POST['userid'])) {
                get_coins($conn);
            }
    }
}