<?php
class AddFileDB{
    public function addFileDB(object $conn, string $table_name, string $file_name): void{
        error_reporting(E_ALL ^ E_WARNING);
        $company = basename($file_name, '.csv.mod.csv');
        // var_dump($company . '<br>' . $file_name . '<br>');
        $file = fopen($file_name, "r");
            while(!feof($file)){
                $csv_array[] = fgetcsv($file);
            }
        fclose($file);
        
        // Remove first row of csv file and remove empty elements of array.
        array_shift($csv_array);
        $csv_array = array_filter($csv_array);
        // print("<pre>".print_r($csv_array, true)."</pre>");
        try{
            foreach($csv_array as $array){
                for($i = 0; $i < count($array); $i++){
                    $array[$i] = str_replace(['"', "'"], '', $array[$i]);
                }
                $query = "INSERT INTO " . $table_name . " ('company', 'ean', 'item_sku', 'product_name', 'brand_name', 'required_price_to_amazon')
                          VALUES ($company, $array[0], $array[1], $array[2], $array[3], $array[4]')";
                var_dump($query);
                $result = mysqli_query($conn, $query);
                if(!$result){
                    die("Table access failed: " . mysqli_error($conn));
                }
                }
                print("<a style='font-size: 16px'>File <b>$file_name</b> added to database </a><br>");
            }
        catch (Exception $e){
                print( 'Caught exception: ' . $e->getMessage() . "\n");
            }
        }
    }

?>