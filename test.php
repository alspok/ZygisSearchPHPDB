<?php

print("<a>Test sql connection</a><br>");

$username = "doadmin";
$password = "AVNS_sXck3RvigxdBy5-Jv1e";
$host = "db-mysql-fra1-43334-do-user-14106707-0.b.db.ondigitalocean.com";
$port = 25060;
$database = "e_deals_db";
$sslmode = "REQUIRED";
$tablename = "e_deals_tbl";

// create connection
$conn = new mysqli($host, $username, $password, $database, $port, $sslmode);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<br>Connected successfully<br>";

$query = "CREATE TABLE IF NOT EXISTS $tablename (
         id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
         company char(30),
         ean char(30),
         unique_item char(30),
         item_sku char(30),
         product_name char(60),
         brand_name char(30),
         required_price_to_amazon char(30)
         );";
         
$conn->query($query);
if($conn->connect_error) {
    die("Table creation faild: " . $conn->connect_error);
}
echo"<br>Table created<br>";

$query = "INSERT INTO $tablename (company, unique_item, brand_name) VALUES ('the best', 'not', 'teva'),
                                                                           ('the rest', 'not', 'adidas'),
                                                                           ('best of rest', 'yes', 'nike');";

$conn->query($query);
echo("<br>Values added<br>,<br>");

$query = "SELECT * FROM $tablename LIMIT 20;";
$result = $conn->query($query);
$i = 1;
while($res = $result->fetch_assoc()){
    printf("<a style='font-size: 12px'>%d | %s | %s | %s | %s | %s | %s | %s</a><br>",
             $i, $res['company'], $res['ean'], $res['unique_item'], $res['item_sku'], $res['product_name'], $res['brand_name'], $res['required_price_to_amazon']);
    $i += 1;
}