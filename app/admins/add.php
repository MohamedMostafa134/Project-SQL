<?php 

include_once '../../env/functions.php';
auth();

include_once '../../env/db.php';
include_once '../../shared/allhead.php';

$SELECTPositions = "SELECT * FROM positions";
$positions = mysqli_query($conn ,$SELECTPositions);

$SELECTAdmins = "SELECT * FROM admin_data";
$admins = mysqli_query($conn ,$SELECTAdmins);
$numberOfadmins = mysqli_num_rows($admins);

       $errors=[];

   if(isset($_POST['send'])){
    #User Table
    $name = filter_validation($_POST['name']);
    $email = filter_validation($_POST['email']);

    $password="12345678";
    $hash_password= password_hash($password, PASSWORD_DEFAULT);
    $type="admin";
    $has_image =false ;
    if(string_validation($email)){
      $errors[]='Please Enter Valid Email';
    }
    if(string_validation($name)){
      $errors[]="Please Enter Valid Name";
    }
    if(empty($errors)){
      if(!empty($_FILES['image']['name'])){
      $image_name=time() . $_FILES['image']['name'];
      $temp_name=$_FILES['image']['tmp_name'];
      $image_size=$_FILES['image']['size'];
      $image_type=$_FILES['image']['size'];
      if(file_size_validation($image_size)){
        $errors[]= "Your Image Biiger Than 2 Miga";
      }
      if(file_type_validation($image_type , 'image/png', 'image/jpg', 'image/jif', 'image/jpeg')){
        $errors[]= "Your File Is Not Image";
      }
           $location ="../../upload/users" . $image_name ;
           if(empty($errors)) {
           move_uploaded_file($temp_name,$location);
           $has_image =true ;
     }
      
    }
    if ($has_image) {
      $createUser ="INSERT INTO users VALUES (null,'$name','$email','$hash_password','$image_name','$type')";
     }else{
      $createUser ="INSERT INTO users VALUES (null,'$name','$email','$hash_password',Default,'$type')";
     } 
      $insertUser = mysqli_query($conn ,$createUser);
     #Insert
     
     
     #Read
    $selectuser="SELECT * FROM users Where email= '$email'";
    $userData = mysqli_query($conn ,$selectuser);
    $userAllData = mysqli_fetch_assoc($userData);
    $user_id = $userAllData['id'];
    }
    
    
    
   

    #Admins Table
    $position =filter_validation($_POST['position']);
    if(string_validation($position,1,3)){
      $errors[]="Please Enter Valid Position";
    }
    if ($numberOfadmins > 0){
        $lead =filter_validation($_POST['lead']);
    }else {
        $lead =NULL;
    }
     if(string_validation($lead,1,3)){
      $errors[]="Please Enter Valid Leader";
    }
   if(empty($errors)){
    $createAdmin = "INSERT INTO admins VALUES (NULL, $position, $user_id, " . ($lead ? $lead : 'NULL') . ")";
    $insertAdmin= mysqli_query($conn , $createAdmin);
    $_SESSION['success']= "Create Admin Successfully";

    redirect('app/admins/index.php');
   }
}
?>


<main id="main" class="main">

<div class="pagetitle">
  <h1></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Layouts</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="container col-lg-8">
  <div class="row">
  <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add New Admin
          <a href="./index.php" class="btn btn-info float-end"> Back New </a>
          </h5>
       <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach($errors as $err): ?>
              <li><?= $err?></li>
              <?php endforeach ?>
          </ul>
        </div>
        <?php endif; ?>
      <div class="card">
        <div class="card-body">
            

 

          <!-- Vertical Form -->
          <form method="post" class="row g-3" enctype="multipart/form-data">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Admin Name</label>
              <input type="text" name="name" class="form-control" id="inputNanme4">
            </div>
            <div class="col-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-12">
              <label for="image" class="form-label">Proflie Image</label>
              <input type="file" accept="images/*" name="image" class="form-control" id="inputEmail4">
            </div>
            <div class="col-12">
                <label for=""class="form-label">positions</label>
                <select name="position" class="from-select">
                    <option value="" selected> Select Position </option>
                    <?php foreach($positions as $item): ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
                     <?php if($numberOfadmins > 0):?>
            <div class="col-12">

                <label for=""class="form-label">Lead By</label>
                     <select name="lead" class="from-select">
                     <option  value="" selected> Select Leader </option>
                     <?php foreach($admins as $item): ?>
                     <option value="<?= $item['admin_id'] ?>"><?= $item['user_name'] ?></option>
                     <?php endforeach; ?>
                </select>
            </div>
<?php endif; ?>

            <div class="text-center">
              <button type="Submit" name="send" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- Vertical Form -->

        </div>
      </div>

    </div>

</section>
</main><!-- End #main -->
<?php
include_once '../../shared/allscript.php';
?>