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
<article id="print">krishna</article>
<script>
var array=sessionStorage.getItem("finalPlace");
var final=JSON.parse(array);
var n,cost=0,fcity=0,nop,completed;
var tsp_place=[];
var tsp_display=[];
function dis()
{
//var origin1 = 'chennai';
//var origin2 = 'coimbatore';
//var destinationA = 'bangalore';
//var destinationB = 'erode';

var service = new google.maps.DistanceMatrixService();
service.getDistanceMatrix(
  {
    origins: final,
    destinations: final,
    travelMode: 'DRIVING',
    //transitOptions: TransitOptions,
    //drivingOptions: DrivingOptions,
  //  unitSystem: UnitSystem,
    //avoidHighways: Boolean,
    //avoidTolls: Boolean,
  }, callback);
}
function callback(response, status) {
  if (status == 'OK') {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;
    //var tsp=[[]];

    nop=origins.length;
    var tsp=new Array(nop);
    for(var q=0;q<nop;q++)
    {
      tsp[q]=new Array(nop);
    }
    for (var i = 0; i < origins.length; i++)
    {
      var results = response.rows[i].elements;
      for (var j = 0; j < results.length; j++)
      {
        var element = results[j];

          var distance = element.distance.value;
          distance=distance/1000;
          //alert("distance"+distance);
          var duration = element.duration.text;
          var from = origins[i];
          var to = destinations[j];
          if(i==j)
          {
        tsp[i][j]={pstart:from,pend:to,pdistance:distance,tduration:duration};
          }
          else
          {
        tsp[i][j]={pstart:from,pend:to,pdistance:distance,tduration:duration};
          }
        //  var tsp=[[]];
          //tsp[i][j].pstart=from;
          //tsp[i][j].pend=to;
          //tsp[i][j].pdistance=distance;
          //tsp[i][j].pduration=duration;
          if(origins[i]!=destinations[j])
          {
      //    alert(from+to+distance+duration);
          }
      }
    }
    for(var z=0;z<nop;z++)
    {
      for(var x=0;x<nop;x++)
      {
      //  if(tsp[z][x].pdistance>50)
          {
      //      alert("TSPTSP="+tsp[z][x].pdistance);
          }
      }
    }
  }
      tspstart(tsp);
}

function tspstart(tsp)
{
  completed=new Array(nop);
  for(var i=0;i<nop;i++)
  {
    completed[i]=0;
  }
  tsp_place.push(tsp[0][0].pstart);

  mincost(0,tsp);
}

function least(c,tsp)
{
    var i,nc=999;
    var min=999,kmin;

    for(i=0;i < nop;i++)
    {
        if((tsp[c][i].pdistance!=0)&&(completed[i]==0))
            if(tsp[i][c].pdistance < min)
            {
                min=tsp[c][i].pdistance;
                kmin=tsp[c][i].pdistance;
                nc=i;
            }
    }

    if(min!=999)
        cost+=kmin;

    return nc;
}




function mincost(city,tsp)
{
    var i,ncity;

    completed[city]=1;

    //cout<<city+1<<"--->";
    //alert(city+1);
    ncity=least(city,tsp);
    //alert("fcity"+fcity+"ncity"+ncity);
    if(ncity==999)
    {
        ncity=0;

          for(var i=0;i<tsp_display.length;i++)
          {
              document.getElementById('print').innerHTML+=tsp_display[i].pstart;
          }
          alert("totol cost="+cost);
          var tlength=tsp_place.length;
          var tsp_bound=[];
          tsp_bound.push(tsp_place[0]);
          tsp_bound.push(tsp_place[tlength-1]);
          tsp_place.splice(0,1);

          tsp_place.splice(tlength-2,1);
          var tlength=tsp_place.length;
          alert("tlength"+tlength);

          sessionStorage.setItem("tsp_place",JSON.stringify(tsp_place));
          sessionStorage.setItem("tsp_bound",JSON.stringify(tsp_bound));

          location.href="direction.php"

        return;
    }
    //alert(tsp[fcity][ncity].pstart+" ----> "+tsp[fcity][ncity].pend);
    tsp_display.push({pstart:tsp[fcity][ncity].pstart,
                      pend:tsp[fcity][ncity].pend,
                      pdistance:tsp[fcity][ncity].distance});
    tsp_place.push(tsp[fcity][ncity].pend);
    fcity=ncity;
    mincost(ncity,tsp);
}




</script>
<script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBk2OqwVasGapJ8MZQ0uLBkkpdaXRmC7q8&callback=dis">

   </script>
</body>
</html>

