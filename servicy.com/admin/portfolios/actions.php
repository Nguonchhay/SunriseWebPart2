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

    switch ($from) {
        case 'delete':
            $id = intval($_POST['id']);
            $result = Portfolio::deleteById($id);
            break;
        case 'store':
            $createUrl = getFullUrl('admin/portfolios/create.php');
            $title = $_POST['title'];
            $portfolioTypeId = $_POST['portfolio_type_id'];
            $shortDesc = $_POST['shortDesc'];
            $desc = $_POST['desc'];
            $image = $_FILES['image'];

            if (empty($title) || empty($portfolioTypeId) || empty($image)) {
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
                $portfolioTypeId,
                $shortDesc,
                $desc
            );
            $portfolio->save();

            break;
        case 'update':
            $id = intval($_POST['id']);
            $editUrl = getFullUrl('admin/portfolios/edit.php?id=' . $id);
            $title = $_POST['title'];
            $portfolioTypeId = $_POST['portfolio_type_id'];
            $shortDesc = $_POST['shortDesc'];
            $desc = $_POST['desc'];
            $image = $_FILES['image'];

            if (empty($id) || empty($title) || empty($portfolioTypeId) || empty($image)) {
                header("Location: " . $editUrl);
                exit();
            }

            $imagePath = $_POST['existingImage'];
            if (!empty($image['tmp_name']) && $image['size'] > 0) {
                $imagePath = uploadImage($image);
                if ($imagePath === '') {
                    header("Location: " . $createUrl);
                    exit();
                }
            }

            $portfolio = new Portfolio(
                $id,
                $imagePath,
                $title,
                $portfolioTypeId,
                $shortDesc,
                $desc
            );
            $portfolio->update();

            break;
    }
}

$url = getFullUrl('admin/portfolios/index.php');
header("Location: " . $url);
exit();

?>