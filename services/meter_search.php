<?php


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


        $mtno=$_REQUEST['mtno'];
        // $mtno=6;

        $sql1="SELECT house_no,street FROM ".'"'."Bangi_East_Customer".'"'." where equipment = '$mtno' ";
        // echo($sql1);

        $result_query = pg_query($sql1);
        if ($result_query) {
            $output = pg_fetch_all($result_query);
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