<?php ini_set('max_execution_time', '0');

include "Classes/ConnectDB.php";
include "Classes/AddFileDB.php";
include "Classes/CleanDB.php";

print("<h3>Welcome to Zygis DB search</h3>");

$username = "doadmin";
$password = "AVNS_sXck3RvigxdBy5-Jv1e";
$host = 'db-mysql-fra1-43334-do-user-14106707-0.b.db.ondigitalocean.com';
$port = 25060;
$database = "e_deals_db";
$sslmode = "REQUIRED";
$tablename = "e_deals_tbl";

$conn = new mysqli($host, $username, $password, $database, $port, $sslmode);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "<br>Connected to <b>" . $database . " </b>database<br>";
}

$conn = new ConnectDB();
$conn->createTBL($conn, $database, $tablename);

$file_names = [
    // "./DataFiles/Action_PriceList_2_1_2023_EN.csv.mod.csv",
    "./DataFiles/FRAGNANCES.csv.mod.csv",
    // "./DataFiles/eeteuroparts.csv.mod.csv",
    // "./DataFiles/b2bindividuelllive_b2bexport1de.csv.mod.csv",
    // "./DataFiles/ProductCatalogue_20230319122946.csv.mod.csv",
];

$add_file = new AddFileDB();
foreach ($file_names as $file_name){
    $add_file -> addFileDB($conn, $tablename, $file_name);
}

// var_dump($conn);
// $connection->selectTBL($conn, $tablename);
// $clean = new CleanDB();
// $unique_values = $clean->cleanDB($conn, $tbl_name);

?>
