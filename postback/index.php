<?php
include ('connect.php');
require __DIR__ . '/vendor/autoload.php';

$fp = @fopen('postback.txt', "r");

if (!$fp) {
    echo 'Mở file không thành công';
}
else
{
    // Đọc file và trả về nội dung
    $history = fread($fp, filesize('postback.txt'));
}
fclose($fp);

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    'bb65a66741157850c668',
    'c09f5418ca12ee88f8f5',
    '1086484',
    $options
);

$url = $_SERVER['SERVER_NAME'];

//Lấy app_id
$app_id = 3;
//$stmt_app_id = $conn->prepare('select id from tblApps where url=:url');
//
//$stmt_app_id->setFetchMode(PDO::FETCH_ASSOC);
//$stmt_app_id->bindParam(":url", $url);
//$stmt_app_id->execute();
//$resultId = $stmt_app_id->fetchAll();
//
//if ($resultId != null){
//    $app_id = $resultId[0]['id'];
//}

//Lấy network
$network = 'ironSource';
//$stmt_net_work = $conn->prepare('select net_work from tblApps where url=:url');
//
//$stmt_net_work->setFetchMode(PDO::FETCH_ASSOC);
//$stmt_net_work->bindParam(":url", $url);
//$stmt_net_work->execute();
//$resultNetwork = $stmt_net_work->fetchAll();
//
//if ($resultNetwork != null){
//    $network = $resultNetwork[0]['net_work'];
//}


if ($network != "") {
    switch ($network){
        case 'tapjoy':
            if(isset($_GET['snuid']) && isset($_GET['currency'])){
                $userid = $_GET['snuid'];
                $coins = $_GET['currency'];
                $datetime = date('Y-m-d H:i:s');
                $offer_name = 'Tapjoy Offer';

                $query = "insert into tblHistory set tblUsers_id=:tblUsers_id, tblApps_id=:tblApps_id, datetime=:datetime, coins=:coins, network_name=:network_name, offer_name=:offer_name";

                $stmt = $conn->prepare($query);

                $stmt->bindParam(":tblUsers_id", $userid);
                $stmt->bindParam(":tblApps_id", $app_id);
                $stmt->bindParam(":datetime", $datetime);
                $stmt->bindParam(":coins", $coins);
                $stmt->bindParam(":network_name", $network);
                $stmt->bindParam(":offer_name", $offer_name);

                if($stmt->execute()){
                    $data['message'] = 'Tapjoy';
                    $pusher->trigger('my-channel', 'my-event', $data);
                    if($coins > 20){
                        $IP = null;
                        $stmt_IP = $conn->prepare('select IP from tblUsers where id=:id');

                        $stmt_IP->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt_IP->bindParam(":id", $userid);
                        $stmt_IP->execute();
                        $resultIP = $stmt_IP->fetchAll();

                        if ($resultIP != null){
                            $IP = $resultIP[0]['IP'];
                        }

                        $stmt2 = $conn->prepare("insert into tblIP set IP=:IP");

                        $stmt2->bindParam(":IP", $IP);

                        $stmt2->execute();
                    }

                } else http_response_code(403);
                http_response_code(200);

            }else http_response_code(403);
            break;

        case 'ironSource':
            $userid = $_GET['appUserId'];
            $coins = $_GET['rewards'];
            $datetime = date('Y-m-d H:i:s');
            $offer_name = 'ironSource';
            $key = $_GET['eventId'];
            if ($history != $_GET['appUserId'] . "," . $_GET['rewards']){
                $query = "insert into tblHistory set tblUsers_id=:tblUsers_id, tblApps_id=:tblApps_id, datetime=:datetime, coins=:coins, network_name=:network_name, offer_name=:offer_name";

                $stmt = $conn->prepare($query);

                $stmt->bindParam(":tblUsers_id", $userid);
                $stmt->bindParam(":tblApps_id", $app_id);
                $stmt->bindParam(":datetime", $datetime);
                $stmt->bindParam(":coins", $coins);
                $stmt->bindParam(":network_name", $network);
                $stmt->bindParam(":offer_name", $offer_name);


                if($stmt->execute()){
                    $data['message'] = 'ironSource';
                    $pusher->trigger('my-channel', 'my-event', $data);
                    if($coins > 20){
                        $IP = null;
                        $stmt_IP = $conn->prepare('select IP from tblUsers where id=:id');

                        $stmt_IP->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt_IP->bindParam(":id", $userid);
                        $stmt_IP->execute();
                        $resultIP = $stmt_IP->fetchAll();

                        if ($resultIP != null){
                            $IP = $resultIP[0]['IP'];
                        }

                        $stmt2 = $conn->prepare("insert into tblIP set IP=:IP");

                        $stmt2->bindParam(":IP", $IP);

                        $stmt2->execute();
                    }
                }
                echo $key.":OK";

                $temp = $_GET['appUserId'] . "," . $_GET['rewards'];
                $fp = @fopen('postback.txt', "w");

                if (!$fp) {
                    echo 'Mở file không thành công';
                }
                else
                {
                    fwrite($fp, $temp);
                }
                fclose($fp);
            }

            break;
    }
}else http_response_code(403);
