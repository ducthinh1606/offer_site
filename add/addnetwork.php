<?php
include ('../connect.php');

if(isset($_POST['network_name']) && $_POST['network_name'] != "") {
    $name = $_POST['network_name'];

    $query = "insert into tblNetwork set network_name=:network_name";

    $stmt = $conn->prepare($query);

    $name = htmlspecialchars(strip_tags($name));

    $stmt->bindParam(":network_name", $name);

    $stmt->execute();

    echo "Thêm thành công";
}else echo "Thiếu dữ liệu";