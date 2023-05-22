<?php
class CleanDB{
    public function cleanDB(object $conn, string $tbl_name): array{
        // set_time_limit(500);
        $query = "select * from $tbl_name";
        $result = $conn->query($query);
        $column_data = [];
        while($row = mysqli_fetch_array($result)){
            array_push($column_data, $row["ean"]);
        }

        print("column_data count: " . count($column_data) . "<br>");
        // foreach($column_data as $data){
        //     print($data . "<br>");
        // }
       
        print("Array size before push: " . count($column_data) . "<br>");
        $unique_values = [];
        $repeat_values = [];
        foreach($column_data as $data){
            if(!in_array($data, $unique_values)){
                array_push($unique_values, $data);
                $query = "update $tbl_name set unique_repeat = 'unique' where ean = $data";
                $result = $conn->query($query);
            }
            else{
                array_push($repeat_values, $data);
                $query = "update $tbl_name set unique_repeat = 'repeat' where ean = $data";
                $result = $conn->query($query);
            }
        }
        print("Repeated values: " . count($repeat_values) . "<br>");
        print("Array size after push: " . count($unique_values) . "<br>");

        return $unique_values;
    }
}

?>