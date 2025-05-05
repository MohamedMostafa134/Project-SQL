<?php
include_once '../../shared/allhead.php';
 
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
                                <button type="submit" name="closeSession" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <th>
                                        #NO
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Group</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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