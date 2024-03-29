<?php

require_once __DIR__ . "/../admin/constants.php";
require_once __DIR__ . "/../partials/page.php";
require_once __DIR__ . "/PortfolioType.php";
require_once __DIR__ . "/../admin/services/DatabaseService.php";

class Portfolio {

    public function __construct(
        public $id = 0,
        public $imageUrl = '',
        public $title = '',
        public $portfolioType = null,
        public $shortDesc = '',
        public $desc = ''
    ) {}


    public function getPortfolios($offset = 0) {
        $portfolios = [];
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = '
                SELECT portfolios.id, portfolios.imageUrl, portfolios.title, portfolio_types.id AS portfolioTypeId, portfolio_types.title AS portfolioTypeTitle, portfolios.shortDesc, portfolios.desc 
                FROM portfolios INNER JOIN portfolio_types ON portfolios.portfolio_type_id = portfolio_types.id 
        ';

        $limit = PORTFOLIO_PAGINATION_LIMIT;
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        $result = $db->executeQuery($sql);
        foreach ($result as $row) {
            $portfolios[] = new Portfolio(
                $row['id'],
                $row['imageUrl'],
                $row['title'],
                new PortfolioType($row['portfolioTypeTitle'], $row['portfolioTypeId']),
                $row['shortDesc'],
                $row['desc']
            );
        }
        $db->closeConnection();
        return $portfolios;
    }

    public function renderPortfolios($offset = 0) {
        $htmlContent = '<div class="row">';
        foreach ($this->getPortfolios($offset) as $portfolio) {
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
                            <div class="portfolio-caption-subheading text-muted">' . $portfolio->portfolioTypeId . '</div>
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
        $sql = '
                SELECT portfolios.id, portfolios.imageUrl, portfolios.title, portfolio_types.id AS portfolioTypeId, portfolio_types.title AS portfolioTypeTitle, portfolios.shortDesc, portfolios.desc 
                FROM portfolios INNER JOIN portfolio_types ON portfolios.portfolio_type_id = portfolio_types.id
                WHERE portfolios.id = ' . $id . ' LIMIT 1;
        ';
        $row = $db->executeOneQuery($sql);
        
        if (is_array($row) && count($row)) {
            $portfolio = new Portfolio(
                $row[0],
                $row[1],
                $row[2],
                new PortfolioType($row[4], $row[3]),
                $row[5],
                $row[6]
            );
        }
        $db->closeConnection();

        return $portfolio;
    }

    public function save() {
        $sql = 'INSERT INTO portfolios(`imageUrl`, `title`, `portfolio_type_id`, `shortDesc`, `desc`) VALUES("' . $this->imageUrl . '", "' . $this->title . '", "' . $this->portfolioTypeId . '", "' . $this->shortDesc . '", "' . $this->desc . '");';
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }

    public function update() {
        $sql = 'UPDATE portfolios SET `imageUrl`="' . $this->imageUrl . '", `title`="' . $this->title . '", `portfolio_type_id`=' . $this->portfolioType->id . ', `shortDesc`="' . $this->shortDesc . '", `desc`="' . $this->desc . '" WHERE id=' . $this->id;
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

    public static function getPagination($offset) {
        // $pagination = [
        //     'numPage' => 4,
        //     'currentPage' => 1,
        //     'linkPages' => [
        //         [ 'link' => getFullUrl('/portfolio.php?limit=' . $limit . '&offset=0') ],
        //         [ 'link' => getFullUrl('/portfolio.php?limit=' . $limit . '&offset=3') ],
        //         [ 'link' => getFullUrl('/portfolio.php?limit=' . $limit . '&offset=6') ],
        //         [ 'link' => getFullUrl('/portfolio.php?limit=' . $limit . '&offset=9') ]
        //     ]
        // ];
        $limit = PORTFOLIO_PAGINATION_LIMIT;
        $pagination = [
            'numPage' => 0,
            'currentPage' => 1,
            'linkPages' => []
        ];

        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'SELECT COUNT(*) FROM portfolios;';
        $row = $db->executeOneQuery($sql);
        $count = 0;
        if (is_array($row) && count($row)) {
            $count = intval($row[0]);
        }

        $pagination['numPage'] = intval($count / $limit);
        if ($count % $limit != 0) {
            $pagination['numPage']++;
        }

        for ($i = 0; $i < $pagination['numPage']; $i++) {
            /**
             * $offset = $i * $limit
             * 0 => 0 * 3,
             * 3 => 1 * 3,
             * 6 = 2 * 3,
             * 9 => 3 * 3
             */
            $calOffset = $i * $limit;
            $pagination['linkPages'][$i] = [
                'link' => getFullUrl('/portfolio.php?offset=' . $calOffset . '#portfolio')
            ];
        }

        $pagination['currentPage'] = intval($offset / $limit) + 1;

        return $pagination;
    }

}

?>