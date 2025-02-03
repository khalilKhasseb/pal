<?php
namespace App\Classes;

class CSVParser
{

   

      public function getNames(){}	
    

	public static function parse($file_path)
    {
        $data = [];
        $file = fopen($file_path, 'r');

        // loop to get data 
        $row = 0;
        while (!feof($file)) {
            $csv_file = fgetcsv($file, 1000, ',');
            if (!empty($csv_file)) {
                // check for fist entry to map to props 
                if ($row == 0) {
                    $data['attribute'] = $csv_file;
                } else {
                    // map vlues to new keys
                    //$data[] = $csv_file;
                    $item = [];
                    foreach ($csv_file as $key => $value) {
                        $item[$data['attribute'][$key]] = $value;
                    }
                    $data[] = $item;
                }
            }
            $row++;
        }
        fclose($file);
        unset($data['attribute']);
        // dd($data);
        return $data;
    }

    static function parse_post_meta($file_path) {
        //post meta key maped to column title
        //post meta value maped to value for each column 
        
    }
}
