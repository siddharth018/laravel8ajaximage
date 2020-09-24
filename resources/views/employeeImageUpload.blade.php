<html>
<head>
	<title>Laravel 8 Ajax Image Upload with validation: Real Programmer</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
</head>
<body>


<div class="container">
  <h1>Laravel 8 Ajax Image Upload with validation: Real Programmer</h1>
     <div class="alert" id="message" style="display: none"></div>

  <!-- <form action="{{ route('employeeImageUpload') }}" enctype="multipart/form-data" method="POST"> -->
     <form method="post" id="upload_form" enctype="multipart/form-data">
    @csrf
      	<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" placeholder="Name">
    </div>
	<div class="form-group">
      <label>Image</label>
      <input type="file" name="image" class="form-control">
      
    </div>
    <div class="form-group">
      <button class="btn btn-success upload-image" type="submit">Upload Image</button>
    </div>
  </form>
     <span id="uploaded_image"></span>

</div>
<script>
$(document).ready(function(){

 $('#upload_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"{{ url('employeeImageUpload') }}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(data)
   {
    $('#message').css('display', 'block');
    $('#message').html(data.success);
    $('#message').addClass(data.class_name);
    $('#uploaded_image').html(data.uploaded_image);
   }
  })
 });

});
</script>

</html>