<?php
use Symfony\Component\Dotenv\Dotenv;
require 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');


$data = json_decode(file_get_contents('php://input'), TRUE);
file_put_contents('file.txt', '$data: ' . print_r($data, 1) . "\n", FILE_APPEND);

$token = getenv('TG_TOKEN');
$data = file_get_contents('php://input');

$arrDataAnswer = json_decode($data, true);
$textMessage = mb_strtolower($arrDataAnswer["message"]["text"]);
$chatId = $arrDataAnswer["message"]["chat"]["id"];

if ($textMessage == '/start') {
    $arrayQuery = array(
        'chat_id' => $chatId,
        'photo' => 'AgACAgIAAxkDAANmZDxCOLgDknhNWvZB-myjaVlM98wAAszGMRu2jdhJRg_Y-l_VOS0BAAMCAANzAAMvBA',
        'parse_mode' => "html",
        'caption' => 'Бонусы до 100% от депозита
    http://vivi.bet',
    );
    $ch = curl_init('https://api.telegram.org/bot' . $token . '/sendPhoto');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayQuery);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    echo $res;
}

