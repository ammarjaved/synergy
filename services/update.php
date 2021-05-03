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
        $db_op=$_REQUEST['DBOper'];
        $remarks=$_REQUEST['Remarks'];
        $device_id=$_REQUEST['Device_ID'];
        $house_no=$_REQUEST['House_No'];
        $name=$_REQUEST['Name'];
        $trans=$_REQUEST['Dist_Tranx'];
        $m_no= $_REQUEST['Meter_no'];
        $p_id=$_REQUEST['p_id'];
        $comment=$_REQUEST['comment1'];
        $user_id=$_REQUEST['user_id'];

        $meter_nos=array();




        if (strpos($m_no, ',') !== false) {
           // echo $m_no;
            $meter_nos= explode(',',$m_no);
           // print_r($meter_nos);
           // exit();
            $m_no=$meter_nos[0];
           // echo $m_no;

            $sql_meter="select * from public.demand_point where meter_no='$m_no'";
            $result_query = pg_query($sql_meter);
            if($result_query)
            {
                // $output = pg_fetch_assoc($result_query);
                while($row=pg_fetch_assoc($result_query))
                {
                    $count = $row['device_id'];
                    // echo $count;
                    if($count !='') {
                        echo "Meter already exist";
                        exit();
                    }

                }


                for($i=0;$i<count($meter_nos);$i++){
                     //echo($meter_nos[$i]);
                    //$sql = "INSERT into consumer (meter_no,device_id) values ('".$meter_nos[$i]."','".$device_id."')";
                    $sql="update bangi_customer set device_id='$device_id' where equipment='".$meter_nos[$i]."'";
                    //echo $sql;
                    //exit();
                    pg_query($sql);
                }


            }
        }else{
            $m_no=$m_no;
            $sql_meter="select * from public.demand_point where meter_no='$m_no'";
            $result_query = pg_query($sql_meter);
            if($result_query)
            {
                // $output = pg_fetch_assoc($result_query);
                while($row=pg_fetch_assoc($result_query))
                {
                    $count = $row['device_id'];
                    // echo $count;
                    if($count !='') {
                        echo "Meter already exist";
                        exit();
                    }


                }
            }
        }

       //print_r($meter_nos);
        $sql_sth="select assb_house_no,street from public.bangi_customer where equipment='$m_no'";
        $result_sth = pg_query($sql_sth);
        $rs_sth=pg_fetch_assoc($result_sth);
        $h_no=$rs_sth['assb_house_no'];
        $s_name=$rs_sth['street'];






        $sql_reg="UPDATE public.demand_point
	SET  status='$status', user_id='$user_id', db_oper='$db_op', remarks='$remarks',  house_no='$h_no', str_name='$s_name', dist_tranx='$trans',  meter_no='$m_no',comment='$comment'
	WHERE device_id='$device_id'";
        $sql_reg_num = pg_query($sql_reg);

        //$sql="update bangi_customer set device_id='$device_id' where equipment='$m_no'";
        ///echo $sql;
        //pg_query($sql);


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
                   // $sql = "INSERT into consumer (meter_no,device_id) values ('".$mno."','".$device_id."')";
                   // pg_query($sql);

                    $sql="update bangi_customer set device_id='$device_id' where equipment='$mno'";
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


