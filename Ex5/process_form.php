<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/**
 * Функция для отправки письма на указанный email
 *
 * @param string $to Email получателя
 * @param string $subject Тема письма
 * @param string $message Текст письма
 * @return void
 */
function sendEmail($to, $subject, $message) {
    try {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'example@gmail.com';
        $mail->Password   = 'appPassword';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('example@gmail.com', 'PHP-TEST');
        $mail->addAddress($to);
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $message;
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Проверка наличия POST запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Проверка полей на пустоту
    if (empty($email) || empty($message)) {
        echo 'Пожалуйста, заполните все поля.';
        exit;
    }

    // Валидация поля email с помощью регулярного выражения
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        echo 'Пожалуйста, введите корректный email.';
        exit;
    }

    // Отправка письма
    $to = $email; // Замените на свой email
    $subject = 'FeedBackForm Test';
    $message = $message;

    sendEmail($to, $subject, $message);

} else {
    echo 'Доступ запрещен.';
}
?>