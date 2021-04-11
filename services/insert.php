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
        

        $geom= $_REQUEST['geom'];
        $uid= $_REQUEST['uid'];

//
        $sql_reg="INSERT INTO public.demand_point(geom,user_id) VALUES (st_geomFromgeojson('$geom'),$uid) RETURNING p_id;";


        //echo($sql_reg);
        $output = array();
        $sql_reg_num = pg_query($sql_reg);

        $output['id'] = pg_fetch_all($sql_reg_num);


        $sql="SELECT device_id_prefix||last_object_count as device_id FROM public.device_id_tracker where object_name='demand_point' ";

        $result_query = pg_query($sql);
        if ($result_query) {
            $output['device_id'] = pg_fetch_all($result_query);
        }

        return json_encode($output);






//        if($sql_reg_num){
//            return "success";
//        }else{
//           return "failure";
//        }
    }





}

$json = new InsertData();
//$json->closeConnection();
echo $json->loadData();
?>


