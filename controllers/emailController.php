<?php

require_once 'vendor/autoload.php'; //the autoload file is responsible for automatically including any classes that we are using from the vendor folder
require_once 'config/constants.php';

// Create the Transport, which is an email server responsible for sending and receiving emails
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername(EMAIL) //email found in constants 
  ->setPassword(PASSWORD); //password found in constants 

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token)
{
    global $mailer;

    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Verify Email </title>
    </head>
    <body>
    <div class="wrapper">
        <p>
            Thank you for signing up to our website. Please click on the link below 
            to verify your email.
        </p>
        <a href="http://localhost/userVerification/index.php?token=' . $token . '">
        Verify your email address
        </a>
    </div>
    </body>
    </html>';


// Create a message
$message = (new Swift_Message('Verify Your Account'))
  ->setFrom(EMAIL) //where the email is coming from
  ->setTo($userEmail) //the user who the email is going to
  ->setBody($body, 'text/html'); //the text of the email


// Send the message
$result = $mailer->send($message);
}

function sendPasswordResetLink($userEmail, $token)
{
    global $mailer;

    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Verify Email </title>
    </head>
    <body>
    <div class="wrapper">
        <p>
            Please click on the link below to reset your password
        </p>
        <a href="http://localhost/userVerification/index.php?password-token=' . $token . '">
        Reset your password
        </a>
    </div>
    </body>
    </html>';


// Create a message
$message = (new Swift_Message('Reset your password'))
  ->setFrom(EMAIL)
  ->setTo($userEmail)
  ->setBody($body, 'text/html');


// Send the message
$result = $mailer->send($message);
}

