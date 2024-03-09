<?php

$name = htmlspecialchars(trim($_POST['name']));
$phone_number = htmlspecialchars(trim($_POST['phone_number']));
$email = htmlspecialchars(trim($_POST['email']));
$reach_out_to_us = htmlspecialchars(trim($_POST['message']));

if (!empty($email) && !empty($reach_out_to_us)) {
    $receiver = 'havecodesoft@gmail.com';
    $subject = "From: $name <$email>";
    $body = "Email: $email\n\tPhone number: $phone_number\n\n\tMessage: $reach_out_to_us\n";
    $sender = "From: $email";

    if (mail($receiver, $subject, $body, $sender)) {
        echo 'Your message has been sent!';
    } else {
        echo "Failed to send your message! Please try again";
    }
}
