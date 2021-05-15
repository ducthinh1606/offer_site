<?php
include ("../connect.php");

if(isset($_POST['e_role']) && isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "") {
    $role = $_POST['e_role'];
    $name = $_POST['e_name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);

    $query = "insert into tblEmployee set e_name=:e_name, phone=:phone, username=:username, password=:password, e_role=:e_role";

    $stmt = $conn->prepare($query);


    $stmt->bindParam(":e_name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hash);
    $stmt->bindParam(":e_role", $role);

    $stmt->execute();

    echo "Thêm thành công";
}else echo "Thiếu dữ liệu";