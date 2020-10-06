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
        $searchQuery = " AND (email LIKE :email or 
        gaid LIKE :gaid) ";
        $searchArray = array(
            'email' => "%$searchValue%",
            'gaid' => "%$searchValue%",
        );
    }

    $res = $conn->prepare('SELECT COUNT(*) as allcount from tblUsers inner join tblHistory on tblUsers.id = tblHistory.tblUsers_id inner join tblApps on tblHistory.tblApps_id = tblApps.id');
    $res->execute();
    $records = $res->fetch();
    $totalRecords = $records['allcount'];

    $res1 = $conn->prepare("SELECT COUNT(*) as allcount from tblUsers inner join tblHistory on tblUsers.id = tblHistory.tblUsers_id inner join tblApps on tblHistory.tblApps_id = tblApps.id WHERE 1 " . $searchQuery);
    $res1->execute($searchArray);
    $records = $res1->fetch();
    $totalRecordwithFilter = $records['allcount'];

    $stmt = $conn->prepare("select tblUsers.id, tblUsers.email, tblUsers.coins, tblUsers.IP, tblUsers.created_at, tblUsers.gaid, tblApps.app_name from tblUsers inner join tblHistory on tblUsers.id = tblHistory.tblUsers_id inner join tblApps on tblHistory.tblApps_id = tblApps.id WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

    foreach($searchArray as $key=>$search){
        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
    $stmt->execute();
    $resultSet = $stmt->fetchAll();

    $data = array();
    foreach ($resultSet as $row) {
        $deleteButton = "<button class='btn btn-sm btn-clean btn-icon deleteUser' data-id='" . $row['id'] . "'><i class='la la-trash'></i></button>";

        $action = $deleteButton;
        $data[] = array(
            "created_at" => $row['created_at'],
            "email" => $row['email'],
            "id" => $row['id'],
            "app_name" => $row['app_name'],
            "coins" => $row['coins'],
            "IP" => $row['IP'],
            "gaid" => $row['gaid'],
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

        $query = "delete from tblUsers where id=:id";

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
