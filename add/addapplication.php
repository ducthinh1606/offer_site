<?php
include ("../connect.php");

if(isset($_POST['net_work']) && isset($_POST['url']) && isset($_POST['app_name']) && $_POST['url'] != "" && $_POST['app_name'] != "") {
    $name = $_POST['app_name'];
    $network = $_POST['net_work'];
    $url = $_POST['url'];

    $query = "insert into tblApps set app_name=:app_name, net_work=:net_work, url=:url";

    $stmt = $conn->prepare($query);

    $name = htmlspecialchars(strip_tags($name));
    $url = htmlspecialchars(strip_tags($url));

    $stmt->bindParam(":net_work", $network);
    $stmt->bindParam(":app_name", $name);
    $stmt->bindParam(":url", $url);

    $stmt->execute();

    echo "Thêm thành công";
}else echo "Thiếu dữ liệu";