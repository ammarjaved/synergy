<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("connection.php");


class Pss extends connection
{


    function __construct()
    {
        $this->connectionDB();

        $result = $this->get_data();
        echo json_encode($result);



    }

    public function get_data()
    {
        $output = array();
        $uid=$_REQUEST['uid'];



//        $sql1="SELECT jsonb_build_object(
//    'type',     'FeatureCollection',
//    'features', jsonb_agg(features.feature)
//)
//FROM (
//  SELECT jsonb_build_object(
//    'type',       'Feature',
//    'id',         gid,
//    'geometry',   ST_AsGeoJSON(geom)::jsonb,
//    'properties', to_jsonb(inputs) - 'gid' - 'geom'
//  ) AS feature
//  FROM
//(with foo as (select  survey_data->>'lat' as lat,survey_data->>'lng' as lng from  tbl_survey_data_raw)
//select pk_id as gid,image_path,survey_data->>'scheme_name' as scheme_name,survey_data->>'address' as address,
//survey_data->>'house_no' as house_no,survey_data->>'plot_size' as plot_size,
//survey_data->>'landuse' as landuse,survey_data->>'house_progress' as house_progress,
//survey_data->>'remarks' as remarks,ST_GeomFromText('POINT('||b.lng||' '||b.lat||')',4326) as geom
//from tbl_survey_data_raw a,(select * from foo) as b) inputs) as features;";

        $sql1="SELECT json_build_object(
    'type', 'FeatureCollection',
    'crs',  json_build_object(
        'type',      'name', 
        'properties', json_build_object(
            'name', 'EPSG:4326'  
        )
    ), 
    'features', json_agg(
        json_build_object(
            'type',       'Feature',
            'id',         p_id, -- the GeoJson spec includes an 'id' field, but it is optional, replace {id} with your id field
            'geometry',   ST_AsGeoJSON(geom)::json,
            'properties', json_build_object(
               'p_id', meter_no,
				'status', status,
				'db_oper', db_oper,
				'remarks', remarks,
				'device_id',device_id ,
				'house_no',house_no,
				'str_name', str_name,
				'dist_tranx', dist_tranx,
				'meter_no', meter_no,
				'comment', comment
            )
        )
    )
)
FROM (select * from demand_point where user_id=$uid) as tbl1";

        $result_query1 = pg_query($sql1);
        if ($result_query1) {
            $output= pg_fetch_all($result_query1);
        }




        $this->closeConnection();
        return $output;
    }

}

$json = new Pss();
//$json->closeConnection();
// echo $json->loadData();


?>