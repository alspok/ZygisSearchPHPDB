<?php
class ConnectDB{
    public function connectDB(string $host, int $port, string $user_name, string $password, string $db_name): object{
        $connection = mysqli_connect($host, $port, $user_name, $password, $db_name);
        if($connection === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        return $connection;
    }
    public function createTBL(object $connection, string $tbl_name): void{
        $query = "DROP TABLE IF EXISTS $tbl_name";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Unable to drop table $tbl_name <br>" . mysqli_error($connection));
        }

        $query = "CREATE TABLE $tbl_name (
            id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            company varchar(30) NOT NULL,
            ean varchar(20) NOT NULL,
            unique_repeat varchar(20),
            item_sku varchar(20) NOT NULL,
            product_name varchar(255) NOT NULL,
            brand_name varchar(20) NOT NULL,
            required_price_to_amazon varchar(20) NOT NULL)";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Unable to create $tbl_name <br>" . mysqli_error($connection));
        }
    }
}
?>