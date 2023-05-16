<?php ini_set('max_execution_time', '0');

include "Classes/ConnectDB.php";
include "Classes/AddFileDB.php";
include "Classes/CleanDB.php";

print("<h3>Welcome to Zygis DB search</h3>");

// $host = 'localhost';
// $user_name = 'root';
// $password = '';
// $db_name = 'e-deals-db';
// $tbl_name = 'e_deals_tbl'; // 

$username = 'doadmin';
$password = 'AVNS_8KPSkB3aCglqOlUajdh';
$host = 'db-mysql-fra1-44995-do-user-14106707-0.b.db.ondigitalocean.com';
$port = '25060';
$database = 'defaultdb';
$sslmode = 'REQUIRED';

$connection = new ConnectDB();
$conn = $connection->connectDB($host, $user_name, $password, $db_name);

$connection->createTBL($conn, $tbl_name);

// $file_names = array();
// // $file_names['Actio_Price_list'] = "./DataFiles/Action_PriceList_2_1_2023_EN.csv.mod.csv";
// $file_names['Fragnances'] = "./DataFiles/FRAGNANCES.csv.mod.csv";
// // $file_names['Eeteuroparts'] = "./DataFiles/eeteuroparts.csv.mod.csv";
// // $file_names['B2Bindividue'] = "./DataFiles/b2bindividuelllive_b2bexport1de.csv.mod.csv";
// // $file_names['ProductCatalogue'] = "./DataFiles/ProductCatalogue_20230319122946.csv.mod.csv";

// $add_file = new AddFileDB();
// foreach($file_names as $key => $value){
//     $add_file -> addFileDB($conn, $key, $value);
// }

$file_names = [
    // "./DataFiles/Action_PriceList_2_1_2023_EN.csv.mod.csv",
    "./DataFiles/FRAGNANCES.csv.mod.csv",
    // "./DataFiles/eeteuroparts.csv.mod.csv",
    // "./DataFiles/b2bindividuelllive_b2bexport1de.csv.mod.csv",
    // "./DataFiles/ProductCatalogue_20230319122946.csv.mod.csv",
];

$add_file = new AddFileDB();

$table_name = $tbl_name;
foreach ($file_names as $file_name){
    $add_file -> addFileDB($conn, $table_name, $file_name);
}

$clean = new CleanDB();
$unique_values = $clean->cleanDB($conn, $tbl_name);

?>