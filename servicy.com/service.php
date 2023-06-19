<?php
    require_once "./partials/page.php";
    require_once "./models/Service.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo renderHeadBlock('Services'); ?>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Service Easy
                </a>
                <?php echo renderMenu('service'); ?>
            </div>
        </nav>
        <!-- Masthead-->
        <?php 
            echo renderSectionHeader(
                'Welcome To Our Service!',
                'Tell us what you want',
                'Click Here',
                '#services'
            ); 
        ?>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <?php
                    echo Service::renderServices();
                ?>
            </div>
        </section>
        
        <!-- Footer-->
        <?php echo renderFooter(); ?>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
