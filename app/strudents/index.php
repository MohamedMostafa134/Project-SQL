<?php
include_once '../../env/functions.php';
auth('strudents');

include_once '../../shared/allhead.php';
$count = 1;
$students = "SELECT * FROM `student_data`";
$allStudents = mysqli_query($conn, $students);

 if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $student = "SELECT * FROM `student_data` WHERE id = $id";
    $oneStudent = mysqli_query($conn, $student);
    $studentData = mysqli_fetch_assoc($oneStudent);

    $studentDelete = "DELETE FROM students WHERE id = $id";
    mysqli_query($conn, $studentDelete);


    $_SESSION['success'] = "Student Deleted Successfully";
    redirect('app/students/');
}
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Students Data</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php
                    $host = $_SERVER['HTTP_HOST'];
                    $url = $_SERVER['REQUEST_URI'];
                    $fullPath = "http://" . $host . $url;

                    if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['success'] ?></strong>
                            <form method="post" action="<?= url("env/functions.php") ?>">
                                <button name ="CloseSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <input type="hidden" value="<?= $fullPath ?>" name="fullpath">
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">List All Students
                            <a class="btn float-end" href="./add.php">Add New</a>
                        </h5>
                        <table class="table datatable text-center">
                            <thead>
                                <tr>
                                    <th>#NO</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Group</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allStudents as $item): ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $item['student_name'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= $item['group_name'] ?></td>
                                        <td><a class="btn btn-info" href="<?= url("app/strudents/view.php?view=") . $item['id'] ?>">View</a></td>
                                        <td><a class="btn btn-warning" href="<?= url("app/strudents/add.php?edit=") . $item['id'] ?>">Edit</a></td>
                                        <td><a class="btn btn-danger" href="<?= url("app/strudents/index.php?delete=") . $item['id'] ?>">Delete</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
include_once '../../shared/allscript.php'
?>