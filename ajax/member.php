<?php
include ('../connect.php');

$request = 1;
if(isset($_POST['request'])){
    $request = $_POST['request'];
}

if($request == 1) {
//Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $searchArray = array();
//Search
    $searchQuery = " ";
    if ($searchValue != '') {
        $searchQuery = " AND (username LIKE :username)";
        $searchArray = array(
            'username' => "%$searchValue%"
        );
    }

    $res = $conn->prepare('SELECT COUNT(*) as allcount FROM tblEmployee');
    $res->execute();
    $records = $res->fetch();
    $totalRecords = $records['allcount'];

    $res1 = $conn->prepare("SELECT COUNT(*) as allcount FROM tblEmployee WHERE 1 " . $searchQuery);
    $res1->execute($searchArray);
    $records = $res1->fetch();
    $totalRecordwithFilter = $records['allcount'];

    $stmt = $conn->prepare("select * from tblEmployee WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

    foreach($searchArray as $key=>$search){
        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
    $stmt->execute();
    $resultSet = $stmt->fetchAll();

    $data = array();
    foreach ($resultSet as $row) {
        $updateButton = "<button class='btn btn-sm btn-clean btn-icon editMember' data-id='".$row['id']."' data-toggle='modal' data-target='#editMember' ><i class='la la-edit'></i></button>";

        $deleteButton = "<button class='btn btn-sm btn-clean btn-icon deleteMember' data-id='" . $row['id'] . "'><i class='la la-trash'></i></button>";

        $action = $updateButton." ".$deleteButton;

        switch ($row['e_role']){
            case 1:
                $row['e_role'] = 'Administrator';
                break;
            case 2:
                $row['e_role'] = 'Manager';
                break;
            case 3:
                $row['e_role'] = 'Member';
                break;
        }

        $data[] = array(
            "e_name" => $row['e_name'],
            "username" => $row['username'],
            "phone" => $row['phone'],
            "e_role" => $row['e_role'],
            "Actions" => $action
        );
    }

    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );

    echo json_encode($response);
}

if($request == 2){
    $id = 0;

    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $query = "delete from tblEmployee where id=:id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        if($stmt->execute()) {
            echo 1;
            exit;
        }else{
            echo 0;
            exit;
        }
    }
}

if($request == 3){
    $id = 0;

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $response = array();

        $query = "SELECT * FROM tblEmployee WHERE id=:id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            $resultSet = $stmt->fetchAll();

            foreach ($resultSet as $row) {
                $response = array(
                    "e_name" => $row['e_name'],
                    "username" => $row['username'],
                    "phone" => $row['phone'],
                    "e_role" => $row['e_role'],
                );
            }

            echo json_encode(array("status" => 1,"data" => $response));
            exit;
        }else{
            echo json_encode(array("status" => 0));
            exit;
        }

    }
}

if($request == 4){
    $id = 0;

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $name = $_POST['e_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $password = strip_tags($password);
        $password = addslashes($password);
        $phone = $_POST['phone'];
        $role = $_POST['e_role'];

        if($username != '' && $password != '' && $role != ''){
            $query = "UPDATE tblEmployee SET e_name=:e_name, phone=:phone, username=:username, password=:password, e_role=:e_role WHERE id=:id";

            $stmt = $conn->prepare($query);

            $name = htmlspecialchars(strip_tags($name));
            $username = htmlspecialchars(strip_tags($username));
            $phone = htmlspecialchars(strip_tags($phone));
            $role = htmlspecialchars(strip_tags($role));

            $stmt->bindParam(":e_name", $name);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":e_role", $role);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            echo json_encode( array("status" => 1,"message" => "Record updated.") );
            exit;
        }else{
            echo json_encode( array("status" => 0,"message" => "Please fill all fields.") );
            exit;
        }
    }else{
        echo json_encode( array("status" => 0,"message" => "Invalid ID.") );
        exit;
    }
}