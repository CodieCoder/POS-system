<?php

function sqlQuery($connector, $tb, $sql)
{
    if ($do = $connector->query($sql)) {
        $result = "<hr color = '#191'/>Table <font color = 'purple'>' $tb ' </font>created successfully </hr>";
    } else {
        $err = $connector->error;
        $result = "<hr color = '#191'/>Table <font color = 'red'>' $tb ' </font> was not created </hr>" . $err . '<hr>';
    }
    return $result;
}

$db = "zpm_inventory_db";
$s = "127.0.0.1";
$u = "root";
$p = "Root";

$con = new mysqli($s, $u, $p, $db);

$tb = 'zpm_staffs';
$sql = "INSERT INTO $tb (level, name, username, password, lockr, randkey, dateOfReg) VALUES ('0', 'John Doe', 'admin1', 'admin1', '1', '75ytio9uy87iyuj', '08/04/2023')";
$result = mysqli_query($con, $sql);
if ($result) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . mysqli_error($con);
}

mysqli_close($con);
