<?php

if (isset($_POST['signup'])) {

    $warning = "";

    require_once '../vendor/autoload.php';
    require_once '../config/config.php';

    // Transport for all test (in config.php, define MAIL and PWD with your school gmail address and pwd,
    // in gmail, enable the 'Less secure app access' in the 'security' section from your gmail account
    // (turn it back of after the test))
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
        ->setUsername(MAIL)
        ->setPassword(PWD);

    // TEST 1 = Sign up without HTML
    $mailer1 = new Swift_Mailer($transport); // Create the Mailer for TEST 1
    $message1 = (new Swift_Message('Inscription to Gabbler')) // Create the message for TEST 1
        ->setFrom([MAIL => 'GABBLER'])
        ->setTo([$_POST['email'] => $_POST['nickname']])
        ->setBody('Welcome to Gabbler '.$_POST['nickname']);
    // Send the message for TEST 1
    if ($mailer1->send($message1)){
        $warning .= 'TEST 1 = The mail has been send<br>';
    } else {
        $warning .= 'TEST 1 = The mail has NOT been send<br>';
    }

    // TEST 2 = Sign up with HTML and a picture
    $mailer2 = new Swift_Mailer($transport); // Create the Mailer for TEST 2
    $message2 = (new Swift_Message('Inscription to Gabbler')) // Create the message for TEST 2
        ->setFrom([MAIL => 'GABBLER'])
        ->setTo([$_POST['email'] => $_POST['nickname']]);
    $image = $message2->embed(Swift_Image::fromPath('../data/charte/Logos/Ico - G/Ico Rouge - WhiteMode.png'));
    $message2->setBody(
            '<html>' .
            ' <body style="background-color: beige; text-align: center;">' .
            '  Here is an image <img src="' .
            $image .
            '" alt="Image" />' .
            '  Rest of message' .
            ' </body>' .
            '</html>',
            'text/html'
        );
    // Send the message for TEST 2
    if ($mailer2->send($message2)){
        $warning .= 'TEST 2 = The mail has been send<br>';
    } else {
        $warning .= 'TEST 2 = The mail has NOT been send<br>';
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test SwiftMailer</title>
</head>
<body>
<form method="post">
    <?php
    if (isset($warning)) {
    echo "<span>" . $warning . "</span><br>";
    }
    ?>
    <input type="text" placeholder="Nickname" name="nickname" maxlength="30" required/><br><br>
    <input type="email" placeholder="Email" name="email"  required/><br><br>
    <input type="password" placeholder="Password" name="pwd" maxlength="30" required/><br><br>
    <button type="submit" name="signup">Sign Up</button>
</form><br><br>
<?php
echo isset($message1) ? "The content of the message from TEST 1 : ".$message1->toString()."<br><br>" : "";
echo isset($message2) ? "The content of the message from TEST 2 : ".$message2->toString()."<br><br>" : "";
echo isset($message3) ? "The content of the message from TEST 3 : ".$message3->toString()."<br><br>" : "";
?>
</body>
</html>
