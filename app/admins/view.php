<?php 
include_once '../../env/functions.php';
auth();

include_once '../../shared/allhead.php';

$count = 1;

if($_GET['view']){
    $id =$_GET['view'];
    $admins = "SELECT * FROM `admin_data` where admin_id= $id ";
    $allAdmins = mysqli_query($conn, $admins);
    $admin =mysqli_fetch_assoc($allAdmins);
}

?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
<h5 class="card-title">View Admin
          <a href="./add.php" class="btn btn-info float-end"> Add New </a>
          </h5>
  <div class="row justify-content-around">
    <div class="col-lg-6">

      <div class="card">
        <?php if (!empty($admin['image'])): ?>
    <img src="<?= url('upload/users/') . $admin['image'] ?>" alt="">
          <?php else: ?>
    <img src="<?= url('assets/images.jpeg') ?>" alt="">   
          <?php endif; ?>
        <div class="card-body">
          <h5>User user_name:<?= $admin['user_name']?></h5>
          <hr>
          <h5>User position_name:<?= $admin['position_name']?></h5>
          <hr>
          <h5>User email:<?= $admin['email']?></h5>
          <hr>



        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?php
include_once '../../shared/allscript.php';
?>