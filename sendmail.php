<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

    //Server settings
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'PHPmailer/language/');
    $mail->IsHTML(true);



    //Recipients
    $mail->setFrom('MRFlordo@yandex.ru', 'Ресторан"Табэмоно"');
    $mail->addAddress('MRFBS@yandex.ru');   
    $mail->Subject = 'Бронирование стола';

$body = '<h1>Бронирование</h1>';

if(trim(!empty($_POST['name']))) {
    $body.='<p><strong>Имя:</strong>'.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['surname']))) {
    $body.='<p><strong>Фамилия:</strong>'.$_POST['surname'].'</p>';
}
if(trim(!empty($_POST['date']))) {
    $body.='<p><strong>Дата:</strong>'.$_POST['date'].'</p>';
}
if(trim(!empty($_POST['select_time']))) {
    $body.='<p><strong>Время:</strong>'.$_POST['select_time'].'</p>';
}
if(trim(!empty($_POST['select_person']))) {
    $body.='<p><strong>Кол-во персон:</strong>'.$_POST['select_person'].'</p>';
}
if(trim(!empty($_POST['textarea']))) {
    $body.='<p><strong>Пожелания:</strong>'.$_POST['textarea'].'</p>';
}
if(trim(!empty($_POST['check_kids']))) {
    $body.='<p><strong>Дети:</strong>'.$_POST['check_kids'].'</p>';
}

$mail->Body = $body;

if (!$mail->send()){
    $message = 'Ошибка';
}else{
    $message = 'стол забронирован!';
}

$response = ['message' => $message];
    header('Content-type: application/json');
    echo json_encode($response);

?>