<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please fill out all required fields and provide a valid email address.";
    exit;
}

// Sanitize input data using PHP's filter_var function
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Set up the recipient email address (replace with your own email)
$to = 'your-email@example.com'; // Replace with your email address

// Set up the email subject
$email_subject = "New Contact Form Submission: $subject";

// Compose the email message
$email_body = "You have received a new message from your website contact form.\n\n";
$email_body .= "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n";
$email_body .= "Message:\n$message\n";

// Set up headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Send the email using PHP's mail() function
if(mail($to, $email_subject, $email_body, $headers)) {
    // Email successfully sent
    http_response_code(200);
    echo "Your message has been sent. Thank you!";
} else {
    // Error sending email
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
}
?>
