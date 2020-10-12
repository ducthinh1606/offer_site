<?php
include ('connect.php');

$stmt = $conn->prepare("SELECT email, network_name, app_name, datetime, tblHistory.coins FROM tblHistory INNER JOIN tblUsers on tblUsers.id = tblHistory.tblUsers_id ORDER BY datetime DESC LIMIT 15");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$result = $stmt->fetchAll();

foreach ($result as $row){
    ?>

    <div class="d-flex align-items-center flex-wrap mb-5" >
        <div class="d-flex flex-column flex-grow-1 mr-2">
            <span  class="font-weight-bold text-success text-hover-primary font-size-sm"><?php echo $row['email'] ?></span>
            <span class="text-muted font-size-sm"><?php echo $row['network_name'] ?></span>
            <span class="text-muted font-size-sm"><?php echo $row['app_name'] ?></span>
            <span class="text-muted font-size-sm"><?php echo $row['datetime'] ?></span>
        </div>
        <span class="btn btn-sm btn-success btn-shadow font-weight-bolder py-1 my-lg-0 my-2 text-light-50">+<?php echo $row['coins'] ?></span>
    </div>

<?php }?>