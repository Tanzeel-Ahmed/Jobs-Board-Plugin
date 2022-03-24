<?php get_header();

        // The template for displaying single posts and pages.

?>

<?php

  

if(isset($_POST['submit'])) {

  $new_post = array(
        
        'post_type' => 'applications', // Custom Post Type Slug
        'post_status' => 'publish',
        'post_title' => $_POST['fullname'],
      );
  
      $post_id= wp_insert_post($new_post);
  
   
        update_post_meta($post_id, 'fullname', $_POST["fullname"]);
       
        update_post_meta($post_id, 'email', $_POST["email"]);

        update_post_meta($post_id, 'address', $_POST["address"]);

        update_post_meta($post_id, 'phone', $_POST["phone"]);

        update_post_meta($post_id, 'date', $_POST["date"]);

        update_post_meta($post_id, 'file', $_POST["file"]);
    
        

    }	  
            

?>



<html>
<body>
  <div class="col-md-6 offset-md-3 mt-5">
    <br>
    <h1><center>Job Application Form</center></h1>
    <form accept-charset="UTF-8" action="" method="POST" enctype="multipart/form-data">
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
        <label class="mr-4"  >Upload your Resume:</label>
        <input type="file" name="file" id="filetoupload" >
      </div><br>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
<?php get_footer();?>