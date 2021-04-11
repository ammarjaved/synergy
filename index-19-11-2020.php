<?php
session_start();
$loc = 'http://' . $_SERVER['HTTP_HOST'];
if (isset($_SESSION['logedin'])) {

} 
else {
    header("Location:" . $loc . "/syenergy/login/loginform.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aero</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"/>
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
	  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

	   <script src="https://unpkg.com/esri-leaflet@2.1.1/dist/esri-leaflet.js"></script>
<!-- leaflet library  end-->


        <!--shapefile modules-->


		<link rel="stylesheet" href="resources/draw/leaflet.draw.css"/>
    <script src="resources/draw/leaflet.draw-custom.js"></script>
    <script src="lib/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
    <script type="text/javascript" src="scripts/turf.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	
<link rel="stylesheet" href="css/main.css">

</head>
<!-- onload="setTimeout(function() { document.myForm.submit() }, 5000)" -->
<body onload="hidedragable()">

<!-- <nav class="cnav navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    	
    	<button  id="nl1" type="button" class="btn btn-s btn-default pull-left toggle-sidebar-left"><i class="fa fa-bars"></i></button>  &nbsp&nbsp
     <img class="d-none d-lg-block" id="logo" alt="Logo" src="imgs/logo.png" height="40">
         
    </div>


    <ul class="nav navbar-nav navbar-right">
    	<button id="nr1" type="button" class="btn btn-s btn-default pull-right toggle-sidebar-right"><i class="fa fa-bars"></i></button>
      <li><a href="services/logout.php"><span class="glyphicon glyphicon-log-out sp"></span class="sp"> Logout</a></li>
    </ul>
  </div>
</nav>
<hr> -->

<div class="container-fluid">
	<div class="row" id="row-main">

		<div class="col-md-2 sidebar" id="sidebar-left">
		
		<nobr><h4 style="margin-top: 17px; color:solid black; text-align:center; font-weight: bold; font-size:17px;">Demand Points 
			<span id="nl1" class="pull-right toggle-sidebar-left"><i class="glyphicon glyphicon-chevron-left sidegl"></i></span></h4></nobr>
			<hr>
			<button class="btn btn-primary block" onclick="getProperties('dp')">Demand Point Details </button>
            <div id="search-bar" class="row">
                <input type="text" style="margin-bottom: 8px;margin-left: 10px;padding: 6px;border: none;font-size: 15px;border-radius: 10px;box-shadow: 0 2px 5px #ff7c7c, 0 0 0;" id="search_did" name="search_did" placeholder="Serach Device id" class="typeahead1">
                <button  id="ser1" style="margin-bottom: 8px;margin-left: 10px;" onclick="search_did()" class="btn btn-success">Search</button>
            </div>
            <div id="search-bar" class="row">
                <input type="text" style="margin-bottom: 8px;margin-left: 10px;padding: 6px;border: none;font-size: 15px;border-radius: 10px;box-shadow: 0 2px 5px #ff7c7c, 0 0 0;" id="search_meter" name="search_meter" placeholder="Serach meter no" class="typeahead2">
                <button  id="ser1" style="margin-bottom: 8px;margin-left: 10px;" onclick="search_meter()" class="btn btn-success">Search</button>
            </div>
			<div style="max-height:500px; overflow-y: auto; overflow-x: auto;">
				<table class="table table-bordered table-hover table-striped table-responsive">
				<tbody>
						<form id="tblform" >
							
							<tr>
							<td>Status</td>
							<td ><input id="tdl1" class="tblinput" name="Status" ></input></td>
							</tr>

							<tr>
							<td>DBOper</td>
							<td ><input id="tdl2" class="tblinput" name="DBOper"></input></td>
							</tr>
					
						
							<tr>
							<td>Remarks</td>
							<td ><input id="tdl3" class="tblinput" name="Remarks"></input></td>
							</tr>
					
						
							<tr>
							<td>Device_ID</td>
							<td ><input id="tdl4" class="tblinput" name="Device_ID"></input></td>
							</tr>
					
						
							<tr>
							<td>House_No</td>
							<td ><input id="tdl5" class="tblinput" name="House_No"></input></td>
							</tr>
					
						
							<tr>
							<td>Name</td>
							<td ><input id="tdl6" class="tblinput" name="Name"></input></td>
							</tr>
					
						
							<tr>
							<td>Dist_Tranx</td>
							<td ><input id="tdl7" class="tblinput" name="Dist_Tranx"></input></td>
							</tr>


							<tr>
							<td>Meter_no</td>
							<td ><input id="tdl8" class="tblinput" name="Meter_no"></input></td>
							</tr>

							<tr>
							<td colspan="2"> <div id="mstatus"></div> </td>
							</tr>
							
							<input type="text" style="display:none;" id="uid" name="user_id" value="<?php echo $_SESSION['user_id'];?>">


							<input type="text" class="form-control" style="display:none;" id="dp_id" name="p_id" placeholder="Meter_no">
						</form>
					</tbody>
				</table>
				<button  id="tblbtn_update" class="btn btn-success pull-right" >Update</button>

			
                <button id="btn_del" style="display: none;" onclick="deleteMe('dp',2)"  class="btn btn-danger">Delete</button>
				
			</div>
		</div>

		<div class="col-md-8" id="content">
          
			<div id="draggable" class="ui-widget-content">
				<button id="cbtn" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<form id="myForm" action="services/update.php"  method="POST">
					<div class="form-group row">
					<div class="col-sm-12">
					<select class="form-control" id="Status" name="Status" placeholder="Status" required>
					<option value="Existing">Existing</option>
					<option value="Abandoned">Abandoned</option>
					<option value="Inactive">Inactive</option>
					<option value="Inactive">Inactive</option>
					<option value="Proposed">Proposed</option>
					<option value="Proposed Abandon">Proposed Abandon</option>
					<option value="Proposed Remove">Proposed Remove</option>
					<option value="Proposed Replace">Proposed Replace</option>
					<option value="Removed">Removed</option>
					<option value="Temporary">Temporary</option>
					</select>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					<!-- <input type="text" class="form-control" id="DBOper" name="DBOper" placeholder="DBOper" required> -->
					<select class="form-control" id="DBOper" name="DBOper" placeholder="Status" required>
					<option value="insert">insert</option>
					</select>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="meterno" name="Meter_no" placeholder="Meter_no" >
					<div id="mfstatus"></div>
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="House_No" name="House_No" placeholder="House No" >
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="Name" name="Name" placeholder="Street" >
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="Remarks" name="Remarks" placeholder="Remarks" >
					</div>
					</div>
					<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="Device_ID" name="Device_ID" placeholder="Device_ID" >
					</div>
					</div>

					<div class="form-group row">
					<div class="col-sm-12">
					<input type="text" class="form-control" id="Dist_Tranx" name="Dist_Tranx" placeholder="Dist_Tranx" >
					</div>
					</div>

					<div class="form-group" id="choose">
					<label class="col-md-6 control-label" for="filebutton">Meter_No Excel File</label>
					<div class="col-md-4">
					<input type="file" name="file" id="file" class="input-large">
					</div>
					</div>

					<input type="text" style="display:none;" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
					<input type="text" class="form-control" style="display:none;" id="dp_id" name="p_id" placeholder="Meter_no">
					<a id="w3s" href=""><button style="margin-top: 30px !important;" id="btnsave" class="btn btn-success pull-right">Save</button></a></a>
				</form>
				<button id="dbtndel" onclick="deleteMe('ab',1)"  class="btn btn-danger pull-left">Delete</button>
			</div> 
                       



           
			<div id="map">
			
				<!-- <div style="z-index: 1000000;position: absolute;padding-left: 1px;padding-top: 200px;"  >
						<div class="col-md-2">
						<button  id="nl1" type="button" class="btn btn-s btn-default pull-left toggle-sidebar-left"><i class="fa fa-bars"></i></button> 
						<span id="nl1" class="pull-left toggle-sidebar-left"><i class="glyphicon glyphicon-chevron-left sidegl"></i></span>
						</div>
				</div> -->
				<div style="z-index: 1000000;position: absolute;padding-left: 8px;padding-top: 200px;"  >
				
						
						<span id="nl2" class="pull-left toggle-sidebar-left"><i class="glyphicon glyphicon-chevron-left sidegl"></i></span>
						<!-- <a href="services/logout.php"><span class="glyphicon glyphicon-log-out sp"></span class="sp"> Logout</a> -->
						
							<!-- <button id="nr1" type="button" class="btn btn-s btn-default pull-right toggle-sidebar-right"><i class="fa fa-bars"></i></button> -->
						<span id="nr2" class="pull-left toggle-sidebar-right"><i class="glyphicon glyphicon-chevron-right sidegl"></i></span>	
				</div>	
				<!-- <div style="z-index: 1000000;position: absolute;padding-left: 1285px;padding-top: 25px;"  >
						<div class="col-md-2">
						<span id="nr3" class="pull-right toggle-sidebar-right"><i class="glyphicon glyphicon-chevron-right sidegl"></i></span>	
						</div>
				</div>	 -->
				<div style="z-index: 1000000;position: absolute;margin-left:75%; ; margin-top:10px;float: right;"   class="row">
						
							<img class="d-lg-none d-sm-block" id="logo2" alt="Logo" style="margin-top:7px; " src="imgs/logo.png" height="38">
						
				</div>
				


				
			</div>
		</div>

		<div class="col-md-2 sidebar" id="sidebar-right">
			<nobr><span id="nr1" class="pull-left toggle-sidebar-right "><i class="glyphicon glyphicon-chevron-right sidegr"></i></span>
			<h4 style="margin-top: 10px; text-align:center;font-weight: bold;  font-size:16px;">&nbsp Customer Details &nbsp
			<a href="services/logout.php"><span class="glyphicon glyphicon-log-out logg"></span></a></h4></nobr>
			<hr >
			<button class="btn btn-primary block" onclick="getProperties('customer')">Customer Details</button>
	
			<div id="search-bar" class="row">
			<input type="text" id="search" name="search" placeholder="Serach Meter_No..." class="typeahead">
                <button  id="ser" onclick="search()" class="btn btn-success">Search</button>
			</div>
            <div style="max-height:68%; overflow-y: scroll;">
				<table class="table table-bordered table-hover table-striped">
				<tbody>
												
							
												<tr>
												<td>Accl</td>
												<td id="tdr1"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Addr_no</td>
												<td id="tdr2"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Alt_port</td>
												<td id="tdr3"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Bclss</td>
												<td id="tdr4"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Bpartner</td>
												<td id="tdr5"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Busa</td>
												<td id="tdr6"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>City</td>
												<td id="tdr7"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>City_code</td>
												<td id="tdr8"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Connecti_1</td>
												<td id="tdr9"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Connection</td>
												<td id="tdr10"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Cont_accou</td>
												<td id="tdr11"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Ctracct_in</td>
												<td id="tdr12"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Dat</td>
												<td id="tdr13"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>District</td>
												<td id="tdr14"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>District_1</td>
												<td id="tdr15"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Dli</td>
												<td id="tdr16"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Dli_1</td>
												<td id="tdr17"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Dli_2</td>
												<td id="tdr18"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Equipment</td>
												<td id="tdr19"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>First_name</td>
												<td id="tdr20"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Functional</td>
												<td id="tdr21"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Gps_cordin</td>
												<td id="tdr22"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>House_no</td>
												<td id="tdr23"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Installa_1</td>
												<td id="tdr24"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Installat</td>
												<td id="tdr25"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Key</td>
												<td id="tdr26"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Last_name</td>
												<td id="tdr27"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Location</td>
												<td id="tdr28"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Logical_de</td>
												<td id="tdr29"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Mr_unit</td>
												<td id="tdr30"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Name_1</td>
												<td id="tdr31"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Name_1_1</td>
												<td id="tdr32"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Name_2</td>
												<td id="tdr33"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Name_2_1</td>
												<td id="tdr34"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Name_3</td>
												<td id="tdr35"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Name_4</td>
												<td id="tdr36"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Postl_code</td>
												<td id="tdr37"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Premise</td>
												<td id="tdr38"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Premtype</td>
												<td id="tdr39"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Project_id</td>
												<td id="tdr40"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Rate_cat</td>
												<td id="tdr41"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Regstgrp</td>
												<td id="tdr42"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Rg</td>
												<td id="tdr43"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Street</td>
												<td id="tdr44"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Street_cod</td>
												<td id="tdr45"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Suppleme_1</td>
												<td id="tdr46"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Supplement</td>
												<td id="tdr47"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Voltage_le</td>
												<td id="tdr48"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>X</td>
												<td id="tdr49"></td>
												</tr>
												
											
																	
												
												<tr>
												<td>Y</td>
												<td id="tdr50"></td>
												</tr>
												
											
																</tbody>
				</table>
			</div>

						
							
			
		</div>
	</div>
</div>


	
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="scripts/main.js"></script>
<script src="scripts/style.js"></script>
<script src="scripts/typeahead.min.js"></script>

</body>
</html>

<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('.typeahead').typeahead({
                name: 'hce',
                remote:'services/search.php?key=%QUERY',
                limit: 5
            });

        }, 3000);
        setTimeout(function(){
            $('.typeahead1').typeahead({
                name: 'hce1',
                remote:'services/search_did.php?key=%QUERY',
                limit: 5
            });

        }, 3000);

        setTimeout(function(){
            $('.typeahead2').typeahead({
                name: 'hce2',
                remote:'services/search_meter.php?key=%QUERY',
                limit: 5
            });

        }, 3000);


    });
    var searchlayer='null';
    function search(){
        var name=$('.typeahead').val();
        $.ajax({
            url: 'services/searchByName.php?name='+name,
            dataType: 'JSON',
            //data: data,
            method: 'GET',
            async: false,
            success: function callback(data) {
                if(searchlayer!='null'){
                    map.removeLayer(searchlayer);
                }
                // var geojson = Terraformer.WKT.parse(data[0].geometry);
                // //var data = JSON.parse(geojson);
                //
                // if (geojson.type == "Point") {
                //     pointLayers.push(L.geoJSON(geojson, {}));
                // }
                //
                // layer_group = L.layerGroup(pointLayers);
                var geom1=JSON.parse(data[0].geometry);
                searchlayer=map.addLayer(L.geoJson(geom1));
                map.setView(new L.LatLng(geom1.coordinates[0][1],geom1.coordinates[0][0]), 18);

                $("#tdr1").html(data[0].accl);
                $("#tdr2").html(data[0].addr_no);
                $("#tdr3").html(data[0].alt_port);
                $("#tdr4").html(data[0].bclss);
                $("#tdr5").html(data[0].bpartner);
                $("#tdr6").html(data[0].busa);
                $("#tdr7").html(data[0].city);
                $("#tdr8").html(data[0].city_code);
                $("#tdr9").html(data[0].connecti_1);
                $("#tdr10").html(data[0].connection);
                $("#tdr11").html(data[0].cont_accou);
                $("#tdr12").html(data[0].ctracct_in);
                $("#tdr13").html(data[0].dat);
                $("#tdr14").html(data[0].district);
                $("#tdr15").html(data[0].district_1);
                $("#tdr16").html(data[0].dli);
                $("#tdr17").html(data[0].dli_1);
                $("#tdr18").html(data[0].dli_2);
                $("#tdr19").html(data[0].equipment);
                $("#tdr20").html(data[0].firstname);
                $("#tdr21").html(data[0].functional);
                $("#tdr22").html(data[0].gps_cordin);
                $("#tdr23").html(data[0].house_no);
                $("#tdr24").html(data[0].installa_1);
                $("#tdr25").html(data[0].installat);
                $("#tdr26").html(data[0].key);
                $("#tdr27").html(data[0].lastname);
                $("#tdr28").html(data[0].location);
                $("#tdr29").html(data[0].logical_de);
                $("#tdr30").html(data[0].mr_unit);
                $("#tdr31").html(data[0].name_1);
                $("#tdr32").html(data[0].name_1_1);
                $("#tdr33").html(data[0].name_2);
                $("#tdr34").html(data[0].name_2_1);
                $("#tdr35").html(data[0].name_3);
                $("#tdr36").html(data[0].name_4);
                $("#tdr37").html(data[0].postl_code);
                $("#tdr38").html(data[0].premise);
                $("#tdr39").html(data[0].premtype);
                $("#tdr40").html(data[0].project_id);
                $("#tdr41").html(data[0].rate_cat);
                $("#tdr42").html(data[0].regstgrp);
                $("#tdr43").html(data[0].rg);
                $("#tdr44").html(data[0].street);
                $("#tdr45").html(data[0].street_cod);
                $("#tdr46").html(data[0].suppleme_1);
                $("#tdr47").html(data[0].supplement);
                $("#tdr48").html(data[0].voltage_le);
                $("#tdr49").html(data[0].x);
                $("#tdr50").html(data[0].y);







            }
        });

    }


    var searchlayer1='null';
    function search_did(){
        var name=$('#search_did').val();
        $.ajax({
            url: 'services/searchByDid.php?name='+name,
            dataType: 'JSON',
            //data: data,
            method: 'GET',
            async: false,
            success: function callback(data) {
                if(searchlayer1!='null'){
                    map.removeLayer(searchlayer1);
                }
                // var geojson = Terraformer.WKT.parse(data[0].geometry);
                // //var data = JSON.parse(geojson);
                //
                // if (geojson.type == "Point") {
                //     pointLayers.push(L.geoJSON(geojson, {}));
                // }
                //
                // layer_group = L.layerGroup(pointLayers);
                var geom1=JSON.parse(data[0].geometry);
                searchlayer1=map.addLayer(L.geoJson(geom1));
                map.setView(new L.LatLng(geom1.coordinates[1],geom1.coordinates[0]), 18);

                $('#tdl1').val(data[0].status);
                $('#tdl2').val(data[0].db_oper);
                $('#tdl3').val(data[0].remarks);
                $('#tdl4').val(data[0].device_id);
                $('#tdl5').val(data[0].house_no);
                $('#tdl6').val(data[0].str_name);
                $('#tdl7').val(data[0].dist_tranx);
                $('#tdl8').val(data[0].meter_no);

                $("#btn_del").show()
                p_id=data[0].device_id;







            }
        });

    }

    var searchlayer2='null';
    function search_meter(){
        var name=$('#search_meter').val();
        $.ajax({
            url: 'services/searchByMeter.php?name='+name,
            dataType: 'JSON',
            //data: data,
            method: 'GET',
            async: false,
            success: function callback(data) {
                if(searchlayer2!='null'){
                    map.removeLayer(searchlayer2);
                }
                // var geojson = Terraformer.WKT.parse(data[0].geometry);
                // //var data = JSON.parse(geojson);
                //
                // if (geojson.type == "Point") {
                //     pointLayers.push(L.geoJSON(geojson, {}));
                // }
                //
                // layer_group = L.layerGroup(pointLayers);
                var geom1=JSON.parse(data[0].geometry);
                searchlayer1=map.addLayer(L.geoJson(geom1));
                map.setView(new L.LatLng(geom1.coordinates[1],geom1.coordinates[0]), 18);

                $('#tdl1').val(data[0].status);
                $('#tdl2').val(data[0].db_oper);
                $('#tdl3').val(data[0].remarks);
                $('#tdl4').val(data[0].device_id);
                $('#tdl5').val(data[0].house_no);
                $('#tdl6').val(data[0].str_name);
                $('#tdl7').val(data[0].dist_tranx);
                $('#tdl8').val(data[0].meter_no);

                $("#btn_del").show()
                p_id=data[0].device_id;







            }
        });

    }


</script>