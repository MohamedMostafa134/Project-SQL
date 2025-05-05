<?php 
include_once '../../shared/allhead.php';

$count = 1;
auth();
$admins = "SELECT * FROM `admin_data`";
$allAdmins = mysqli_query($conn, $admins);


#Delte
if($_GET['Delete']){
  $id =$_GET['Delete'];
  $admin = "SELECT * FROM `admin_data` where admin_id=$id";
$oneAdmin = mysqli_query($conn, $admins);
$admin_Data=mysqli_fetch_assoc($oneAdmin);
$image_name=$admin_Data['image'];
$user_id=$admin_Data['user_id'];
unlink("../../upload/users/$image_name");


$adminDelete="DELETE FROM admins where id =$id ";
mysqli_query($conn ,$adminDelete );
$UserDelete="DELETE FROM users where id =$user_id ";
mysqli_query($conn ,$UserDelete );
$_SESSION['success']="Delete Admin Successfully";
redirect('app/admins/');
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
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
      <?php 
      $host = $_SERVER['HTTP_HOST'];
      $url = $_SERVER['REQUEST_URI'];

      $full_path= "Http://".$host. $url ;
      
      
      if(isset($_SESSION['success'])): ?>
             <div class="alert alert-success alert-dismissible fade show"> 
              <?= $_SESSION['success'] ?>
              <form method="post" action=" <?= url("env/functions.php") ?>">
              <button name ="CloseSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             <input type="hidden" value="<?= $full_path ?>" name ="fullpath">
              </form>
              </div>
               <?php endif; ?>

        <div class="card-body">
          <h5 class="card-title">List All Admins
          <a href="./add.php" class="btn btn-info float-end"> Add New </a>
          </h5>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>
                  No
                </th>
                <th>user_name</th>
                <th>email</th>
                <th>position_name</th>
                <th>View</th>
                <th>Edit</th>
                <th>Deleta</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach($allAdmins as $item): ?> 

              <tr>
                <td><?= $count++?></td>
                <td><?= $item['user_name']?></td>
                <td><?= $item['email']?></td>
                <td><?= $item['position_name']?></td>
                <td><a class="btn btn-info" href=<?= url("app/admins/view.php?view=<?=") . $item['admin_id'] ?> >View</a></td>
                <td><a class="btn btn-warning" href=<?= url("app/admins/view.php?Edit=<?=") . $item['admin_id'] ?> >Edit</a></td>
                <td><a class="btn btn-danger" href=<?= url("app/admins/index.php?Delete=<?=") . $item['admin_id'] ?> ></a>Deleta</td>
              </tr>
              <?php endforeach ?>
            </tbody>

          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?php
include_once '../../shared/allscript.php';
?>