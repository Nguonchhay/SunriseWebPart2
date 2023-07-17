<?php

require_once __DIR__ . "/../admin/constants.php";
require_once __DIR__ . "/../partials/page.php";
require_once __DIR__ . "/../admin/services/DatabaseService.php";

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
        $portfolios = [];
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'SELECT * FROM portfolios;';
        $result = $db->executeQuery($sql);
        foreach ($result as $row) {
            $portfolios[] = new Portfolio(
                $row['id'],
                $row['imageUrl'],
                $row['title'],
                $row['portfolioType'],
                $row['shortDesc'],
                $row['desc']
            );
        }
        $db->closeConnection();

        return $portfolios;
    }

    public function renderPortfolios() {
        $htmlContent = '<div class="row">';
        foreach ($this->getPortfolios() as $portfolio) {
            $htmlContent .= '
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal' . $portfolio->id . '">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="' . $portfolio->imageUrl . '" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">' . $portfolio->title . '</div>
                            <div class="portfolio-caption-subheading text-muted">' . $portfolio->portfolioType . '</div>
                        </div>
                    </div>

                    ' . renderPortfolioModal($portfolio->id, $portfolio->title, $portfolio->shortDesc, $portfolio->imageUrl, $portfolio->desc) . '
                </div>
            ';
        }
        $htmlContent .= '</div>';

        return $htmlContent;
    }

    public function getFullImagePath() {
        return BASE_URL . '/' . $this->imageUrl;
    }

    public static function findById($id) {
        $portfolio = null;
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'SELECT * FROM portfolios WHERE id=' . $id . ' LIMIT 1;';
        $row = $db->executeOneQuery($sql);
        
        if (is_array($row) && count($row)) {
            $portfolio = new Portfolio(
                $row[0],
                $row[1],
                $row[2],
                $row[3],
                $row[4],
                $row[5]
            );
        }
        $db->closeConnection();

        return $portfolio;
    }

    public function save() {
        $sql = 'INSERT INTO portfolios(`imageUrl`, `title`, `portfolioType`, `shortDesc`, `desc`) VALUES("' . $this->imageUrl . '", "' . $this->title . '", "' . $this->portfolioType . '", "' . $this->shortDesc . '", "' . $this->desc . '");';
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }

    public static function deleteById($id) {
        $result = 0;
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'DELETE FROM portfolios WHERE id=' . $id;
        $result = $db->executeUpdate($sql);
        $db->closeConnection();

        return $result;
    }

}

?>