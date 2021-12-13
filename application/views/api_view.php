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
  <h2>Crud Operation Using Rest Api</h2>
  <button type="button" class="btn btn-info" id="add_button" style="float: right;">Add</button>
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
</div>



<!-- Users Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
   <form id="user_form" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <span id="success_message"></span>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control">
            <div id="first_name_error" class="text-danger"></div>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control">
            <span id="last_name_error" class="text-danger"></span>
          </div>
      </div> 
      <div class="modal-footer">
        <input type="hidden" name="origin" id="origin">
        <input type="hidden" name="data_action" id="data_action" value="Insert">
        <input type="submit" name="action" id="action" value="Add" class="btn btn-success">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
   </form>

  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){

    //To fetch all users
    function fetch_all(){
      $.ajax({
        url:'<?php echo base_url()?>index.php/Test_api/action',
        method:'POST',
        data:{'data_action':'fetch_all'},
        success:function(data){
          $('tbody').html(data);
        }
      });
    }

    fetch_all();

    //Add Button
    $(document).on('click','#add_button',function(){
      $('#user_form')[0].reset();
      $('.modal-title').text('Add User');
      $('#data_action').val('Insert');
      $('#action').val('Add');
      $('#success_message').html('');
      $('#myModal').modal('show');
    });

    // Insert & Update
    $(document).on('submit','#user_form',function(event){
      event.preventDefault();
      $.ajax({
        url:'<?php echo base_url()?>index.php/Test_api/action',
        method:'POST',
        data:$(this).serialize(),
        dataType:'json',
        success:function(data){
          // console.log(data);
          // alert(data);
          if(data.success) {
            $('#user_form')[0].reset();
            $('#myModal').modal('show');
            fetch_all();
            // if ($('#data_action').val() == 'Insert') {
              // $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
              $('#success_message').html('<div class="alert alert-success">'+data.msg+'</div>');
              $('#myModal').delay(3000).modal('hide');
            // }
          } 
          if(data.error) {
            $('#first_name_error').html(data.first_name_error);
            $('#last_name_error').html(data.last_name_error);
          }
        }
      });
    });

    //Fetch Single User Data
    $(document).on('click','.edit',function(){
      var origin = $(this).attr('id');
      console.log(origin);
      $.ajax({
          url:'<?php echo base_url()?>index.php/Test_api/action',
          method:'POST',
          data:{origin:origin,data_action:'fetch_single_user_data'},
          dataType:'json',
          success:function(data){
            console.log(data);
          $('#myModal').modal('show');
          $('.modal-title').text('Edit User');
          $('#data_action').val('Update');
          $('#action').val('Edit');
          $('#success_message').html('');
          $('#origin').val(data.origin);
          $('#first_name').val(data.first_name);
          $('#last_name').val(data.last_name);
        }
      });
    });

    // Delete
    $(document).on('click','.delete',function(){
      var origin = $(this).attr('id');
      console.log(origin);
      if (confirm("Are You Sure You Want To Delete This ? ")) {
        $.ajax({
            url:'<?php echo base_url()?>index.php/Test_api/action',
            method:'POST',
            data:{origin:origin,data_action:'Delete'},
            dataType:'json',
            success:function(data){
              if (data.success) {
                fetch_all();
              }
            }
        });
      }
    });
  });
</script>
