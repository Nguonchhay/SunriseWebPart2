<?php

ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1);  
error_reporting (E_ALL); 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../constants.php';
require_once __DIR__ . '/../../models/ContactForm.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['from'];

    switch ($from) {
        case 'store':
            $requestedUrl = getFullUrl('contact.php');
            
            /**
             * Apply spam protection
             * 1. Honeypot
             * 2. Captcha
             * 3. Recaptcha
             * 4. Invisible reCAPTCHA
             */

            // Apply honeypot technique
            // $firstname = $_POST['firstname'];
            // if (!empty($firstname)) {
            //     header("Location: " . $requestedUrl);
            //     exit();
            // }

            // Apply Captcha technique
            $answer = intval($_POST['answer']);
            if ($answer != $_SESSION['captcha_answer']) {
                header("Location: " . $requestedUrl);
                exit();
            }
            

            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];

            if (empty($fullname) || empty($email) || empty($phone) || empty($message)) {
                header("Location: " . $requestedUrl);
                exit();
            }

            $contactForm = new ContactForm($fullname, $email, $phone, $message);
            $contactForm->save();

            break;
    }
}

$url = getFullUrl('thank-you.php');
header("Location: " . $url);
exit();

?>