$(document).ready(function() {
  // event when button is clicked
  $("#check").click(function(e) {
    // changing of button text
    $("#check").text('Checking Speed...');
    //check if file is empty
    if($("#file").val() != ''){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "php/checker.php",
          data: {
            file: $("#file").val()
           
          },
          success: function(result) {
            if(result == 0){
              document.getElementById('error_msg').innerHTML = "no such file exist!";
              $("#check").text('Check Speed');           
            }
            else{
              document.getElementById('error_msg').innerHTML = "";
              var data = JSON.parse(result);
              document.getElementById('response').innerHTML = data['response'] + " second/s";
              document.getElementById('speed').innerHTML = data['speed'] +" kb/s";
              $("#check").text('Check Speed');

              if(data['response'] < 0.9){
                 document.getElementById('result').innerHTML = "Your Web page loads in 0.8 seconds or less, it is faster than approximately 94% of the web!!";
              }
              else if( (data['response'] > 0.8) && (data['response'] < 1.8)) {
                document.getElementById('result').innerHTML = " Your Web page loads in 1.7 seconds, it is faster than approximately 75% of the web!!";
              }

              else if( (data['response'] > 1.7) && (data['response'] < 3.0)) {
                document.getElementById('result').innerHTML = " Your Web page loads in 2.9 seconds, it is faster than approximately 50% of the web!!";
              }
              else if( data['response'] > 2.9){
                document.getElementById('result').innerHTML = " Your Web page loads in 5 seconds, it is faster than approximately 25% of the web!!";
              }              

              else{
                 document.getElementById("result").style.color = "red";
                 document.getElementById('result').innerHTML = " Your Web page loads more than 5 seconds, which is bad.";
              }




            }
          },
          error: function(result) {
             $("#check").text('Check Speed');
             document.getElementById("result").style.color = "red";
             document.getElementById('result').innerHTML = "Opss... Something's wrong with your Web page!";
          }
        });
  }
  else{
    $("#check").text('Check Speed');
    document.getElementById('error_msg').innerHTML = "Please Enter file path";
   
  }
  });

  });