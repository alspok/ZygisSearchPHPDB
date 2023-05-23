<?php
class ConnectDB{
    public function connectDB(string $host, string $username, string $password, string $database, int $port, string $sslmode): object{
        $connection = new mysqli($host, $username, $password, $database, $port, $sslmode);
        // $connection = mysqli_connect($host, $port, $user_name, $password, $db_name);
        if($connection === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        echo "Connected to database <b>" . $database . "</b> successfully<br>";

        return $connection;
    }
    public function createTBL(object $connection, string $database, string $tbl_name): void{
        mysqli_select_db($connection, $database );
        $query = "DROP TABLE IF EXISTS $tbl_name";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Unable to drop table $tbl_name <br>" . mysqli_error($connection));
        }

        $query = "CREATE TABLE $tbl_name (
            -- id int IDENTITY(1,1) PRIMARY KEY,
            company varchar(30) NOT NULL,
            ean varchar(20) NOT NULL,
            -- unique_repeat varchar(20),
            item_sku varchar(20) NOT NULL,
            product_name varchar(255) NOT NULL,
            brand_name varchar(20) NOT NULL,
            required_price_to_amazon varchar(20) NOT NULL)";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Unable to create $tbl_name <br>" . mysqli_error($connection));
        }
        else{
            echo("Table <b>" . $tbl_name . "</b> created<br>");
        }
    }
}
?>