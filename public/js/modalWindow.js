$(document).ready(function(){
    $("#add-offer").click(function(){
      $("#modal-add-offer").show();
    });

    $(".show-offer").click(function(){
      $("#modal-show-offer").show();
    });  

    $(".edit-product").click(function(){
      $("#modal-edit-product").show();
    });   
  
    $("#close").click(function(){
      $("#modal-add-offer").hide();
    });

    $("#close-show").click(function(){
      $("#modal-show-offer").hide();
    });

    $("#close-edit").click(function(){
      $("#modal-edit-product").hide();
    });

    $("#modal-add-offer").click(function(e){
      if (e.target.id === "modal-add-offer") {
          $("#modal-add-offer").hide();
      }
    });
    $("#modal-show-offer").click(function(e){
      if (e.target.id === "modal-show-offer") {
          $("#modal-show-offer").hide();
      }
    });
});