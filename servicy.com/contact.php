<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once "./partials/page.php";
    $firstValue = rand(1, 50);
    $secondValue = rand(1, 50);
    $_SESSION['captcha_answer'] = intval($firstValue + $secondValue);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo renderHeadBlock('Contact'); ?>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Service Easy
                </a>
                <?php echo renderMenu('contact'); ?>
            </div>
        </nav>
        <!-- Masthead-->
        <?php 
            echo renderSectionHeader(
                'Welcome To Our Company!',
                'Tell us about your requirement'
            );
        ?>
        
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form action="<?=getFullUrl('admin/contact_forms/actions.php')?>" method="POST" id="contactForm">
                    <input type="hidden" name="from" value="store" />
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group first-name">
                                <input class="form-control" name="firstname" id="firstname" type="text" value="" placeholder="Your First Name" />
                            </div>
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" name="fullname" id="name" type="text" placeholder="Your Name *" required />
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" name="email" id="email" type="email" placeholder="Your Email *"  />
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" name="phone" id="phone" type="tel" placeholder="Your Phone *" required />
                            </div>
                            <div class="form-group mb-md-0">
                                <div class="row mt-4 captcha">
                                    <div class="col-6 d-flex justify-content-center">
                                        <div class="text">
                                            <label>
                                                <?=$firstValue?> + <?=$secondValue?> = 
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <input class="form-control" name="answer" id="answer" type="text" placeholder="Your answer *" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" name="message" id="message" placeholder="Your Message *" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                    </div>
                </form>
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
