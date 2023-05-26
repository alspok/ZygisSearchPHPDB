<?php
class ConnectDB{
    public function connectDB(string $host, string $username, string $password, string $database, int $port, string $sslmode): object{
        $conn = new mysqli($host, $username, $password, $database, $port, $sslmode);
        var_dump($conn);
        // $connection = mysqli_connect($host, $port, $user_name, $password, $db_name);
        if(!$conn->connect_error){
            die("ERROR: Could not connect. " . $conn->connect_error);
        }
        echo "Connected to database <b>" . $database . "</b> successfully<br>";

        return $conn;
    }
    public function createTBL(object $conn, string $database, string $tablename): void{
        mysqli_select_db($conn, $database );

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

        if(!$conn->query($query)){
            die("Error creating table: " . $conn->connect_error);
        }
        else {
            echo "Table <b>" . $tablename . "</b> ok<br>";
        }
    }

    public function selectTBL(object $conn, string $tablename): void{
        $query = "SELECT * FROM $tablename LIMIT 20;";
        var_dump($query);
        $result = $conn->query($query);
        if($result)
        while($row = $result->fetch_assoc()){
            $row_array[] = $row;
            echo $row['company'] . ' ' . $row['ean'] . ' ' . $row['unique_item'] . ' ' . 
                 $row['item_sku'] . ' ' . $row['product_name'] . ' ' . $row['brand_name'] . ' ' .
                 $row['required_price_to_amazon'] . '<br>';
                }
        $conn->free_result($result);
    }
}
?>