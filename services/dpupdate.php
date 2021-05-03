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
        if(isset($_POST['Meter_no'])){

            $status=$_REQUEST['Status'];
            $db_op=$_REQUEST['DBOper'];
            $remarks=$_REQUEST['Remarks'];
            $device_id=$_REQUEST['Device_ID'];
            $house_no=$_REQUEST['House_No'];
            $name=$_REQUEST['Name'];
            $trans=$_REQUEST['Dist_Tranx'];
            $m_no= $_REQUEST['Meter_no'];
            $p_id=$_REQUEST['p_id'];
            $comment=$_REQUEST['comment'];
            // $p_id=1;
            $user_id=$_REQUEST['user_id'];

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
                        echo "Meter No already exist";
                        exit();
                    }


                }
            }

            $sql_sth="select assb_house_no,street from public.bangi_customer where equipment='$m_no'";
            $result_sth = pg_query($sql_sth);
            $rs_sth=pg_fetch_assoc($result_sth);
            $h_no=$rs_sth['assb_house_no'];
            $s_name=$rs_sth['street'];
        
            $sql_reg="UPDATE public.demand_point
            SET  status='$status', user_id='$user_id', db_oper='$db_op', remarks='$remarks', house_no='$h_no', str_name='$s_name', dist_tranx='$trans',  meter_no='$m_no',comment='$comment'
            WHERE device_id='$device_id'";
            $sql_reg_num = pg_query($sql_reg);

            if($sql_reg_num){
                echo 1;
            }else{
            echo 0;
            }
        }
       
    }





}

$json = new InsertData();
//$json->closeConnection();
echo $json->loadData();
?>


