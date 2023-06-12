<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Expected link in email: http://localhost/sunrise-web2/servicy.com/admin/register-verify.php?hash=sfffkwfsfsfsdfsdfbsd
    /**
     * Steps:
     * 1. Verify url has parameter "hash"
     * 1.1. If no, redirect to homepage
     * 1.2. If yes, store hash value in variable
     * 2. Search user from database with provided hash
     * 2.1. If not found, display error registration
     * 2.2. If found, complete registration and display success registration
     */
    if (!isset($_GET['hash']) || empty($_GET['hash'])) {
        header("Location: ../index.php");
        exit();
    }

    $hash = $_GET['hash'];
    $isSuccess = true;
    $_SESSION['isAuth'] = false;
    $contentTitle = "Congratulation!!!";
    $contentDesc = "Great! you have complete your regiration. Go to home page to start your activity.";

    // Auto login after success registration
    if ($isSuccess) {
        $_SESSION['isAuth'] = true;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Registration Verification</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2"><?=$contentTitle?></h1>
                                        <p class="mb-4"><?=$contentDesc?></p>
                                    </div>
                                    
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="../index.php">Back to website</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>