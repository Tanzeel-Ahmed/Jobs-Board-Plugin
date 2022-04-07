<?php get_header();

        // The template for displaying single posts and pages.

?>

<html>
<head>


<script> 
        
        jQuery(document).ready(function($) { 
            
            $('#form').ajaxForm({
                 
                 success: function(response){
                  console.log(response);
                  event.preventDefault();
                  alert('Submit Successfully');
                 },
                 error: function(response){
                  console.log(response);
                 },
                 uploadProgress(event, position, total, percentComplete){
                  console.log(percentComplete);
                 },
                 resetForm: true
            }); 
           
            
        }); 
    </script>


</head>
<body>
  <div class="col-md-6 offset-md-3 mt-5">
    <br>
    <h1><center>Job Application Form</center></h1>
    <form accept-charset="UTF-8" id="form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="job_title" value="<?php echo get_the_title( ); ?>">
    <div class="form-group">
        <label for="exampleInputName">Full Name</label>
        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter your name and surname " required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="Enter your email address" required>
      </div>
      <div class="form-group">
        <label for="inputAddress">Home Address</label>
        <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St"  required>
      </div>
      <div class="form-group">
        <label for="example-tel-input" class="col-2 col-form-label" >Phone Number</label>
        <div class="col-10">
          <input class="form-control" name="phone" type="tel"  placeholder="+923123456789" id="phone" required>
        </div>
      </div>
      <div class="form-group">
        <label for="example-date-input" class="col-3 col-form-label"> Date</label>
        <div class="col-10">
          <input class="form-control" name="date" type="date" value="2020-02-01" id="date"  required>
        </div>
      </div>
      <div class="form-group mt-3">
        <label class="mr-4"  >Upload your Resume: (only pdf and doc files uploaded)</label>
        <input type="file" name="file" id="filetoupload" accept=".pdf,.doc" required>
      </div><br>
      <input type="hidden" name="action" value="application_form">
      <input type="submit" name="submit" class="btn btn-primary" id="submit" value="submit">
    </form>
  </div>
</body>
</html>
<?php get_footer();?>