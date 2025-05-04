<?php

require_once __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\SMTPDebug;


function sendWelcomeEmail($to)
{
    $subject = 'Köszönjük a feliratkozást!';
    $message = '
    <html>
    <body>
        <h2>Köszönjük, hogy feliratkoztál hírlevelünkre!</h2>
        <p>Örülünk, hogy csatlakoztál közösségünkhöz. Rendszeresen küldünk majd értesítéseket és hasznos információkat.</p>
        <br>
        <p>Üdvözlettel,<br>NextIT Csapata</p>
    </body>
    </html>';

    $mail = new PHPMailer(true);
    try
    {
        // SMTP configuration
        $mail->isSMTP();
        
        $mail->Host = 'your_smtp_host'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Replace with your email
        $mail->Password = 'your_email_password';     // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // SMTP port (465 for SSL, 587 for TLS)

        // Set UTF-8 character encoding
        $mail->CharSet = 'UTF-8';

        // Enable debug output for troubleshooting authentication issues
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Uncomment for debugging

        // Email settings
        $mail->setFrom('your_email@example.com');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = strip_tags($message);
        
        $mail->send();
        return true; // Email sent successfully
    }
    catch (Exception $e)
    {
        // Get detailed error message
        $errorMessage = $mail->ErrorInfo;
        $errorCode = "";
        
        // More precise error classification
        if (preg_match('/535|534|530|535|503/', $errorMessage)){
            $errorCode = "AUTH_ERROR";
            echo "SMTP Authentication Error: " . $errorMessage;
        } else if (preg_match('/421|connection failed|Could not connect/', $errorMessage)) {
            $errorCode = "CONNECTION_ERROR";
            echo "SMTP Connection Error: " . $errorMessage;
        } else if (preg_match('/550|553|541|Mailbox unavailable|does not exist/', $errorMessage)) {
            $errorCode = "RECIPIENT_ERROR";
            echo "Recipient Error: " . $errorMessage;
        } else if (preg_match('/552|554|exceeded|quota|size/', $errorMessage)) {
            $errorCode = "QUOTA_SIZE_ERROR";
            echo "Quota or Size Error: " . $errorMessage;
        } else if (preg_match('/timeout|timed out/', $errorMessage)) {
            $errorCode = "TIMEOUT_ERROR";
            echo "Connection Timeout: " . $errorMessage;
        } else {
            $errorCode = "SENDING_ERROR";
            echo "General Email Error: " . $errorMessage;
        }
        
        // Echo detailed error information
        echo "<br>Email sending failed to: " . $to . " | Error type: " . $errorCode;
        
        // Log error for admin reference
        error_log(sprintf("Email Error [%s]: Recipient: %s, Error: %s", 
            $errorCode, $to, $errorMessage));
        
        return false;
    }
}

?>
