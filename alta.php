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
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/index.js"></script>
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

    google.maps.event.addListener(map, 'click', function(e) {
      map.setCenter(e.latLng);
      $('#latitud').val(e.latLng.lat());
      $('#longitud').val(e.latLng.lng());
      updateMarkerStatus('Calculado');
      geocodePosition(e.latLng);
      marker.setPosition(e.latLng);
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
      <h3 align="left">Alta de alerta</h3>
      <div class="row">
        <form name="Registro" id="formaDeRegistro" action="services/saveAlert.php" method="post" enctype="multipart/form-data">
           <div class="col-6" align="left">
              <h5>Campos Obligatorios</h5>
              <div class="form-fields">
                <label for="">Nombre</label>
                <input class="input-medium" type="text" name="nombre" id="firstName"><br>
              </div>
              <div class="form-fields">
                <label for="">Apellido</label>
                <input class="input-medium" type="text" name="apellidos" id="lastName"><br>
              </div>
              <div class="checkbox-fields">
                <label for="genero">Género</label>
                <input name="genero" id="masculino" type="radio" value="M">Masculino</input>
                <input name="genero" id="femenino" type="radio" value="F">Femenino</input>
              </div>
              <div class="form-fields">
                <label for="height">Estatura</label>
                <input class="input-small" type="number"  step="0.01" name="estatura" id="height" placeholder="metros"><br>
              </div>
              <div class="form-fields">
                <label for="weight">Peso</label>
                <input class="input-small" type="number" name="peso" id="weight" placeholder="kg"><br>
              </div>
              <div class="form-fields">
                <label for="birthday">Fecha de nacimiento</label>
                <input class="input-small" type="date" name="fecha_nacimiento" id="birthday"><br>
              </div>
              <div class="form-fields">
                <label for="place">Lugar <a href="javascript:initialize()" class="btn btn-info">Indicar en el mapa</a></label>
                <textarea class="input-block" rows="3" name="lugar" id="place"></textarea>
                <input id="latitud" name="latitud" type="text" />
                <input id="longitud" name="longitud" type="text" />
                <div id="map_canvas" style="width: 400px; height: 350px; display: none;"></div><br>
                <div id="infoPanel" style="display:none">
                <b>Marker status:</b>
                <div id="markerStatus" style="display:none"><i>Click and drag the marker.</i></div>
                <b>Current position:</b>
                <div id="info"></div>
                <b>Closest matching address:</b>
                <div id="address"></div>
                </div>
              </div>
            </div>
            <div class="col-6" align="left">
              <h5>Campos Opcionales</h5>
              <div class="form-fields">
                <label for="photo">Foto del extraviado </label>
                <input type="file" name="imagen" id="photo"></input>
              </div>
              <div class="form-fields">
                <label for="clothes">Descripción de ropa</label>
                <textarea class="input-block" rows="2" name="ropa" id="clothes"></textarea><br>
              </div>
              <div class="form-fields">
                <label for="eyes">Ojos </label>
                <select name="ojos" id="eyes">
                  <option selected="selected"></option>
                  <option value="blue">Azules</option>
                  <option value="green">Verdes</option>
                  <option value="brown">Marrón</option>
                  <option value="black">Negro</option>
                </select>
              </div>
              <div class="form-fields">
                <label for="hair">Cabello</label>
                <input class="input-small" type="text" name="cabello" id="hair"><br>
              </div>
              <div class="form-fields">
                <label for="skin">Piel</label>
                <input class="input-small" type="text" name="piel" id="skin"><br>
              </div>
              <div class="form-fields">
                <label for="marks">Marcas especiales</label>
                <textarea class="input-block" rows="2" name="marcas" id="marks"></textarea><br>
              </div>
              <div class="form-fields">
                <label for="marks">Cicatrices</label>
                <textarea class="input-block" rows="2" name="cicatrices" id="cicatrices"></textarea><br>
              </div>
              <div class="form-fields">
                <label for="complexion">Complexión </label>
                <select name="complexion" id="complexion">
                  <option selected="selected"></option>
                  <option value="delgado">Delgado</option>
                  <option value="normal">Peso adecuado</option>
                  <option value="sobrepeso">Sobrepeso</option>
                </select>
              </div>
              <div class="form-fields">
                <label for="people_involved">Involucrados</label>
                <textarea class="input-block" rows="3" name="involucrados" id="people_involved"></textarea><br>
              </div>
              <div class="checkbox-fields">
              <label for="vehiculo">¿Hay un vehículo involucrado?</label>
                <input name="vehiculo" id="vehiculo" type="radio" value="1">Sí</input>
                <input name="vehiculo" id="vehiculo" type="radio" value="0">No</input>
              </label>
              </div>
            </div>
            <input type="submit" value="Guardar alerta">
        </form>
      </div>
    <div class="row footer">
    <p class="copyright">By <a href="#" class="docs-license">AmberMx</a></p>
    <ul class="inline">   
    </ul>
    </div>
  </div>

<script src="assets/js/furatto.min.js"></script>
</body>
</html>
