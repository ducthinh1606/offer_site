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
        $searchQuery = " AND (network_name LIKE :network_name)";
        $searchArray = array(
            'network_name' => "%$searchValue%"
        );
    }

    $res = $conn->prepare('SELECT COUNT(*) as allcount FROM tblNetwork');
    $res->execute();
    $records = $res->fetch();
    $totalRecords = $records['allcount'];

    $res1 = $conn->prepare("SELECT COUNT(*) as allcount FROM tblNetwork WHERE 1 " . $searchQuery);
    $res1->execute($searchArray);
    $records = $res1->fetch();
    $totalRecordwithFilter = $records['allcount'];

    $stmt = $conn->prepare("select * from tblNetwork WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

    foreach($searchArray as $key=>$search){
        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
    $stmt->execute();
    $resultSet = $stmt->fetchAll();

    $data = array();
    foreach ($resultSet as $row) {
        $updateButton = "<button class='btn btn-sm btn-clean btn-icon editNetwork' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal' ><i class='la la-edit'></i></button>";

        $deleteButton = "<button class='btn btn-sm btn-clean btn-icon deleteNetwork' data-id='" . $row['id'] . "'><i class='la la-trash'></i></button>";

        $action = $updateButton." ".$deleteButton;
        $data[] = array(
            "network_name" => $row['network_name'],
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

        $query = "delete from tblNetwork where id=:id";

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

        $query = "SELECT * FROM tblNetwork WHERE id=:id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            $resultSet = $stmt->fetchAll();

            foreach ($resultSet as $row) {
                $response = array(
                    "network_name" => $row['network_name']
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
        $name = $_POST['network_name'];

        if($name != ''){
            $query = "UPDATE tblNetwork SET network_name=:network_name WHERE id=:id";

            $stmt = $conn->prepare($query);

            $name = htmlspecialchars(strip_tags($name));

            $stmt->bindParam(":network_name", $name);
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