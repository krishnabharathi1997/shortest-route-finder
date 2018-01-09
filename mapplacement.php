<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

nav
{
    float: left;
    max-width: 130px;
    margin: 0px;
    padding: 11em;
    background-color: #ebc4f3;
    margin-bottom: 45px;
    max-height: 30px;
}
model
{
    width: 483px;
    height: 289px;
    /* margin: 0px; */
    margin-top: 385px;
    margin-left: -481px;
    margin-bottom: 1px;
    margin-right: -1px;
    padding: 0em;
    /* overflow: hidden; */
    background-color:#cce4c6;
    float: left;
}
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
</head>
<body  style="background-color:black;">

<nav id="display">
      <input type="text" id="user_input" placeholder="tripur"><br>
      <div id="submit" >Submit</div><br>
      <div id="final_submit">finalSubmit</div><br>

      <span id="display"></span>
</nav>

<model>
      <d id="place"></d>
</model>
<article id="map"></article>

<script type="text/javascript">
    var array = []; // empty array
    var marker= [];
    document.getElementById('submit').addEventListener('click',function(){test();});

    document.getElementById('final_submit').addEventListener('click',function(){storage();});
    var count=0;
    var map;

    function storage()
    {
      var finalplace=[];
      for(i=0;i<array.length;i++)
      {


        if(array[i].placeName!=null)
        {
        //  alert("session storage"+array.length);
          finalplace.push(array[i].placeName);
        }

      }


      sessionStorage.setItem("finalPlace",JSON.stringify(finalplace));
      alert("storage complete");
      location.href="distance.php"
    }


    function mymap()
    {
        var pos=new google.maps.LatLng(20.5937,78.9629);
        var elemId=document.getElementById("map");
        var prop= {center:pos,zoom:5};
        map=new google.maps.Map(elemId,prop);
    }
    function display()
    {
        alert("arraylenghttt"+array.length);
        for(i = 0; i<array.length ; i++)
        {
            alert(i+""+array[i].placeName)
        }

    }
    function delete_place(obj)
    {
        var arrayIndex=obj.id;
        alert("id==="+arrayIndex);
        var delet=document.getElementById("place"+arrayIndex);
        delet.parentNode.removeChild(delet);
        array[arrayIndex].placeMarker.setMap(null);
        array[arrayIndex].placeName=null;
        array[arrayIndex].placeMarker=null;
        //array.splice(arrayIndex,1);
        //count-=1;
    }
    function checkAddress(address)
    {
        for(i = 0; i<array.length ; i++)
        {
            if(address==array[i].placeName)
            {
                alert("place already selected");
                return 0;
            }
        }
        return 1;
    }
    function test()
    {
        var address =document.getElementById("user_input").value;
        if(checkAddress(address)==1)
        {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': address},function(results,status)
            {
            if(status === 'OK')
            {
                map.setCenter(results[0].geometry.location);
                marker[count]= new google.maps.Marker(
                {
                  map:map,
                  position:results[0].geometry.location,
                  label:address
                });
                array.push({placeName:address,placeMarker:marker[count]});
                var d1 = document.getElementById('place');
                //d1.insertAdjacentHTML('beforeend','<q id=place'+count+'>'+address+'<button id='+count+' onClick="delete_place(this)"><i class="fa fa-close"></button></q>');
                document.getElementById('place').innerHTML+='<q id=place'+count+'>'+address+'<button id='+count+' onClick="delete_place(this)"><i class="fa fa-close"></button></q>';
                count+=1;
            }
            else
            {
                alert("error"+status);
            }
            });
          }
    }
</script>
<script async defer
   src="google api key">
   </script>
   
</body>
</html>

