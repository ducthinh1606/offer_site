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
    $columnSortOrder = $_POST['order'][0]['dir'] == 'asc' ? 'desc' : 'asc'; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $searchArray = array();
//Search
    $searchQuery = " ";
    if ($searchValue != '') {
        $searchQuery = " AND (email LIKE :email or 
        gaid LIKE :gaid) ";
        $searchArray = array(
            'email' => "$searchValue%",
            'gaid' => "$searchValue%",
        );
    }

    $res = $conn->prepare('SELECT COUNT(*) as allcount FROM tblHistory inner join tblUsers on tblHistory.tblUsers_id = tblUsers.id');
    $res->execute();
    $records = $res->fetch();
    $totalRecords = $records['allcount'];

    $res1 = $conn->prepare("SELECT COUNT(*) as allcount FROM tblHistory inner join tblUsers on tblHistory.tblUsers_id = tblUsers.id WHERE 1 " . $searchQuery);
    $res1->execute($searchArray);
    $records = $res1->fetch();
    $totalRecordwithFilter = $records['allcount'];

    $stmt = $conn->prepare("SELECT tblHistory.id, tblHistory.datetime, tblHistory.coins, tblHistory.network_name, tblUsers.gaid, tblUsers.email, tblUsers.app_name from tblHistory inner join tblUsers on tblHistory.tblUsers_id = tblUsers.id WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

    foreach($searchArray as $key=>$search){
        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
    $stmt->execute();
    $resultSet = $stmt->fetchAll();

    $data = array();
    foreach ($resultSet as $row) {
        $deleteButton = "<button class='btn btn-sm btn-clean btn-icon deleteHistory' data-id='" . $row['id'] . "'><i class='la la-trash'></i></button>";

        $action = $deleteButton;
        $data[] = array(
            "datetime" => $row['datetime'],
            "coins" => $row['coins'],
            "network_name" => $row['network_name'],
            "gaid" => $row['gaid'],
            "email" => $row['email'],
            "app_name" => $row['app_name'],
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

        $query = "delete from tblHistory where id=:id";

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
