<?php
include ('../connect.php');

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
$searchQuery = "";
if ($searchValue != '') {
    $searchQuery = " AND (app_name LIKE :app_name) ";
    $searchArray = array(
        'app_name' => "$searchValue%"

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


$stmt_name = $conn->prepare('select network_name from tblNetwork');
$stmt_name->setFetchMode(PDO::FETCH_ASSOC);
$stmt_name->execute();
$resultName = $stmt_name->fetchAll();


$data = array();
$data1 = array();
$last = array();
$stmt = $conn->prepare("select tblhistory.network_name, tblapps.app_name, SUM(coins) as total from tblhistory INNER JOIN tblapps ON tblhistory.tblapps_id = tblapps.id WHERE MONTH(datetime) = MONTH(CURDATE()) AND YEAR(datetime) = YEAR(CURDATE()) " . $searchQuery . " group by network_name, tblapps_id LIMIT :limit,:offset");

foreach($searchArray as $key=>$search){
    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();

foreach ($resultSet as $row) {
    foreach ($resultName as $row1) {
        if ($row1['network_name'] == $row['network_name']){
            $data1[$row1['network_name']] = $row['total'];
        }else $data1[$row1['network_name']] = '';
    }

    $data = array(
        "app_name" => $row['app_name']
    );
    $temp = array_merge($data,$data1);
    array_push($last, $temp);
}

$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $last
);

echo json_encode($response);