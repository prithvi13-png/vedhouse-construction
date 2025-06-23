<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["feedbackName"])) {

    $name = filter_var(trim($_POST['feedbackName']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $senderEmail = filter_var(trim($_POST['feedbackEmail']), FILTER_SANITIZE_EMAIL);
    $senderTel = filter_var(trim($_POST['feedbackTel']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $messageText = filter_var(trim($_POST['feedbackMessage']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="failed">Invalid email address.</div>';
        exit;
    }

    $to = "vedhouseconstructions@gmail.com";
    $subject = "Contact Us - vedhouseconstructions.com";

    $message = "
    <html>
    <body>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$senderEmail}</p>
        <p><strong>Phone:</strong> {$senderTel}</p>
        <p><strong>Message:</strong><br>{$messageText}</p>
    </body>
    </html>
    ";

    $headers = "From: noreply@vedhouseconstructions.com\r\n";
    $headers .= "Reply-To: {$senderEmail}\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo '<div class="success">Success: Your message has been sent!</div>';
    } else {
        echo '<div class="failed">Failed: Email could not be sent.</div>';
    }

} else {
    echo '<div class="failed">Invalid request.</div>';
}
?>
