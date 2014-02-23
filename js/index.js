$(document).ready(function()
{
 
    var options = { 
    beforeSend: function() 
    {
        console.log("Enviando datos");
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
        console.log("subiendo");
    },
    success: function() 
    {
        console.log("subida");
 
    },
    complete: function(response) 
    {
        alert("Alerta registrada, este es el id de seguimiento: "+response.responseText);
    },
    error: function()
    {
        console.log("error");
 
    }
 
}; 
 
     $("#formaDeRegistro").ajaxForm(options);
 
});