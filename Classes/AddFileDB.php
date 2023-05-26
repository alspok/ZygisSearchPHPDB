<?php
class AddFileDB{
    public function addFileDB(object $conn, string $tablename, string $file_name): void{
        error_reporting(E_ALL ^ E_WARNING);
        $company = basename($file_name, '.csv.mod.csv');

        // $dictionary = [];
        // $fh = fopen($file_name, "r");
        // if($fh != FALSE){
        //     while (($data = fgetcsv($fh, 1000, ",")) !== FALSE) {
        //         // Store the key-value pair in the dictionary
        //         $dictionary[$data[0]] = $data[1];
        //     }   
        // }
        // fclose($fh);
        // print('<pre>');
        // print_r($dictionary);
        // print('</pre>');

        // $csv = str_getcsv(file_get_contents($file_name));
        // print('<pre>');
        // print_r($csv);
        // print('</pre>');

        $csv_array = array();
        $lines = file($file_name, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $key => $value) {
            $csv_array[$key] = str_getcsv($value);
        }

        array_shift($csv_array);
        // echo '<pre>';
        // print_r($csv_array);
        // echo '</pre>';
        
        // array_shift($csv_array);
        // $csv_array = array_filter($csv_array);
        // echo("<pre>".print_r($csv_array, true)."</pre>");
        foreach($csv_array as $array){
            print("<pre>" . $array[0] . ' | ' . $array[1] . "</pre>" . "<br>");
            $query = "INSERT INTO $tablename (company, ean, unique_item, item_sku, product_name, brand_name, required_price_to_amazon)
                          VALUES ('$company', '$array[0]', 'yes', '$array[1]', '$array[2]', '$array[3]', '$array[4]');";
            print_r($query . "<br>");
            $conn->query($query);
            if($conn->connect_error){
                die("Table access failed: " . $conn->error);
            }
        }

            // for($i = 0; $i < count($array); $i++){
            //     // print_r("<pre>" . $i . '|' . $array[$i] . "<br>");
            //     // $array[$i] = str_replace(['"', "'"], '', $array[$i]);
            //     $query = "INSERT INTO $tablename (company, ean, unique_item, item_sku, product_name, brand_name, required_price_to_amazon)
            //               VALUES ('$company', '$array[0]', 'yes', '$array[1]', '$array[2]', '$array[3]', '$array[4]');";
            //     print_r($query . "<br>");
            //     $conn->query($query);
            //     if($conn->connect_error){
            //         die("Table access failed: " . $conn->error);
            //     }
            // print("<a style='font-size: 16px'>File <b>$file_name</b> added to database </a><br>");
            }
        }
        print("<br>Array added<br>");

        $query = "SELECT * FROM $tablename LIMIT 20;";
        $result = $conn->query($query);
        $i = 1;
        while($res = $result->fetch_assoc()){
            printf("<a style='font-size: 12px'>%d | %s | %s | %s | %s | %s | %s | %s</a><br>",
            $i, $res['company'], $res['ean'], $res['unique_item'], $res['item_sku'], $res['product_name'], $res['brand_name'], $res['required_price_to_amazon']);
            $i += 1;
        }
?>