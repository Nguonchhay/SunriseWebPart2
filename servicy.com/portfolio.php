<?php
    require_once "./partials/page.php";
    require_once "./models/Portfolio.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo renderHeadBlock('Portfolio'); ?>  
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Service Easy
                </a>
                <?php echo renderMenu('portfolio'); ?>
            </div>
        </nav>
        <!-- Masthead-->
        <?php 
            echo renderSectionHeader(
                'Welcome To Our Products',
                'Our Success Launch Products',
                'Read More',
                '#portfolio'
            ); 
        ?>
       
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Portfolio</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <?php
                    $limit = $_GET['limit'] ?? 0;
                    $offset = $_GET['offset'] ?? 0;
                    echo (new Portfolio(0, '', '', '', '', ''))->renderPortfolios($limit, $offset);

                    $pagination = Portfolio::getPagination($limit, $offset);
                    if ($pagination['numPage'] > 0) {
                ?>
                        <div class="d-flex justify-content-center">
                            <div aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <?php
                                        for ($i = 0; $i < $pagination['numPage']; $i++) {
                                            $link = $pagination['linkPages'][$i]['link'];
                                    ?>
                                            <li class="page-item"><a class="page-link" href="<?=$link?>"><?=($i+1)?></a></li>
                                    <?php 
                                        }
                                    ?>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                <?php
                    }
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
