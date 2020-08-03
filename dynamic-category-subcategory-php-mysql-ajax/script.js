//Ajax
$(document).ready(function(){
    $('#add_categories').click(function(){
      var parent_category_id = $('#parent_category_id').val();
      var category_name = $('#category_name').val();
      
       $.ajax({
              url: "index.php",
              type: 'POST',
              dataType:'html',
           
              data:{ 
                "parent_category_id": parent_category_id,  
                "category_name": category_name
              },
              success: function(data, status){ 
                $("form").html(data);
              }, 
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
              } 
    });
  });
});

//For Tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    });

    //Delete Category 
    $(document).ready(function(){
    $(".remove").click(function(){
    var alert_message;

    location.reload();
    return alert_message = confirm("Are you sure! You Want To Delete This Category.");
        });
    });

    //hide message
    setTimeout(function() {
        document.getElementById("message").style.display = 'none';
    }, 4000);