
<?php include_once 'includes/header.php';?>


<?php if(!$session->is_sign_in()){ redirect('login.php');} ?>

<?php 
$message ='';
if(isset($_POST['submit'])){
  
  $photo = new Photo;
  $photo->title =$_POST['title'];
  $photo->set_file($_FILES['file_upload']);

    if($photo->save()){
      $message ="<h1 style='color:red'>upload<h1>";
    }else{
      $message= join('<br>',$photo->error);
    }
}

?>
<!--close-top-serch-->
<!--sidebar-menu-->
<?php include_once 'includes/sidebar_admin.php';?>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home / Upload</a></div>
    <h1>Upload</h1>
  </div>

<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
   
<?php if(isset($message)){echo $message;}?>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
          </div>
          <div class="widget-content"> 
          <form action="upload.php" method="post" class="form-group" enctype="multipart/form-data">
             <div class="form-group">
               <input type="text" name="title" class="form-control" placeholder="Enter title">
               </div>
               <div class="form-group">
                  <input type="file" name="file_upload" class="form-control">
               </div>
                <div class="form-group">
               <input type="submit" class="form-control" name="submit" value="Upload">
             </div>
           </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<?php include_once 'includes/footer.php';?>

