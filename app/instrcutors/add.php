<?php
include_once '../../env/functions.php';
auth();

include_once '../../shared/allhead.php';



$selectDep = "SELECT  * FROM departments";
$departments = mysqli_query($conn, $selectDep);


if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = "12345678";
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $hasImage = false;

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $location = "../../upload/users/" . $image_name;
        move_uploaded_file($temp_name, $location);
        $hasImage = true;
    }
    if ($hasImage) {
        $Create_User = "INSERT INTO users VALUES (null , '$name', '$email','$hash_password' ,'$image_name' ,'instructor') ";
    } else {
        $Create_User = "INSERT INTO users VALUES (null , '$name', '$email','$hash_password' ,Default,'instructor') ";
    }

    $insert_user = mysqli_query($conn, $Create_User);
    // Read
    $selectUser = "SELECT * FROM users WHERE email = '$email'";
    $userData = mysqli_query($conn, $selectUser);
    $userAllData = mysqli_fetch_assoc($userData);
    $user_id = $userAllData['id'];




    $department = $_POST['department'];
    $track = $_POST['track'];
    $linkedin = $_POST['linkedin'];

   $insert_instructor = "INSERT INTO `instructors` (department_id, track, linkedin, user_id) VALUES ($department, '$track', '$linkedin', $user_id)";
    $insData = mysqli_query($conn, $insert_instructor);

    // die;
    $_SESSION['success'] = "Instructor Added Successfully";
    redirect('app/instructors/');
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>New instructor</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Instructor
                            <a class="btn float-end" href="./index.php">Back</a>
                        </h5>
                        <!-- Floating Labels Form -->
                        <form method="post" class="row g-3" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Name">
                                    <label for="floatingName">Instructor Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email">
                                    <label for="floatingEmail">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" name="image" class="form-control" id="floatingimg" accept="image/*">
                                    <label for="floatingimg">image</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="department" class="form-control" id="floatingDep">
                                        <option disabled selected>Select Department</option>
                                        <?php foreach ($departments as $item): ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingDep">Department</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="track" class="form-control" id="floatingTrack" placeholder="track">
                                    <label for="floatingTrack">Track</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="linkedin" class="form-control" id="floatinglink" placeholder="LinkedIn">
                                    <label for=" floatinglink">Linkedin</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="send" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form><!-- End floating Labels Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
include_once '../../shared/allscript.php'
?>