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

        $p_id=$_REQUEST['p_id'];
        $dp=$_REQUEST['dp'];



        if($dp==1) {
            $sql_reg = "DELETE FROM public.demand_point WHERE p_id=$p_id;";
        }else{
            $sql_reg = "DELETE FROM public.demand_point WHERE device_id='$p_id';";
        }

  //  echo $sql_reg;

        $sql_reg_num = pg_query($sql_reg);



        if($sql_reg_num){
            return "Record Deleted";
        }else{
           return "failure";
        }
    }





}

$json = new InsertData();
//$json->closeConnection();
echo $json->loadData();
?>


