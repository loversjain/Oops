
<?php 
require_once 'includes/header.php';

if($session->is_sign_in()){
  redirect("index.php");

}

if(isset($_POST['submit'])){
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
//db user login

$user_found = User::verify_user($email, $password);
  if($user_found){
    $session->login($user_found);
    redirect('index.php');
  }
  else{
    $the_message = "login failed ! try again";
  }
}
?>
<?php 

// echo INCLUDE_PATH; 
?>
<center>
<div class="container-fluid">
<div class="row-fluid">
<?php if(!empty($the_message)){ ?><h4 class="alert alert-danger"><?= $the_message; ?></h4><?php } ?>
<div class="span6 offset3">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Login</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="#" method="post" class="form-horizontal">
                 
             <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="email" class="span11" value="<?= User::old('email');?>" name="email" placeholder="Enter Email">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Password</label>
              <div class="controls">
                <input type="password" class="span11" name="password" placeholder="Enter Password">
              </div>
            </div>
           
           
            <div class="form-actions">
              <button type="submit" name="submit" class="btn btn-success">Login</button>
            </div>
          </form>
        </div>
      </div>
     
     
        </div>
      </div>
    </div>


<?php 
require_once 'includes/header.php';?>