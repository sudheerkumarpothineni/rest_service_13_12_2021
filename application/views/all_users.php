<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRUD API</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>CRUD Operation using Rest API</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    function fetch_all(){
      $.ajax({
        url:'<?php echo base_url()?>index.php/Test_api',
        method:'POST',
        data:{'data_action':'fetch_all'},
      });
    }
  })
</script>
