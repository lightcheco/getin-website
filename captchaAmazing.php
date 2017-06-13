<?php
//Checking For reCAPTCHA
$captcha;
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
// Checking For correct reCAPTCHA
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ldm2yMUAAAAAP2V3v5ewqwejLkr3p2fxD5YFLUH&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
if (!$captcha || $response.success == false) {
    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Tu captcha fue incorrecto.</div>';
    exit ;
} else {
    // Checking For Blank Fields..
    if ($_POST["name"] == "" || $_POST["email"] == "" || $_POST["message"] == "") {
        echo "Llena todos los campos..";
    } else {
        // Check if the "Sender's Email" input field is filled out
        $email = $_POST['email'];
        // Sanitize E-mail Address
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        // Validate E-mail Address
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo "Invalid Sender's Email";
        } else {
            $to = 'contacto@getin.mx';
            $subject = 'New Contact from Amazing';
            $message = 'Nombre: ' . $_POST['name'] . "\n";
            $message .= 'Email: ' . $_POST['email']."\n";
            $message .= 'Mensaje: ' . $_POST['message']."\n";
            $headers = 'From:' . $email . "\r\n";
            // Sender's Email
            // Message lines should not exceed 70 characters (PHP rule), so wrap it
            $message = wordwrap($message, 70, "\r\n");
            // Send Mail By PHP Mail Function
            if (mail($to, $subject, $message, $headers)) {
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>¡Mensaje Enviado!</strong> Nos pondremos en contacto.</div>';
            } else {
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Algo salió mal.</strong> Escríbenos a contacto@getin.mx y nos pondremos en contacto.</div>';
                exit ;
            }
        }
    }
}
?>
