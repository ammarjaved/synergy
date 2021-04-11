
var map;
var drawnItems
var baseLayers;
var dp;
var dp2;
var customer;
var p_id='';
var line_feature='null';


function hidedragable() {
    $("#draggable").hide();
  }

$(document).ready(function() {
    $( "#draggable" ).draggable();
    
    $("#cbtn").click(function(){
        $("#draggable").hide();
        $("#myForm").trigger("reset");
        $("#mfstatus").hide();
      });

  // meter_no Search
  $("#meterno").on("keyup",function(){

    var search_mno = $("#meterno").val();

      var hno;
      var stno;
      $.ajax({
          url: "services/meter_search.php?mtno=" +search_mno,
          type: "GET",
          dataType: "json",
          contentType: "application/json; charset=utf-8",
          success: function callback(response) {
              for(var i=0;i<response.length;i++){
                  hno = response[i].house_no;
              stno = response[i].street;

              $("#meterno").on('change', function(){
                  $("#House_No").trigger("reset");
                  $("#Name").trigger("reset");
                  $('#House_No').val(hno); 
                  $('#Name').val(stno); 
              });
                  
              }
              // setTimeout(function(){ 
              // $('#House_No').val(hno); 
              // $('#Name').val(stno); 
              // var m = $('#meterno').val();
              // console.log(m)
              // }, 3000);
          }
      });
  });



  $("#meterno").on('change', function(){
      var in_mno = $(this).val().trim();
      if(in_mno != ''){

         $.ajax({
            url: 'services/meter_search1.php',
            type: 'post',
            data: {Meter_no: in_mno},
            success: function(response){
              $('#mfstatus').show();
                $('#mfstatus').html(response);
              $("#meterno").on('change', function(){
                  $("#mfstatus").hide();
              });
             
              
             }
          });
      }else{
          $('#mfstatus').show();
         $("#mfstatus").html("");
         $("#meterno").on('change', function(){
          $("#mfstatus").hide();
        
      });
      }
  });



  // var tdl8 = $("#tdl8").val();
  // $("#tdl8").keyup(function() {
  //     validateInputs();
  // });

  // function validateInputs(){
  //     var disableButton = false;
  //     var val1 = $("#tdl8").val();
  //     if(val1.length == 0)
  //         disableButton = true;
  //     $('#tblbtn_update').attr('disabled', disableButton);
  // }

  
  $("#tblbtn_update").on("click", function(){
      var tdl1 = $("#tdl1").val();
      var tdl2 = $("#tdl2").val();
      var tdl3 = $("#tdl3").val();
      var tdl4 = $("#tdl4").val();
      var tdl5 = $("#tdl5").val();
      var tdl6 = $("#tdl6").val();
      var tdl7 = $("#tdl7").val();
      var tdl8 = $("#tdl8").val();
      var uid = $("#uid").val();
      var dp_id = $("#dp_id").val();
	  
	  if(tdl4==""){
		  alert("sorry there is nothing to update");
	  }else if(tdl8==""){
		  alert("please enter meter no");
	  }else if(tdl8.length<4){
		 alert("please enter correct meter no"); 
	  }else{

      $.ajax({
        url: "services/dpupdate.php",
        type : "POST",
        data : {Status: tdl1, DBOper: tdl2, Remarks: tdl3, Device_ID: tdl4, House_No: tdl5, Name: tdl6, Dist_Tranx: tdl7, Meter_no: tdl8, p_id: dp_id, user_id: uid},
        success: function(data) {
          if(data == 1){
              addDemandPointJson();
			  Swal.fire({
		  title: 'Updated Successfully...',
		  icon: 'success'
		 
		})
            
            $("#mstatus").hide();
            $("#tblform").trigger("reset");
          //  location.reload();

          }else if(data==0){
              alert("There is some issue please try again")
          }else{
              alert(data);
          }
        }
      })
  }
    });

  $("#tdl8").keyup(function(){
      var in_mno = $(this).val().trim();
      if(in_mno != ''){

         $.ajax({
            url: 'services/meter_search1.php',
            type: 'post',
            data: {Meter_no: in_mno},
            success: function(response){
                $('#mstatus').html(response);
             }
          });
      }else{
         $("#mstatus").html("");
      }

  });


 

    
       
    setTimeout(function(){
        map = L.map('map').setView([3.016603, 101.858382], 11);
		document.getElementById('map').style.cursor = 'pointer'

        var st=L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
            //.addTo(map);
        var st1=L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);


        var boundary = L.tileLayer.wms("http://121.121.232.53:7090/geoserver/TNB/wms", {
            layers: 'TNB:boundary_bangi_east',
            format: 'image/png',
            maxZoom: 20,
            transparent: true
        });
        boundary.addTo(map);

        var boundary_5 = L.tileLayer.wms("http://121.121.232.53:7090/geoserver/TNB/wms", {
            layers: 'TNB:5x5_sub_grid_bangi_east',
            format: 'image/png',
            maxZoom: 20,
            transparent: true
        });
        boundary_5.addTo(map);
		
		var boundary_2 = L.tileLayer.wms("http://121.121.232.53:7090/geoserver/TNB/wms", {
            layers: 'TNB:2x5_subgrid',
            format: 'image/png',
            maxZoom: 20,
            transparent: true
        });

         customer = L.tileLayer.wms("http://121.121.232.53:7090/geoserver/TNB/wms", {
            layers: 'TNB:bangi_customer',
            format: 'image/png',
             maxZoom: 20,
            transparent: true
        }, {buffer: 10});
        customer.addTo(map);

         dp = L.tileLayer.wms("http://121.121.232.53:7090/geoserver/TNB/wms", {
            layers: 'TNB:demand_point_without_meter_number',
            format: 'image/png',
             maxZoom: 20,
            transparent: true
        });
        dp.addTo(map);
        dp2 = L.tileLayer.wms("http://121.121.232.53:7090/geoserver/TNB/wms", {
            layers: 'TNB:demand_point_with_meter_number',
            format: 'image/png',
            maxZoom: 20,
            transparent: true
        });
        dp2.addTo(map);
        addDemandPointJson();

          var drawnItems = new L.FeatureGroup();
         map.addLayer(drawnItems);
         var drawControl = new L.Control.Draw({
          draw :{
              circle:false,
            marker: true,
            polygon:false,
            polyline:true,
            rectangle:false
          },
             edit: {
                 featureGroup: drawnItems
             }
         });
         
         map.addControl(drawControl);
         $(".leaflet-draw-draw-circlemarker").hide();

         
        map.on('draw:created', function (e) {

                var type = e.layerType;
               if(type!='polyline') {
                layer = e.layer;
                console.log(type);
                console.log(layer.toGeoJSON());
                //if (type === 'marker') {
                //  layer.bindPopup('A popup!');
                //}
                var geom1 = layer.toGeoJSON();
               // var pt = turf.point([geom1.geometry.coordinates[1], geom1.geometry.coordinates[0]]);
               // var line=turf.lineString(line_feature.coordinates)

                 //  var snapped = turf.nearestPointOnLine(line, pt, {units: 'miles'});
                   //console.log(snapped);
                   if(line_feature!="null") {
                       $.ajax({
                           url: 'services/snap.php?pt=' + JSON.stringify(geom1.geometry) + '&line=' + JSON.stringify(line_feature),
                           type: 'GET',
                           success: function (response) {
                               var geom2 = JSON.parse(response[0].st_asgeojson)
                               var geojsonMarkerOptions = {
                                   radius: 6,
                                   fillColor: "#E00883",
                                   color: "#00000",
                                   weight: 1,
                                   opacity: 1,
                                   fillOpacity: 0.8
                               };
                               L.geoJSON(geom2, {
                                   pointToLayer: function (feature, latlng) {
                                       return L.circleMarker(latlng, geojsonMarkerOptions);
                                   }
                               })
                                   //.addTo(map);
                               $.ajax({
                                   url: 'services/insert.php?geom=' + JSON.stringify(geom2)+'&uid='+user_id,
                                   type: 'POST',
                                   success: function (response) {
                                       $("#draggable").show();
                                       setTimeout(function () {
                                           var res = JSON.parse(response)
                                           $("#Device_ID").val(res.device_id[0].device_id)
                                           $("#dp_id").val(res.id[0].p_id);
                                       }, 500)
                                       addDemandPointJson();

                                       $("#cbtn").click(function(){
                                        $("#draggable").hide();
                                        $("#myForm").trigger("reset");
                                      });

                                   }

                               });

                               // });
                               var options = {
                                   success: showResponse  // post-submit callback
                               };
                               $('#myForm').ajaxForm(options);
                           }

                       });
                   }else{
                       $.ajax({
                           url: 'services/insert.php?geom=' + JSON.stringify(geom1.geometry)+'&uid='+user_id,
                           type: 'POST',
                           success: function (response) {
                               $("#draggable").show();
                               map.removeLayer(dp)
                               setTimeout(function () {
                                   var res = JSON.parse(response)
                                   $("#Device_ID").val(res.device_id[0].device_id)
                                   $("#dp_id").val(res.id[0].p_id);
                                  // map.addLayer(dp)
                                   addDemandPointJson();
                                   // var geojsonMarkerOptions = {
                                   //     radius: 6,
                                   //     fillColor: "#E00883",
                                   //     color: "#00000",
                                   //     weight: 1,
                                   //     opacity: 1,
                                   //     fillOpacity: 0.8
                                   // };
                                   // L.geoJSON(geom1, {
                                   //     pointToLayer: function (feature, latlng) {
                                   //         return L.circleMarker(latlng, geojsonMarkerOptions);
                                   //     }
                                   // }).addTo(map);
                                   // setTimeout(function(){
                                   //     map.setView(new L.LatLng(geom1.geometry.coordinates[1], geom1.geometry.coordinates[0]), 14);
                                   // },1000)

                               }, 500)

                               $("#cbtn").click(function(){
                                $("#draggable").hide();
                                $("#myForm").trigger("reset");
                              });

                           }

                       });

                       // });
                       var options = {
                           success: showResponse  // post-submit callback
                       };
                       $('#myForm').ajaxForm(options);
                   }




                // drawgeom = Terraformer.WKT.convert(geom1.geometry);
              //  drawnItems.addLayer(layer);
                //  $("#geom").val(JSON.stringify(geom1.geometry))
                //$("#btnSave").click(function(){

            }else{
                   var layer = e.layer;
                   drawnItems.addLayer(layer);
                   console.log(type);
                 var json_line= layer.toGeoJSON();
                 line_feature=json_line.geometry;
                 console.log(line_feature);
               }

        });

        function showResponse(responseText, statusText, xhr, $form)  {
            if(responseText=='Meter already exist'){
                alert('Meter already exist')
            }else {
                Swal.fire({
                    title: 'Updated Successfully...',
                    icon: 'success'

                })
                $("#draggable").hide();
                addDemandPointJson();
                $("#myForm").trigger("reset");
                //location.reload();
                map.invalidateSize();
            }
        }
        baseLayers = {
            "Street": st,
            "Satellite": st1
        };
        var groupedOverlays = {
            "POI": {
                    "Bangi Boundary": boundary,
                    " Grid 5x5":boundary_5,
					"Grid 2x5":boundary_2,
                    "Bangi Customer":customer,
                    "Meter Not Exist":dp,
                    "Meter Exist":dp2
            }
        };

        var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
            collapsed: true,
            position: 'topright'
            // groupCheckboxes: true
        }).addTo(map);




    },1000)

    



  
  




});


var cldp=null;
function getProperties(layer){
    var layer_name;

    if(cldp!=null) {
        map.removeLayer(cldp)
    }

    $("#btn_del").hide();
    if(layer=='customer'){
        layer_name=customer;
    }else if(layer=='dp2'){
        layer_name=dp2;
    } else{

        layer_name=dp;
    }

    map.on('click', function(e) {
        map.off('click');

        // Build the URL for a GetFeatureInfo
        var url = getFeatureInfoUrl(
            map,
            layer_name,
            e.latlng,
            {
                'info_format': 'application/json',
                'propertyName': 'NAME,AREA_CODE,DESCRIPTIO'
            }
        );
        $.ajax({
            url: 'services/proxy.php?url='+encodeURIComponent(url),
            dataType: 'JSON',
            //data: data,
            method: 'GET',
            async: false,
            success: function callback(data) {

                //  alert(data)
                if(data.features.length==0){
                    alert("please try again");
                }else {
                    if(layer=='customer'){
                         // tdtomer table
                        $("#tdr1").html(data.features[0].properties.assb_name);
                        $("#tdr2").html(data.features[0].properties.connection);
                        $("#tdr3").html(data.features[0].properties.assb_house_no);
                        $("#tdr4").html(data.features[0].properties.street);
                        $("#tdr5").html(data.features[0].properties.assb_address);
                        $("#tdr6").html(data.features[0].properties.equipment);
                        $("#tdr7").html(data.features[0].properties.mr_unit);
                        $("#tdr8").html(data.features[0].properties.premise);
                        $("#tdr9").html(data.features[0].properties.addr_no);
                        $("#tdr10").html(data.features[0].properties.assb_street);
                        $("#tdr11").html(data.features[0].properties.grid5);
                        $("#tdr12").html(data.features[0].properties.grid10);
                        $("#tdr13").html(data.features[0].properties.payment_gr);
                        $("#tdr14").html(data.features[0].properties.device_id);
                        $("#tdr15").html(data.features[0].properties.customer_level);
                        $("#tdr16").html(data.features[0].properties.X);
                        $("#tdr17").html(data.features[0].properties.Y);
                      
                        cldp=L.geoJson({ "type": "Point", "coordinates": [data.features[0].properties.X, data.features[0].properties.Y] }).addTo(map);

                    }
                
                    else{
                           
                        // demand points table
                        $('#tdl1').val(data.features[0].properties.status); 
                        $('#tdl2').val(data.features[0].properties.db_oper); 
                        $('#tdl3').val(data.features[0].properties.remarks); 
                        $('#tdl4').val(data.features[0].properties.device_id); 
                        $('#tdl5').val(data.features[0].properties.house_no); 
                        $('#tdl6').val(data.features[0].properties.str_name); 
                        $('#tdl7').val(data.features[0].properties.dist_tranx); 
                        $('#tdl8').val(data.features[0].properties.meter_no);
                        cldp=L.geoJson({ "type": "Point", "coordinates": [data.features[0].geometry.coordinates[0], data.features[0].geometry.coordinates[1]] }).addTo(map);


                        $("#btn_del").show()
                        p_id=data.features[0].properties.device_id;
                    }
                    // console.log(data)

                }

            }
        });




    });
}


function getFeatureInfoUrl(map, layer, latlng, params) {

    var point = map.latLngToContainerPoint(latlng, map.getZoom()),
        size = map.getSize(),

        params = {
            request: 'GetFeatureInfo',
            service: 'WMS',
            srs: 'EPSG:4326',
            styles: layer.wmsParams.styles,
            transparent: layer.wmsParams.transparent,
            version: layer._wmsVersion,
            format:layer.wmsParams.format,
            bbox: map.getBounds().toBBoxString(),
            height: size.y,
             width: size.x,
            layers: layer.wmsParams.layers,
            query_layers: layer.wmsParams.layers,
            info_format: 'application/json'
        };

    params[params.version === '1.3.0' ? 'i' : 'x'] = parseInt(point.x);
    params[params.version === '1.3.0' ? 'j' : 'y'] = parseInt(point.y);

    // return this._url + L.Util.getParamString(params, this._url, true);

    var url = layer._url + L.Util.getParamString(params, layer._url, true);
    if(typeof layer.wmsParams.proxy !== "undefined") {


        // check if proxyParamName is defined (instead, use default value)
        if(typeof layer.wmsParams.proxyParamName !== "undefined")
            layer.wmsParams.proxyParamName = 'url';

        // build proxy (es: "proxy.php?url=" )
        _proxy = layer.wmsParams.proxy + '?' + layer.wmsParams.proxyParamName + '=';

        url = _proxy + encodeURIComponent(url);

    }

    return url.toString();

}

function deleteMe(lyr,dp1){
    var pid=''
    if(lyr=='dp'){
       pid=p_id
    }else {
         pid = $("#dp_id").val();
    }
    $.ajax({
        url:'services/delete.php?p_id='+pid+'&dp='+dp1,
        type:'POST',
        success:function(response){
            $("#draggable").show();
           // map.removeLayer(dp)


             alert(response);
           // map.addLayer(dp)
           //  if(cldp!=null) {
           //      map.removeLayer(cldp)
           //  }
            addDemandPointJson();
            $("#draggable").hide();
						$("#tdl1").html('');
                        $("#tdl2").html('');
                        $("#tdl3").html('');
                        $("#tdl4").html('');
                        $("#tdl5").html('');
                        $("#tdl6").html('');
                        $("#tdl7").html('');
                        $("#tdl9").html('');
                        $("#btn_del").hide()
						//location.reload();
			 

        }
    });

     
}

//var catbLayer = L.geoJson(null);
var dpj=null;
function addDemandPointJson() {
    if(dpj!=null){
        map.removeLayer(dpj);
    }
     dpj = L.geoJson(null, {
        pointToLayer: function (feature, latlng) {
            return L.circleMarker(latlng, {
                radius: 5,
                fillColor: '#AB0501',
                fillOpacity: 1,
                color: '#AB0501',
                weight: 1
                ,
                title: '',
                riseOnHover: true
            });
        },
        onEachFeature: function (feature, layer) {
            if (feature.properties) {
                layer.on({
                    click: function (e) {
                        // $("#feature-title").html(feature.properties.Id);
                        $('#tdl1').val(feature.properties.status);
                        $('#tdl2').val(feature.properties.db_oper);
                        $('#tdl3').val(feature.properties.remarks);
                        $('#tdl4').val(feature.properties.device_id);
                        $('#tdl5').val(feature.properties.house_no);
                        $('#tdl6').val(feature.properties.str_name);
                        $('#tdl7').val(feature.properties.dist_tranx);
                        $('#tdl8').val(feature.properties.meter_no);
                        $("#btn_del").show()
                        p_id=feature.properties.device_id;
                        // highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], highlightStyle));
                    }
                });
            }
        }
    });
    $.getJSON("services/demand_point.php?uid="+user_id, function (data) {
        dpj.addData(JSON.parse(data[0].json_build_object));
        map.addLayer(dpj);

    });
}
