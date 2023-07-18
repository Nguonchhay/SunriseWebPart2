<?php

ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1);  
error_reporting (E_ALL); 

require_once __DIR__ . '/../constants.php';
require_once __DIR__ . '/../../models/Portfolio.php';


function uploadImage($file) {
    $imagePath = '';
    $storeImagePath = PORTFOLIO_UPLOAD_DIR . '/' . time() . '_' . basename($file["name"]);
    $targetFile = __DIR__ . '/../../' . $storeImagePath;

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        $imagePath = $storeImagePath;
    }
    
    return $imagePath;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['from'];

    $createUrl = getFullUrl('admin/portfolios/create.php');
    switch ($from) {
        case 'delete':
            $id = intval($_POST['id']);
            $result = Portfolio::deleteById($id);
            break;
        case 'store':
            $title = $_POST['title'];
            $portfolioType = $_POST['portfolioType'];
            $shortDesc = $_POST['shortDesc'];
            $desc = $_POST['desc'];
            $image = $_FILES['image'];

            if (empty($title) || empty($portfolioType) || empty($image)) {
                header("Location: " . $createUrl);
                exit();
            }

            $imagePath = uploadImage($image);
            if ($imagePath === '') {
                header("Location: " . $createUrl);
                exit();
            }

            $portfolio = new Portfolio(
                0,
                $imagePath,
                $title,
                $portfolioType,
                $shortDesc,
                $desc
            );
            $portfolio->save();

            break;
        case 'update':
            break;
    }
}

$url = getFullUrl('admin/portfolios/index.php');
header("Location: " . $url);
exit();

?>