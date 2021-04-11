<?php

include("connection.php");
class InsertData extends connection
{
    function __construct()
    {
        $this->connectionDB();

    }
    public function loadData()
    {
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
                
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                
                // Skip the first line
                fgetcsv($csvFile);
                
                // Parse data from CSV file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    // Get row data
                    $mno   = $line[0];
                    $sql = "INSERT into exceltbl (meter_no) values ('".$mno."')";
                    pg_query($sql);
                    
                    
                    // Check whether member already exists in the database with the same email
                    // $sql1 = "SELECT id FROM exceltbl WHERE meter_no = '".$line[0]."'";
                    // $prevResult = pg_query($sql1);
                    
                    // if($prevResult->num_rows > 0){
                    //     // Update member data in the database
                    //     $db->query("UPDATE exceltbl SET meter_no = '".$mno."' WHERE email = '".$email."'");
                    // }else{
                        // Insert member data in the database
                        // $db->query("INSERT INTO members (name, email, phone, created, modified, status) VALUES ('".$name."', '".$email."', '".$phone."', NOW(), NOW(), '".$status."')");
                    // }
                }
                // Close opened CSV file
                fclose($csvFile);
            }
        }   
    }

        
        
}

$json = new InsertData();
//$json->closeConnection();
echo $json->loadData();
?>


