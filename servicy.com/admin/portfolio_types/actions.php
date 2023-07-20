<?php

ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1);  
error_reporting (E_ALL); 

require_once __DIR__ . '/../constants.php';
require_once __DIR__ . '/../../models/PortfolioType.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['from'];

    switch ($from) {
        case 'delete':
            $id = intval($_POST['id']);
            $result = PortfolioType::deleteById($id);
            break;
        case 'store':
            $createUrl = getFullUrl('admin/portfolio_types/create.php');
            $title = $_POST['title'];

            if (empty($title)) {
                header("Location: " . $createUrl);
                exit();
            }

            $portfolioType = new PortfolioType($title);
            $portfolioType->save();

            break;
        case 'update':
            $id = intval($_POST['id']);
            $editUrl = getFullUrl('admin/portfolio_types/edit.php?id=' . $id);
            $title = $_POST['title'];

            if (empty($id) || empty($title)) {
                header("Location: " . $editUrl);
                exit();
            }

            $portfolioType = new PortfolioType(
                $title,
                $id
            );
            $portfolioType->update();

            break;
    }
}

$url = getFullUrl('admin/portfolio_types/index.php');
header("Location: " . $url);
exit();

?>