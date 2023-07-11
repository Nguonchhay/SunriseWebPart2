<?php

ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1);  
error_reporting (E_ALL); 

require_once __DIR__ . '/../../models/Portfolio.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['from'];

    switch ($from) {
        case 'delete':
            $id = intval($_POST['id']);
            $result = Portfolio::deleteById($id);
            break;
        case 'store':
            break;
        case 'update':
            break;
    }
}

header("Location: /admin/portfolios/index.php");
exit();

?>