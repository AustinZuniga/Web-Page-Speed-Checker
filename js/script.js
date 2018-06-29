$(document).ready(function() {
  $("#check").click(function(e) {
    $("#check").text('Checking Speed...');
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "php/checker.php",
      data: {
        file: $("#file").val()
       
      },
      success: function(result) {
        var result1 = result;
        if(result1 == 'failed'){
          document.getElementById('error_msg').innerHTML = "no such file exist!";
          $("#check").text('Check Speed');
         
        }
        else{
          document.getElementById('error_msg').innerHTML = "";
          var data = JSON.parse(result1);
          document.getElementById('response').innerHTML = data['response'] + " second/s";
          document.getElementById('speed').innerHTML = data['speed'] +" kb/s";
          $("#check").text('Check Speed');
        }
      },
      error: function(result) {
         $("#check").text('Check Speed');
         document.getElementById('problem').innerHTML = "Your Web Page took too long to load! Please check your code and try again! ";
      }
    });
  });

  });