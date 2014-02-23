<!DOCTYPE html>
<html class="">
<head>
<meta charset="utf-8" />
<title>AmberMX</title>
<link rel="stylesheet" href="assets/css/normalize.css" />
<link rel="stylesheet" href="assets/css/furatto.css" />
<link rel="stylesheet" href="assets/css/font-awesome.css" />
<link rel="stylesheet" href="assets/css/docs.css" />
<link rel="stylesheet" href="assets/css/examples.css" />
<link rel="shortcut icon" href="furatto/assets/img/favicon.ico" />
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/parse.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('No se pudo determinar dirección, por favor escríbala.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('place').innerHTML = str;
}


  function initialize() {
    var latLng = new google.maps.LatLng(25.673808,-100.309192);
    var mapOptions = {
      // center: new google.maps.LatLng(25.673808,-100.309192),
      center: latLng,
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var div = document.getElementById("map_canvas");
    var map = new google.maps.Map(div,
        mapOptions);
    if(div.style.display=="none")
      div.style.display="";
    else
      div.style.display="none";

    var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
    });

    // Update current position info.
    updateMarkerPosition(latLng);
    geocodePosition(latLng);

    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragstart', function() {
      updateMarkerAddress('Obteniendo...');
    });

    google.maps.event.addListener(marker, 'drag', function() {
      updateMarkerStatus('Obteniendo...');
      updateMarkerPosition(marker.getPosition());
    });

    google.maps.event.addListener(marker, 'dragend', function() {
      updateMarkerStatus('Calculado');
      geocodePosition(marker.getPosition());
    });
  }
</script>
<style>
#infoPanel {
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
</style>
</head>
<body>
<div class="panels ">
  <div class="panel panel-left">
  </div>
</div>

<div class="panel-content">
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner docs-navbar-inner">
      <div class="container">
        <a href="#menu" class="menu-trigger meteocon" data-meteocon="M" data-toggle="panel" data-target="#menu"></a>
        <div class="nav-collapse collapse">
          <nav id="menu">
            <ul class="nav docs-navbar-menu">
              <li><a class="brand" href="index.php">AmberMX</a></li>
              <li class=""><a href="alta.php">Nueva Alerta</a></li>
              <li class=""><a href="registros.php">Ver registros </a></li>
              <li class=""><a href="estadisticas.php">Estadísticas</a></li>
              <li class=""><a href="vista_mapa.php">Ver Mapa de Alertas</a></li> 
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
    <div class="container-center">
      <div class="row">
        <div class="col-3" align="left">
        <div class="docs-sidebar" data-offset-top="80">
          <form id="campos" name="campos">
          <ul class="nav nav-bordered">
            <li><div class="form-fields">
                <label for="key">Homoclave</label>
                <input class="input-xlarge" type="text" name="key" id="key"><br>
              </div>
            </li><hr>
            <li><div class="form-fields">
                <label for="firstName">Nombre</label>
                <input class="input-xlarge" type="text" name="firstName" id="firstName"><br>
              </div>
            </li><hr>
            <li><div class="form-fields">
              <label for="lastName">Apellidos</label>
              <input class="input-xlarge" type="text" name="lastName" id="lastName"><br>
            </div>
            </li><hr>
            <li><div class="form-fields">
              <label for="age">Edad</label>
              <input class="input-large" type="number" name="age" id="age"><br>
            </div>
            </li><hr>
            <li><div class="form-fields">
              <label for="date">Fecha de Suceso</label>
              <input class="input-large" type="date" name="date" id="date"><br>
            </div>
            </li>
          </ul>
           <a href="javascript:filtrar()" class="btn btn-success">Filtrar</a> 
        </div>
          </form>
      </div>
      <div class="col-9">
      <table border="1" cellpadding="4">
        <tr class="tr" style="font-size: 13px">
          <td style="background-color:#28b262;color:#FFF">Alertas de este día</td>
          <td style="background-color:#2a83bd;color:#FFF">Entre 1-7 días</td>
          <td style="background-color:#d85600;color:#FFF">De 1 a 4 semanas</td>
          <td style="background-color:#c43a2c;color:#FFF">De 1 a 3 meses</td>
          <td style="background-color:#262933;color:#FFF">Más de 3 meses</td>
        </tr>
      </table>
      <div id="map_canvas" style="width: 700px; height: 500px;"></div><br>
  </div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/furatto.min.js"></script>
</body>
</html>
