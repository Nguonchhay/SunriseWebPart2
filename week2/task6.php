<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task6 | Week 2</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="col-6">
                <form action="contact.php" method="POST" class="mt-5">
                    <h1>Contact Us</h1>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname *</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" value="<?php if (isset($_SESSION['fullname'])) { echo $_SESSION['fullname']; } ?>">
                        <?php
                            if (isset($_SESSION['errorFullName']) && $_SESSION['errorFullName']) {
                                echo '<p class="text-danger">FullName is required!</p>';
                            }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $_SESSION['email']??'' ?>">
                        <?php
                            if (isset($_SESSION['errorEmail']) && $_SESSION['errorEmail']) {
                                echo '<p class="text-danger">Email is required!</p>';
                            }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message *</label>
                        <textarea class="form-control" name="message" id="message"><?=$_SESSION['message']??'' ?></textarea>
                        <?php
                            if (isset($_SESSION['errorMessage']) && $_SESSION['errorMessage']) {
                                echo '<p class="text-danger">Message is required!</p>';
                            }
                        ?>
                    </div>
                 
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>