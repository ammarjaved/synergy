<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("connection.php");


class Pss extends connection
{
    function __construct()
    {
        $this->connectionDB();

    }

    public function loadData()
    {

        $output = array();


        $pt=$_REQUEST['pt'];
        $line=$_REQUEST['line'];

        $sql3="with foo as ( select st_geomfromgeojson('$line') as geom)
        select st_asgeojson(ST_ClosestPoint(ST_AddPoint(foo.geom,ST_StartPoint(foo.geom)),st_geomfromgeojson('$pt'))) from foo";


        $result_query3 = pg_query($sql3);
        if ($result_query3) {
            $output = pg_fetch_all($result_query3);
        }


        $this->closeConnection();
        // echo $output;
        return json_encode($output);
    }
}

$json = new Pss();
//$json->closeConnection();
echo $json->loadData();


?>