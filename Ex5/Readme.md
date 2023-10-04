# Отправка письма с использованием PHPMailer

Пример кода для отправки письма на указанный email с использованием библиотеки PHPMailer.

## Установка

Для дальнейшей работы необходимо установить все зависимости PHPMailer. Откройте терминал, перейдите в дирректорию с данной программой и пропишите следующую команду:

```
composer install
```

## Конфигурация

В файле `process_form.php` укажите следующие параметры для настройки отправки письма:

- `$mail->Host`: SMTP-сервер, через который будет отправляться письмо. Например, `'smtp.gmail.com'`.
- `$mail->Username`: Ваше имя пользователя SMTP. Например, `'example@gmail.com'`.
- `$mail->Password`: Пароль для доступа к SMTP-серверу.
- `$mail->Port`: Порт, используемый для соединения с SMTP-сервером. Например, `587`.

## Использование

```php
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
```

