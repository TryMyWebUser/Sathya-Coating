<?php
    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user')) {
        header("Location: index.php");
        exit;
    }

    $conn = Database::getConnect();
    $contact = Operations::getContact($conn);
    $social = Operations::getSocial($conn);
?>

<!DOCTYPE html>
<html lang="en" class="minimal-theme">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <?php include "temp/head.php" ?>

    </head>

    <body>
        <!--start wrapper-->
        <div class="wrapper">
            
            <?php include "temp/header.php" ?>

            <?php include "temp/sideheader.php" ?>

            <!--start content-->
            <main class="page-content">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Contact Details</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Map</th>
                                        <th>Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($contact)){
                                            foreach ($contact as $row) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <?= $row['map'] ?>
                                            </div>
                                        </td>
                                        <td><?= $row['number'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td>
                                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                <a href="editContact.php?edit_id=<?= $row['id'] ?>" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="deleteContact.php?delete_id=<?= $row['id'] ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        } else { echo "<tr><td>Row Not Found</td></tr>"; }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Social Media Details</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Facebook</th>
                                        <th>Instagram</th>
                                        <th>WhatsApp</th>
                                        <th>YouTube</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($social)){
                                            foreach ($social as $row) {
                                    ?>
                                    <tr>
                                        <td><a href="<?= $row['facebook'] ?>">Facebook</a></td>
                                        <td><a href="<?= $row['instagram'] ?>">Instagram</a></td>
                                        <td><a href="https://wa.me/<?= $row['whatsapp'] ?>">WhatsApp</a></td>
                                        <td><a href="<?= $row['youtube'] ?>">YouTube</a></td>
                                        <td>
                                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                <a href="editSocial.php?edit_id=<?= $row['id'] ?>" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="deleteSocial.php?delete_id=<?= $row['id'] ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        } else { echo "<tr><td>Row Not Found</td></tr>"; }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <!--end page main-->

            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
            <!--End Back To Top Button-->
        </div>
        <!--end wrapper-->

        <?php include "temp/header.php" ?>

    </body>

</html>