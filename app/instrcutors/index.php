<?php
include_once '../../env/functions.php';
auth();

include_once '../../shared/allhead.php';
$count = 1;

$instructors = "SELECT * FROM `instructor_data`";
$allInstructors = mysqli_query($conn, $instructors);

 if ($_GET['delete']) {
     $id = $_GET['delete'];

     $instructor = "SELECT * FROM `instructor_data` WHERE id = $id";
     $oneInstructor = mysqli_query($conn, $instructor);
     $instructorData = mysqli_fetch_assoc($oneInstructor);

     $instructorDelete = "DELETE FROM instructors WHERE id = $id";
     mysqli_query($conn, $instructorDelete);


     $_SESSION['success'] = "Instructor Deleted Successfully";
     redirect('app/instructors/');
 }




?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Instructors Data</h1>
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
                                <button type="submit" name="closeSession" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <input type="hidden" value="<?= $fullPath ?>" name="fullpath">
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">List All Instructors
                            <a class="btn btn-info float-end" href="./add.php">Add New</a>
                        </h5>
                        <table class="table datatable text-center">
                            <thead>
                                <tr>
                                    <th>
                                        #NO
                                    </th>
                                    <th>ins_id</th>
                                    <th>track</th>
                                    <th>name</th>
                                    <th>dep_name</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Deleta</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allInstructors as $item): ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $item['ins_id'] ?></td>
                                        <td><?= $item['track'] ?></td>
                 <td><?= $item['name'] ?></td>
                 <td><?= $item['dep_name'] ?></td>
                 <td><a class="btn btn-info" href=<?= url("app/admins/view.php?view=<?=") . $item['admin_id'] ?> >View</a></td>
                 <td><a class="btn btn-warning" href=<?= url("app/admins/view.php?Edit=<?=") . $item['admin_id'] ?> >Edit</a></td>
                 <td><a class="btn btn-danger" href=<?= url("app/admins/index.php?Delete=<?=") . $item['admin_id'] ?> ></a>Deleta</td>
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