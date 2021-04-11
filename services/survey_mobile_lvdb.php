<?php
session_start();
include("connection.php");
class Divisions extends connection
{
    function __construct()
    {
        $this->connectionDB();

    }
    public function loadData()
    {

       

        $sql = "select row_to_json(t) as all_data from(SELECT device_id, substation, comments, type, 
				status, db_oper, lv_db_loc, lv_db_loc_other, design,
				design_other, remarks, lvdb_angle, current_loc_geom, 
				marker_geom, marker_lat_lng, current_loc_lat_lng, 
				surveyor_user_id, db_date_time, image_path_1, image_path_2,
				image_path_3, image_path_4, image_path_5, image_path_6, is_lvs_1, 
				lvs_1_switch_status, lvs_1_feeder_direction, lvs_1_label, 
				lvs_1_label_other, is_lvs_2, lvs_2_switch_status,
				lvs_2_feeder_direction, lvs_2_label, lvs_2_label_other,
				is_lvf_1, lvf_1_switch_status, lvf_1_feeder_direction, 
				lvf_1_label, lvf_1_label_other, is_lvf_2, lvf_2_switch_status,
				lvf_2_feeder_direction, lvf_2_label, lvf_2_label_other, is_lvf_3, 
				lvf_3_switch_status, lvf_3_feeder_direction, lvf_3_label, 
				lvf_3_label_other, is_lvf_4, lvf_4_switch_status, 
				lvf_4_feeder_direction, lvf_4_label,
				lvf_4_label_other, is_lvf_5, lvf_5_switch_status,
				lvf_5_feeder_direction, lvf_5_label, lvf_5_label_other, 
				is_lvf_6, lvf_6_switch_status, lvf_6_feeder_direction, lvf_6_label, 
				lvf_6_label_other, is_lvf_7, lvf_7_switch_status, lvf_7_feeder_direction, 
				lvf_7_label, lvf_7_label_other, is_lvf_8, lvf_8_switch_status,
				lvf_8_feeder_direction, lvf_8_label, lvf_8_label_other, is_lvf_9,
				lvf_9_switch_status, lvf_9_feeder_direction, lvf_9_label,
				lvf_9_label_other, is_lvf_10, lvf_10_switch_status,
				lvf_10_feeder_direction, lvf_10_label, lvf_10_label_other
					FROM public.tbl_survey_data_lvdb_fp_details)t;";

        $output = array();

        $result_query = pg_query($sql);
        if($result_query)
        {
           $output = pg_fetch_all($result_query);
               
        }

        $this->closeConnection();
        return json_encode($output);
    }

}

$json = new Divisions();
echo $json->loadData();
?>