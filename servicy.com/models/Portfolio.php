<?php

//require_once "./../partials/page.php";

class Portfolio {

    public function __construct(
        public $id = 0,
        public $imageUrl,
        public $title,
        public $portfolioType,
        public $shortDesc = '',
        public $desc = ''
    ) {}


    public function getPortfolios() {
        $portfolios = [
            new Portfolio(
                1,
                'assets/img/portfolio/1.jpg',
                'Threads',
                'Illustration',
                'Lorem ipsum dolor sit amet consectetur.',
                'Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!'
            ),
            new Portfolio(
                2,
                'assets/img/portfolio/2.jpg',
                'Explore',
                'Graphic Design',
                'Lorem ipsum dolor sit amet consectetur.',
                'Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!'
            ),
            new Portfolio(
                3,
                'assets/img/portfolio/3.jpg',
                'Finish',
                'Identity',
                'Lorem ipsum dolor sit amet consectetur.',
                'Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!'
            ),
            new Portfolio(
                4,
                'assets/img/portfolio/4.jpg',
                'Lines',
                'Branding',
                'Lorem ipsum dolor sit amet consectetur.',
                'Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!'
            ),
            new Portfolio(
                5,
                'assets/img/portfolio/5.jpg',
                'Southwest',
                'Website Design',
                'Lorem ipsum dolor sit amet consectetur.',
                'Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!'
            ),
            new Portfolio(
                6,
                'assets/img/portfolio/6.jpg',
                'Window',
                'Photography',
                'Lorem ipsum dolor sit amet consectetur.',
                'Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!'
            )
        ];

        return $portfolios;
    }

    public function renderPortfolios() {
        $htmlContent = '<div class="row">';
        foreach ($this->getPortfolios() as $portfolio) {
            $htmlContent .= '
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/1.jpg" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">Threads</div>
                            <div class="portfolio-caption-subheading text-muted">Illustration</div>
                        </div>
                    </div>

                    ' . renderPortfolioModal() . '
                </div>
            ';
        }
        $htmlContent .= '</div>';

        return $htmlContent;
    }

}

?>