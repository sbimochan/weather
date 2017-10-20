
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery.getJSON demo</title>
  <style>
  img {
    height: 100px;
    float: left;
  }
  </style>

  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>


City Name: <span id="cityname"></span><br><br>
<select id="cityselect">
  <option value="kathmandu,np">Kathmandu</option>
  <option value="pokhara,np">Pokhara</option>
  <option value="nepalgunj,np">Nepalgunj</option>
  <option value="dang,np">Dang</option>
  <option value="mustang,np">Mustang</option>
  <option value="london,uk">London</option>
</select>
  Current temp : <span id="temp"></span>&deg;C
  <h2>wind</h2>
  speed: <span id="windspeed"></span>mph<br>
  degree: <span id="winddegree"></span>
  <div>
    <h3>Weather</h3>
    main: <span id="main"></span><br>
    description: <span id="desc"></span>
  </div>
  <div>
    sunrise: <span id="sunrise"></span>
  </div>

  <h4>forecast of kathmandu</h4>
  <span id="firstday"></span>
<ul id="forecast">

</ul>
<script>

$(window).on('load',function(){  //Auto trigger on freshly loaded page
  $('#cityselect').trigger('change');
})
  $('#cityselect').on("change", function()
  {
    var city=$('#cityselect').val();
    var dynurl='http://api.openweathermap.org/data/2.5/weather?q='+city+'&appid=e76f53212d4aba725d8e001d7d39e00d'

    $.ajax({
        dataType: "json",
        url: dynurl,
        success: function(response)
        {
          var cel=response.main.temp-273.15;
          var temp=Math.round(cel*100)/100;
              $('#temp').text(temp);
              $('#windspeed').text(response.wind.speed);
              $('#winddegree').text(response.wind.deg);
              $('#main').text(response.weather[0].main);
              $('#desc').text(response.weather[0].description);
              $('#cityname').text(response.name);
              var unix=response.sys.sunrise;
              var myDate=new Date(1000*unix);
              var hrs=myDate.getHours();
              var mins=myDate.getMinutes();
              var secs=myDate.getSeconds();
              $('#sunrise').text(hrs+':'+mins+':'+secs);
        }
    });
})
$.ajax({
  dataType:'json',
  url:'http://api.openweathermap.org/data/2.5/forecast/daily?id=1283241&cnt=7&appid=e76f53212d4aba725d8e001d7d39e00d',
  success:function(response){
     $.each(response.list, function (i, item) {
    var cel=item.temp.day-273.15;
    var temp=Math.round(cel*100)/100;
  console.log(temp);
    var li = '<li>'+ temp+'&deg;C</li>';
    $('#forecast').append(li);
  });
}
});

</script>
<br>
<footer>&copy; <?php echo date('Y') ?>&nbsp;SBimochan</footer>
</body>
</html>