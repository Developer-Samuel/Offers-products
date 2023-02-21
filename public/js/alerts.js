$(document).ready(function(){    
    $("#alertCloseBtn").click(function(){
        $("#alert").hide();
    });
    $("#alert").click(function(e){
        if (e.target.id === "alert") {
            $("#alert").hide();
        }
    });
});