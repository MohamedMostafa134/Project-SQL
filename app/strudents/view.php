<?php
include_once '../../shared/allhead.php';
if ($_GET['view']) {
    $id = $_GET['view'];
    $students = "SELECT * FROM `student_data` WHERE id = $id ";
    $allstudents = mysqli_query($conn, $students);
    $student = mysqli_fetch_assoc($allstudents);
}
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Instructor Data</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card-body">
                    <h5 class="card-title">Instructor Details
                        <a class="btn float-end" href="./index.php">Back</a>
                    </h5>
                </div>
                <div class="card">
                    <?php if ($student['image'] !== null): ?>
                        <img src="<?= url('upload/users/') . $student['image'] ?>" alt="">
                    <?php else : ?>
                        <img src="<?= url('assets/img/default.jpg') ?>" alt="">
                    <?php endif; ?>
                    <div class="details row justify-content-start">
                        <h5 class="col-10"><strong>Name :</strong> <?= $student['name'] ?> </h5>
                        <h5 class="col-10"><strong>Email :</strong> <?= $student['email'] ?> </h5>
                        <h5 class="col-10"><strong>Department :</strong> <?= $student['department'] ?> </h5>
                        <h5 class="col-10"><strong>Group :</strong> <?= $student['group_name'] ?> </h5>
                        <h5 class="col-10"><strong>Assigned Instructor :</strong> <?= $student['instructor'] ?> </h5>
                        <h5 class="col-10"><strong>Start Date :</strong> <?= $student['start_date'] ?> </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
include_once '../../shared/allscript.php'
?>