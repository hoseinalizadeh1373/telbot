<?php

$botToken = "8175051120:AAGAGRlf_D0MOIlGpB8KLOKjuOvaebonP5w";
$telegramAddress = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents("php://input");
$updateArray = json_decode($update,true);

$chatId = $updateArray['message']['chat']['id'];
$message = $updateArray['message']['text'];

$url_mini = "https://bot-test.ir/test_mini.html";

$keyboard = [
    "inline_keyboard" => [
        [["text" => "🖥 باز کردن مینی‌اپ", "web_app" => ["url" =>$url_mini]]]
    ]
];

if($message =="/start"){
    sendMessage($chatId,"چی مخی؟");
}
if($message =="mini"){
    
    sendMessageWithKeyboard($chatId,"بگیر",$keyboard);
}



function sendMessage($chatId,$message){
    global $telegramAddress;

    $url = $telegramAddress."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
    file_get_contents($url);
}

function sendMessageWithKeyboard($chatId,$message,$keyboard){
    global $telegramAddress;
    
    $url = $telegramAddress."/sendMessage?chat_id=".$chatId."&text=".urlencode($message)."&reply_markup=".json_encode($keyboard);
    file_get_contents($url);
}