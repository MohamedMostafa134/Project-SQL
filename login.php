<?php 
include_once './shared/head.php';
include_once './env/functions.php';
$message =null;

if(isset($_POST['login'])){
  $email=$_POST['email'];
  $password=$_POST['password'];
  $SELECTUSer = "SELECT * FROM users where email='$email'";
  $user=mysqli_query($conn ,$SELECTUSer);
  $numrows =mysqli_num_rows($user);

  if($numrows ==1) {
    $user_Data =mysqli_fetch_assoc($user);
    $hash_password=$user_Data['password'];
    $isUser =password_verify($password ,$hash_password);
    if($isUser){
      $_SESSION['auth'] =[
     "name" => $user_Data ['name'],
     "email" => $user_Data ['email'],
     "id" => $user_Data ['id'],
     "type" => $user_Data ['type'],
     "image" => $user_Data ['image'],

      ];
          redirect('index.php');
    }else{
      $message ="Wrong Data";
    }
  }else {
    $message ="Wrong Data";
  }
}
guest();

?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <?php
  
              if($message != null): ?>
             <div class="alert alert-danger alert-dismissible fade show"> 
              <?= $message  ?>
              <form method="post" action=" <?= url("env/functions.php") ?>">
              <button name ="CloseSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             
              </div>
               <?php endif; ?>


                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST">

                    <div class="col-12">
                      <label for="Email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="Email" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    </div>
                    <div class="col-12">
                      <button name="login" class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    
                  </form>

                </div>
              </div>

           

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <?php
include_once './shared/script.php';
?>