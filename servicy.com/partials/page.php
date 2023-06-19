<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$menus = [
    [
        'key' => 'home',
        'label' => 'Home',
        'link' => '/sunrise-web2/servicy.com'
    ],
    [
        'key' => 'service',
        'label' => 'Services',
        'link' => 'service.php'
    ],
    [
        'key' => 'portfolio',
        'label' => 'Portfolios',
        'link' => 'portfolio.php'
    ],
    [
        'key' => 'about',
        'label' => 'About',
        'link' => 'about.php'
    ],
    [
        'key' => 'team',
        'label' => 'Team',
        'link' => 'team.php'
    ],
    [
        'key' => 'contact',
        'label' => 'Contact Us',
        'link' => 'contact.php'
    ],
    [
        'key' => 'sign_up',
        'label' => 'Sign Up',
        'link' => 'admin/register.php',
        'hiddenAfterAuth' => true
    ],
    [
        'key' => 'devider',
        'label' => '|',
        'link' => 'javascript:void',
        'hiddenAfterAuth' => true
    ],
    [
        'key' => 'sign_in',
        'label' => 'Sign In',
        'link' => 'admin/login.php',
        'hiddenAfterAuth' => true
    ],
    [
        'key' => 'user_info',
        'label' => 'User',
        'link' => '#',
        'hiddenAfterAuth' => false,
        'children' => [
            [
                'key' => 'profile',
                'label' => 'Profile',
                'link' => '#'
            ],
            [
                'key' => 'logout',
                'label' => 'Logout',
                'link' => 'admin/auth/logout.php'
            ]
        ]
    ]
];

function renderMenuItem($key, $label, $link, $curPage) {
    return '
        <li class="nav-item">
            <a class="nav-link' . ($curPage === $key ? ' active' : '') . '" href="' . $link . '">' . $label . '</a>
        </li>
    ';
}

function renderMenuItemWithCondition($menu, $curPage = '') {
    $menuItems = '';
    if (isset($menu['children'])) {
        $menuChildren = '';
        foreach ($menu['children'] as $child) {
            $menuChildren .= '<li><a class="dropdown-item" href="' . $child['link'] . '">' . $child['label'] . '</a></li>';
        }

        $menuItems .= '
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    ' . $menu['label'] . '
                </a>
            
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    ' . $menuChildren . '
                </ul>
            </li>
        ';
    } else {
        $menuItems .= renderMenuItem($menu['key'], $menu['label'], $menu['link'], $curPage);
    }
    return $menuItems;
}

function renderMenu($curPage = 'home') {
    $menuItems = '';
    foreach($GLOBALS['menus'] as $menu) {
        if (isset($menu['hiddenAfterAuth'])) {
            if (isset($_SESSION['isAuth']) && $_SESSION['isAuth']) {
                if (!$menu['hiddenAfterAuth']) {
                    $menuItems .= renderMenuItemWithCondition($menu, $curPage);
                }
            } else {
                if ($menu['hiddenAfterAuth']) {
                    $menuItems .= renderMenuItemWithCondition($menu, $curPage);
                }
            }
        } else {
            $menuItems .= renderMenuItemWithCondition($menu, $curPage);
        }
    }

    return '
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">' . $menuItems . '</ul>
        </div>
    ';
}

function renderFooter() {
    return '
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website ' . date('Y') . '</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
    ';
}

function renderHeadBlock($pageTitle) {
    return '
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>' . $pageTitle . ' - Service Easy</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/app.css" rel="stylesheet" />
    ';
}

function renderPortfolioModal($id = '', $productName = '', $shortDec = '', $imageUrl = '', $desc = '') {
    return '
        <div class="portfolio-modal modal fade" id="portfolioModal' . $id . '" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">' . $productName .'</h2>
                                    <p class="item-intro text-muted">' . $shortDec . '</p>
                                    <img class="img-fluid d-block mx-auto" src="' . $imageUrl .'" alt="..." />
                                    <p>' . $desc .'</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Threads
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Illustration
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
}

function renderSectionHeader($smallTitle, $bigTitle, $buttonText = '', $buttonLink = '') {
    return '
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">' . $smallTitle . '</div>
                <div class="masthead-heading text-uppercase">' . $bigTitle . '</div>
                ' . (
                    $buttonText !== '' ? '<a class="btn btn-primary btn-xl text-uppercase" href="' . $buttonLink . '">' . $buttonText . '</a>' : ''
                ) . '
            </div>
        </header>
    ';
}

?>