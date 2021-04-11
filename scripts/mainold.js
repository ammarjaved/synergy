
var map;
var drawnItems


$(document).ready(function() {
       
    setTimeout(function(){
        map = L.map('map').setView([31.615965, 72.38554], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            
          var drawnItems = new L.FeatureGroup();
         map.addLayer(drawnItems);
         var drawControl = new L.Control.Draw({
          draw :{
            circle:false,
            marker: true,
            polygon:false,
            polyline:false,
            rectangle:false
          },
             edit: {
                 featureGroup: drawnItems
             }
         });
         
         map.addControl(drawControl);


map.on('draw:created', function (e) {
    var type = e.layerType,
      layer = e.layer;
      console.log(type);
       console.log(layer.toGeoJSON());


    //if (type === 'marker') {
    //  layer.bindPopup('A popup!');
    //}
       var geom1=layer.toGeoJSON();
       // drawgeom = Terraformer.WKT.convert(geom1.geometry);
       drawnItems.addLayer(layer);

      $("#dlgAttraction").show();
      // $("#latitude").val(e.latlng.lat.toFixed(5));
      // $("#longitude").val(e.latlng.lng.toFixed(5));

      $(".btnCancel").click(function(){
        $("#dlgAttraction").hide();
      });

      

  });


    },3000)


               //   $("#btnSave").click(function(){
               //      $.ajax({
               //         url:'insert.php',
               //         type:'POST',
               //         data:{
               //             image:$("#img").val(),
               //             textarea:$("#textarea").val(),
               //         },
               //         success:function(response){
               //             alert(response);
               //             $("#dlgAttraction").hide();
               //         }
               //     });
               //  });

});





    
