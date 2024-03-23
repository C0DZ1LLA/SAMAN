<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server address
        $mail->SMTPAuth   = true;
        $mail->Username   = 'saman.abotaleby@gmail.com'; // Your Gmail username
        $mail->Password   = 'astcmyzxysxbjvcc'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // SMTP port (587 for TLS)

         // Content
         $mail->isHTML(true); // Set email format to HTML
         $mail->Subject = 'New message from ' . $name;
         // HTML content with styling
         $mail->Body    = "
             <html>
             <body>
                 <h2>New Message from $name</h2>
                 <p><strong>Name:</strong> $name</p>
                 <p><strong>Email:</strong> $email</p>
                 <p><strong>Message:</strong></p>
                 <p>$message</p>
             </body>
             </html>
         ";
 
        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('saman.abotaleby@gmail.com'); // Your email address

        // Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = 'New message from ' . $name;
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        echo "Your message has been sent successfully!";
    } catch (Exception $e) {
        echo "Failed to send message. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Access denied. This script is only accessible via form submission.";
}
?>
