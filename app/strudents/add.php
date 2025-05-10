<?php
include_once '../../env/functions.php';
auth();

include_once '../../shared/allhead.php';


$selectGp = "SELECT * FROM groups";
$groups = mysqli_query($conn, $selectGp);

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $group = $_POST['group'];

    $hasImage = false;
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $location = "../../upload/users/" . $image_name;
        move_uploaded_file($temp_name, $location);
        $hasImage = true;
    }
    if ($hasImage) {
        $createStudent = "INSERT INTO students VALUES (null , '$name', '$email', '$image_name','$group') ";
    } else {
        $createStudent = "INSERT INTO students VALUES (null , '$name', '$email', Default,'$group') ";
    }

    $insterStudents = mysqli_query($conn, $createStudent);

    $_SESSION['success'] = "student Added Successfully";

    redirect('app/students/');
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>New Student</h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Student
                            <a class="btn float-end" href="./index.php">Back</a>
                        </h5>
                        <!-- Floating Labels Form -->
                        <form method="post" class="row g-3" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Name">
                                    <label for="floatingName">Student Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                                    <select name="group" class="form-control" id="floatingGp">
                                        <option disabled selected>Select Group</option>
                                        <?php foreach ($groups as $item): ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingGp">Group</label>
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