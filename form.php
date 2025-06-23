<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["feedbackName"])) {
    $name = htmlspecialchars(trim($_POST['feedbackName']));
    $email = filter_var(trim($_POST['feedbackEmail']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['feedbackTel']));
    $messageText = htmlspecialchars(trim($_POST['feedbackMessage']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="failed">Invalid email address.</div>';
        exit;
    }

    $to = "vedhouseconstructions@gmail.com";
    $subject = "Contact Form Submission";
    $message = "
        <html><body>
        <h3>Contact Form Submission</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Message:</strong><br>{$messageText}</p>
        </body></html>
    ";

    $headers = "From: noreply@vedhouseconstructions.com\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo '<div class="success">Your message has been sent successfully!</div>';
    } else {
        echo '<div class="failed">Failed to send your message. Try again later.</div>';
    }
} else {
    echo '<div class="failed">Invalid request.</div>';
}
?>
