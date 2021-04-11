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
        
        $status=$_REQUEST['Status'];
        $dboper=$_REQUEST['DBOper'];
        $remarks=$_REQUEST['Remarks'];
        $deviceid=$_REQUEST['Device_ID'];
        $houseno=$_REQUEST['House_No'];
        $name=$_REQUEST['Name'];
        $disttranx=$_REQUEST['Dist_Tranx'];
        $meterno=$_REQUEST['Meter_no'];
        $lat=$_REQUEST['lat'];
        $lng=$_REQUEST['lng'];


        $latlng = $lat." ".$lng." ";
        // $geom=json_encode($latlng);
        //  print_r($geom);
        //         exit();

// $sql_ins="INSERT INTO ".'"'."Demand_Point".'"'."(status) VALUES ('$status') ";

//         $sql_reg_num = pg_query($sql_ins);

//         if($sql_reg_num){
//             return "success";
//         }else{
//            return "failure";
//         }

//           exit();


                   
         $sql_ins=" INSERT INTO ".'"'."Demand_Point".'"'."(status, db_oper, remarks, device_id, 
                  house_no, str_name, dist_tranx, meter_no, geom) 
                   
                  VALUES ('$status', '$dboper', '$remarks', '$deviceid', '$houseno',
                  '$name', '$disttranx','$meterno', ST_SetSRID(ST_MakePoint($latlng), 4326)) ) ";





       echo $sql_ins;
       //  exit();

        $sql_reg_num = pg_query($sql_ins);

        if($sql_reg_num){
            return "success";
        }else{
           return "failure";
        }
    }





}

$json = new InsertData();
//$json->closeConnection();
echo $json->loadData();
?>


