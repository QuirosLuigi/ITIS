<?php
     $DBConnect = mysqli_connect("127.0.0.1:4306", "root", "") or die ("Unable to Connect". mysqli_error());
     $db = mysqli_select_db($DBConnect, 'itisdev');
?>

<script>
     function validateForm(inputIds) {
          var decimalPattern = /^\d*\.?\d+$/;
          var inputs = Array.isArray(inputIds) ? inputIds : [inputIds];
          
          for (var i = 0; i < inputs.length; i++) {
               var decimalInput = document.getElementById(inputs[i]).value;
               
               if (!decimalPattern.test(decimalInput)) {
                    alert("Please enter a valid decimal number");
                    return false; // Prevent form submission
               }
          }
          return true; // Allow form submission
     }
</script>