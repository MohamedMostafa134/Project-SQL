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



if(isset($_POST['send'])){
    #User Table
    $name =$_POST['name'];
    $email =$_POST['email'];
    $password="12345678";
    $hash_password= password_hash($password, PASSWORD_DEFAULT);
    $type="admin";
    $has_image =false ;
    if(!empty($_FILES['image']['name'])){
      $image_name=time() . $_FILES['image']['name'];
      $temp_name=$_FILES['image']['tmp_name'];
  $location ="../../upload/users" . $image_name ;
  move_uploaded_file($temp_name,$location);
    $has_image =true ;
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

    #Admins Table
    $position =$_POST['position'];
    if ($numberOfadmins > 0){
        $lead =$_POST['lead'];
    }else {
        $lead =NULL;
    }
    $createAdmin = "INSERT INTO admins VALUES (NULL, $position, $user_id, " . ($lead ? $lead : 'NULL') . ")";
    $insertAdmin= mysqli_query($conn , $createAdmin);
    $_SESSION['success']= "Create Admin Successfully";

    redirect('app/admins/index.php');
}
?>


<main id="main" class="main">

<div class="pagetitle">
  <h1>Form <?= print_r($_FILES)?></h1>
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

      <div class="card">
        <div class="card-body">
            

 

          <!-- Vertical Form -->
          <form method="post" class="row g-3" enctype="multipart/form-data">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Admin Name</label>
              <input type="text" name="name" class="form-control" id="inputNanme4"required>
            </div>
            <div class="col-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="inputEmail4"required>
            </div>
            <div class="col-12">
              <label for="image" class="form-label">Proflie Image</label>
              <input type="file" accept="images/*" name="image" class="form-control" id="inputEmail4">
            </div>
            <div class="col-12">
                <label for=""class="form-label">positions</label>
                <select name="position" class="from-select">
                    <option disabled selected> Select Position </option>
                    <?php foreach($positions as $item): ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
                     <?php if($numberOfadmins > 0):?>
            <div class="col-12">

                <label for=""class="form-label">Lead By</label>
                     <select name="lead" class="from-select">
                     <option disabled selected> Select Leader </option>
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