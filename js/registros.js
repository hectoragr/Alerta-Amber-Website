$(document).on("ready", cargarAlertas);
var json;
var id;
function cargarAlertas () {
	$.ajax({
      url: "services/getAlerts.php",
      type: "post",
      data: { estado : 19},
  	dataType: 'json',
      success: function(data){
      	json = data;
      	$("#lista").empty();
           for(index in data){
           	$("#lista").append("<div id='"+data[index]['id']+"'class='row'><div class='col-4'><img src='img/"+data[index].fotografia+"' class='img img-well'/><h1 class='muted'>"+data[index].homoclave+"</h1> <p class='feature-description'>"+data[index].nombre+" "+data[index].apellidos+"</p></div><div id='"+data[index]['id']+"d' class='col-8'></div></div>");
           	$("#"+data[index]['id']).on("click",cargaAlerta);
           }        
      },
      error:function(error){
         console.log(error);
      }   
    }); 
}

function cargaAlerta () {
	console.log($(this).attr("id"));
	id = $(this).attr("id");
	$.ajax({
      url: "services/getAlert.php",
      type: "post",
      data: { id : $(this).attr("id")},
  	dataType: 'json',
      success: function(data){
		     $("#"+id+"d").empty();
		     $("#"+id+"d").append("<label> Estatura: "+data.estatura+"</label><label> Complexion: "+data.complexion+"</label>"+"<label> Fecha en que desaparecio: "+data.fecha_suceso+"</label>");
      },
      error:function(error){
         console.log(error);
      }   
    });
}