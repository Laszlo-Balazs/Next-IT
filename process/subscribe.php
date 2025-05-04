<?php
require_once __DIR__ . '/../includes/db_connect.php';

require_once __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\SMTPDebug;
require_once __DIR__ . '/../includes/mailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=invalid");
        exit();
    }
    
    try
    {
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
        $stmt->bindParam(':email', $email);
        
        if($stmt->execute())
        {
            // debug
            /*
                echo "Email sent to: " . $email; // Debugging line
                echo "<br>"; // Debugging line

           
                if(sendWelcomeEmail($email))
                {
                    echo "mailsent success!"; // Debugging line
                } 
                else 
                {
                    echo "Failed to send email."; // Debugging line
                }
            */
            // debug end


            // Redirect based on email sending result
            

            if(sendWelcomeEmail($email))
            {
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=success");
            }
            else
            {
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=success&mail=error");
            }
            

        }
        else
        {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=error");
        }
    } catch(PDOException $e) {
        if($e->getCode() == 23000) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=exists");
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=error");
        }
    }
    exit();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
