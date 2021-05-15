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
        $searchQuery = " AND (app_name LIKE :app_name)";
        $searchArray = array(
            'app_name' => "%$searchValue%"
        );
    }

    $res = $conn->prepare('SELECT COUNT(*) as allcount FROM tblApps');
    $res->execute();
    $records = $res->fetch();
    $totalRecords = $records['allcount'];

    $res1 = $conn->prepare("SELECT COUNT(*) as allcount FROM tblApps WHERE 1 " . $searchQuery);
    $res1->execute($searchArray);
    $records = $res1->fetch();
    $totalRecordwithFilter = $records['allcount'];

    $stmt = $conn->prepare("select * from tblApps WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

    foreach($searchArray as $key=>$search){
        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
    $stmt->execute();
    $resultSet = $stmt->fetchAll();

    $data = array();
    foreach ($resultSet as $row) {
        $updateButton = "<button class='btn btn-sm btn-clean btn-icon editApplication' data-id='".$row['id']."' data-toggle='modal' data-target='#editApplication' ><i class='la la-edit'></i></button>";

        $deleteButton = "<button class='btn btn-sm btn-clean btn-icon deleteApplication' data-id='" . $row['id'] . "'><i class='la la-trash'></i></button>";

        $action = $updateButton." ".$deleteButton;
        $data[] = array(
            "app_name" => $row['app_name'],
            "net_work" => $row['net_work'],
            "url" => $row['url'],
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

        $query = "delete from tblApps where id=:id";

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

        $query = "SELECT * FROM tblApps WHERE id=:id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            $resultSet = $stmt->fetchAll();

            foreach ($resultSet as $row) {
                $response = array(
                    "app_name" => $row['app_name'],
                    "net_work" => $row['net_work'],
                    "url" => $row['url'],
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
        $name = $_POST['app_name'];
        $network = $_POST['net_work'];
        $url = $_POST['url'];

        if($name != '' && $network != '' && $url != ''){
            $query = "UPDATE tblApps SET app_name=:app_name, net_work=:net_work, url=:url WHERE id=:id";

            $stmt = $conn->prepare($query);

            $name = htmlspecialchars(strip_tags($name));
            $url = htmlspecialchars(strip_tags($url));

            $stmt->bindParam(":net_work", $network);
            $stmt->bindParam(":app_name", $name);
            $stmt->bindParam(":url", $url);
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