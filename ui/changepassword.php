<?php
include_once "connectdb.php";
session_start();

include_once "header.php";

if(isset($_POST['btnupdate'])) 
{
  $oldpassword = $_POST['txt_oldpassword'];
  $newpassword = $_POST['txt_newpassword'];
  $confirmpassword = $_POST['txt_confirmpassword'];

  //  echo $oldpassword."-".$newpassword."-".$confirmpassword;
   
  $email = $_SESSION['useremail'];
  
  $select=$pdo->prepare("select * from tbl_user where useremail='$email'");

  $select->execute();
  $row=$select->fetch(PDO::FETCH_ASSOC);

   $useremail_db = $row['useremail'];
   $password_db = $row['userpassword'];

 

  if($oldpassword == $password_db) {
    if($newpassword == $confirmpassword) {

      // $_SESSION['status']=$confirmpassword."-".$useremail_db;
      // $_SESSION['status_code']="success";
  
      $update=$pdo->prepare("update tbl_user set userpassword=:pass where useremail=:email");

      $update->bindParam(':pass',$confirmpassword);
      $update->bindParam(':email', $useremail_db);

      if($update->execute()) {
        $_SESSION['status']="Password Updated Successfully";
        $_SESSION['status_code']="success";
      } else {
        $_SESSION['status']="Password Not Updated Successfully";
        $_SESSION['status_code']="error";
      }
      
    } else  {
      $_SESSION['status']="New Password Does Not Matched";
      $_SESSION['status_code']="error";
    }
  } else {
    $_SESSION['status']="Old Password Does Not Matched";
    $_SESSION['status_code']="error";
  }

}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change Password</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li> -->
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">

          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
              <div class="card-body">
              <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Old Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" name="txt_oldpassword" placeholder="Old Password">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label" >New Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="New Password" name="txt_newpassword">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Repeat New Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Repeat New Password" name="txt_confirmpassword">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info" name="btnupdate">Update Password</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<?php include_once "footer.php"; ?>

<?php 
    if(isset($_SESSION['status']) && $_SESSION['status'] != '') {

    
  ?>
 
  <script>
    

    Swal.fire({
        icon: '<?php echo $_SESSION['status_code'];?>',
        title: '<?php echo $_SESSION['status'];?>'
      });

  </script>

  <?php 
    unset($_SESSION['status']);
  }
  ?>