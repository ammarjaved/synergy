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
        $m_no= $_REQUEST['Meter_no'];
        // $m_no= 2;
       
        
        $sql = "select * from demand_point where meter_no='".$m_no."'";
        $result_query = pg_query($sql);
        $response = "<span style='color: green;'>Meter_no Available</span>";
        if($result_query)
        {
           // $output = pg_fetch_assoc($result_query);
            while($row=pg_fetch_assoc($result_query))
            {
                $count = $row['device_id'];
                // echo $count;
                if($count !=''){
                  
                    $response = "<span style='color: red;'>Meter_no Already Exist.</span>";
                }
                // else{
                //    $response = "<span style='color: green;'>Meter_no Available.</span>";
                // }
                
            }
        }

        echo $response;
        exit();


        
    }
}

$json = new InsertData();
//$json->closeConnection();
echo $json->loadData();
?>


