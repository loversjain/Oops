
<?php include_once 'includes/header.php';?>
<?php if(!$session->is_sign_in()){ redirect('login.php');}?>
<?php $photo = Photo::findAllUsers();
 


?>
<!--close-top-serch-->
<!--sidebar-menu-->
<?php include_once 'includes/sidebar_admin.php';?>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home / Photos</a></div>
    <h1>Photos</h1>
  </div>

<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
   

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
          </div>
          <div class="widget-content"> 
           <table  class="table table-hover">
            <thead><tr>
             <th>Photo</th>
             <th>Id</th>
             <th>Title</th>
             <th>File Name</th>
             <th>Size</th>
            </tr>
            </thead>
            <tbody>
            <?php if($photo){?>
            <?php foreach($photo as $pic){?>
              <tr>
                <td><img src="<?php echo $pic->img_path(); ?>" height=100 width=100>
                <div >
                  <a href="">Edit</a>
                  <a href="delete_pic.php?id=<?= $pic->photo_id?>">Delete</a>
                  <a href="">View</a>
                </div>
                </td>
                <td><?= $pic->photo_id ?></td>
                <td><?= $pic->title ?></td>
                <td><?= $pic->description ?></td>
                <td><?= $pic->size ?></td>
              </tr>
              <?php }?>
              <?php }?>
            </tbody>
          </table>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<?php include_once 'includes/footer.php';?>

