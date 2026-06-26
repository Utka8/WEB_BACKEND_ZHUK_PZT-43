<?php
// Используем ручное подключение (если вы скачали PHPMailer в libs/PHPMailer/)
require '../libs/Exception.php';
require '../libs/PHPMailer.php';
require '../libs/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true); // Включаем исключения
    
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP сервер Gmail
        $mail->SMTPAuth   = true;                 
        $mail->Username   = 'nzuk7261@gmail.com'; // Ваш email
        $mail->Password   = 'lkrjhsnmwtnskkiz'; // ТОТ САМЫЙ 16-значный пароль
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;  // Порт для TLS

        $mail->setFrom('nzuk7261@gmail.com', 'Обратная связь');
        $mail->addAddress('nzuk7261@gmail.com');  // Куда слать письмо

        $mail->isHTML(false);
        $mail->Subject = 'Новое сообщение с сайта';
        $mail->Body    = "Имя: " . $_POST['name'] . "\nСообщение: " . $_POST['message'];

        $mail->send();
        $status = "Сообщение успешно отправлено на ваш Email!";
    } catch (Exception $e) {
        $status = "Ошибка отправки: " . $mail->ErrorInfo;
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обратная связь</title>
</head>
<body>
    <h1>Обратная связь</h1>
    <p><?php echo $status; ?></p>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Ваше имя" required><br><br>
        <textarea name="message" placeholder="Ваш вопрос" required></textarea><br><br>
        <button type="submit">Отправить на Email</button>
    </form>
</body>
</html>