<?php
include_once '../../shared/allhead.php';

if ($_GET['view']) {
    $id = $_GET['view'];
    $instructors = "SELECT * FROM `instructor_data` WHERE id = $id ";
    $allInstructors = mysqli_query($conn, $instructors);
    $instructor = mysqli_fetch_assoc($allInstructors);
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
                    <?php if ($instructor['image'] !== null): ?>
                        <img src="<?= url('upload/users/') . $instructor['image'] ?>" alt="">
                    <?php else : ?>
                        <img src="<?= url('assets/img/default.jpg') ?>" alt="">
                    <?php endif; ?>
                    <div class="details row justify-content-start">
                        <h5 class="col-10"><strong>Name :</strong> <?= $instructor['name'] ?> </h5>
                        <h5 class="col-10"><strong>Email :</strong> <?= $instructor['email'] ?> </h5>
                        <h5 class="col-10"><strong>Department :</strong> <?= $instructor['department'] ?> </h5>
                        <h5 class="col-10"><strong>Track :</strong> <?= $instructor['track'] ?> </h5>
                        <h5 class="col-10"><strong>Linkedin Profile :</strong> <?= $instructor['linkedin'] ?> </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>


<?php
include_once '../../shared/allscript.php'
?>