<?php
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

$subject = $_POST["subject"];
$from = $_POST["from"];
$lineTotal = $_POST["email-body-line-value"];

try {
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
    $mail->isSMTP();
    $mail->Host = 'p3plzcpnl466174.educzesto.org';
    $mail->SMTPAuth = true;
    $mail->SMTPKeepAlive = true;
    $mail->Username = 'mail@educzesto.org';
    $mail->Password = 'Serviciosocial2020';
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
        if($_POST[$varName]) {
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
        // TODO: Crear firma de Educzesto
    } else {
        // Información Parroquia Madre de Dios de Czestochowa
        if (!$mail->AddEmbeddedImage("./assets/AgustinosRecoletos.png", 'AgustinosRecoletos.png', 'AgustinosRecoletos.png')) {
            echo 'Failed to attach signature';
        } else {
            $mail->Body .= '<br><br>Atentamente,<br><br><img alt="Agustinos Recoletos" src="cid:AgustinosRecoletos.png" style="width:150px">';
        }
    }
    $mail->Body .= '</body></html>';

    // TODO: Implementar lectura de registros desde la base de datos para evitar fallas por lectura de archivos
    // NOTE: Todos los datos de correos y nombres actualmente se obtienen de los archivos csv localizados en el directorio /educzesto-mailer/assets
    if(isset($_POST['test'])) {
        $filename = "./assets/EjemplosDeveloper.csv";
    } else {
        // Nombre de archivo cuando no es envío de prueba
        $filename = "./assets/EjemplosTutores.csv";
    }
    
    // Enviar correos a toda la lista del CSV
    if(($handle = fopen($filename, 'r')) !== FALSE) {
        // Leer la primer linea y no hacer nada
        $row = fgetcsv($handle, 100);
        while(($row = fgetcsv($handle, 100)) !== FALSE) {
            $mail->addBCC($row[2], $row[1]);
        }
        fclose($handle);
    }
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
header('Location: http://educzesto.org/login/educzesto-mailer');
?>