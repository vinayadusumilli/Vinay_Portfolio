<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host       = 'smtp.example.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'your-email@example.com'; // SMTP username
        $mail->Password   = 'your-email-password'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('adusumillivinayas@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject ? $subject : 'New Contact Form Submission';
        $mail->Body    = "<h2>Contact Form Submission</h2>
                          <p><strong>Name:</strong> {$name}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Message:</strong> {$message}</p>";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
