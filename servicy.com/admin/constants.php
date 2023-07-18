<?php

define("BASE_URL", "http://local-servicy.com");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("PORTFOLIO_UPLOAD_DIR", "uploads/portfolios");

function getFullUrl($uri) {
    return BASE_URL . '/' . $uri;
}

?>