<html>
<body>
<style>
article
{
    width:255px;
    height:226px;
    border-left: 1px solid gray;
    padding: 14em;
    margin: 0px;
    overflow: hidden;
    background-color: #d5d5d2;
    float: left;
}
</style>
<article id="map">krishna</article>
<script type="text/javascript">

function initialize()
{

  var directionsDisplay;
  var directionsService;
  var directionsService = new google.maps.DirectionsService();
  directionsDisplay = new google.maps.DirectionsRenderer();
  var map;
  var pos=new google.maps.LatLng(20.5937,78.9629);
  var elemId=document.getElementById("map");
  var prop= {center:pos,zoom:5};
  map=new google.maps.Map(elemId,prop);
  directionsDisplay.setMap(map);
  calcRoute(directionsDisplay,directionsService);
}

function calcRoute(directionsDisplay,directionsService) {
  var array=sessionStorage.getItem("tsp_place");
  var tsp_p=JSON.parse(array);
  var bound=sessionStorage.getItem("tsp_bound");
  var tsp_b=JSON.parse(bound);
//  alert("tsp_p"+tsp_p[0]);
  var start =tsp_b[0];
  var end = tsp_b[1];
  waypts=[];
  for (var i = 0; i < tsp_p.length; i++)
   {
      waypts.push({location:tsp_p[i],stopover:true});
   }
  //var tlength=tsp_p.length;
//  alert("tlength"+tlength);

  var request = {
    origin: start,
    destination:end,
//  if(tlength!=0)
//    {
   waypoints:waypts,
  //  }
    travelMode: 'DRIVING'
  };
  directionsService.route(request, function(result, status) {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    }
  });
}

</script>
<script
   src="enter your api key">
 
   </script>
</body>
</html>

