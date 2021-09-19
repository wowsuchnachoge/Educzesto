<?php
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './dbConf.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// NOTE: Quitar estos comentarios para hacer debug
use PHPMailer\PHPMailer\SMTP;


$mail = new PHPMailer(true);

$subject = $_POST["subject"];
$from = $_POST["from"];
$lineTotal = $_POST["email-body-line-value"];

try {
    // NOTE: Quitar estos comentarios para hacer debug
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
    $mail->isSMTP();
    $mail->Host = 'p3plzcpnl466174.prod.phx3.secureserver.net';
    $mail->SMTPAuth = true;
    $mail->SMTPKeepAlive = true;
    $mail->Username = 'vlm0dijktjmb';
    $mail->Password = 'ServicioSocial2021';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->setFrom('mail@educzesto.org', $from);
    $mail->addAddress('mail@educzesto.org', 'Undisclosed-recipients');

    $mail->isHTML(true);

    $mail->Subject = $subject;

    $mail->Body = '<html><head><title>' . $subject . '</title></head><body>';
    
    for($i = 1; $i <= $lineTotal; $i++) {
        $varName = "email-body-line-" . $i;
        if(isset($_POST[$varName])) {
            $mail->Body .= $_POST[$varName] . '<br><br>';
        } else {
            // Image is here
            $filename = $_FILES[$varName]['name'];
            $ext = PHPMailer::mb_pathinfo($filename, PATHINFO_EXTENSION);
            $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $filename) . '.' . $ext);
            //Attach the uploaded file
            if(move_uploaded_file($_FILES[$varName]['tmp_name'], $uploadfile)) {
                if (!$mail->AddEmbeddedImage($uploadfile, $filename, $filename)) {
                    echo 'Failed to attach file ' . $_FILES[$varName];
                } else {
                    $mail->Body .= '<img alt="' . $filename . '" src="cid:' . $filename . '" style="width:100%"><br><br>';
                }
            }
        }
    }
    // Revisar de que cuenta se está enviando para firma
    if($from == "EduCzesto") {
        // EduCzesto
        if (!$mail->AddEmbeddedImage("./assets/LogoEduczesto.png", 'EduCzesto.png', 'EduCzesto.png')) {
            echo 'Failed to attach EduCzesto signature';
        } else {
            $mail->Body .= '<br><br>Atentamente,<br><br><img alt="EduCzesto" src="cid:EduCzesto.png" style="width:150px">';
        }
    } else {
        // Información Parroquia Madre de Dios de Czestochowa
        if (!$mail->AddEmbeddedImage("./assets/AgustinosRecoletos.png", 'AgustinosRecoletos.png', 'AgustinosRecoletos.png')) {
            echo 'Failed to attach Agustinos Recoletos signature';
        } else {
            $mail->Body .= '<br><br>Atentamente,<br><br><img alt="Agustinos Recoletos" src="cid:AgustinosRecoletos.png" style="width:150px">';
        }
    }
    $mail->Body .= '</body></html>';

    if(isset($_POST['test'])) {
        $table = 'test_mail';
    } else {
        $table = 'mail';
    }
    $conn = mysqli_connect($DB_CONF['server'], $DB_CONF['user'], $DB_CONF['password'], $DB_CONF['database']);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT nombre, email FROM $table";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $mail->addBCC($row["email"], $row["nombre"]);
        }
    }

    $mail->send();
    // NOTE: echo statements for debugging
    echo $table;
    echo "\nmail sent!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
//header('Location: http://educzesto.org/login/educzesto-mailer');
?>