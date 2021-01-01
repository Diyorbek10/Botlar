<?php

/*Mualliflik huquqi mavjud.
Dasturchi: @BekDev
Kanalimiz: @ESoftUz
*/

date_default_timezone_set('Asia/Tashkent');

if (!file_exists('madeline.php')){
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}

include 'madeline.php';

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->start();

$time = date("H:i");
$sana = date("d.m.Y");

$obhavo = json_decode(file_get_contents("https://bekdev.tk/api/web-scraper/obhavo.php?city=samarkand"))->harorat;

$MadelineProto->account->updateProfile(['first_name'=>"Jahongir Rasulov⏰ $time",'about'=>"⌚️ $time | 📆 $sana | ⛅️ Samarqand $obhavo"]);

$MadelineProto->account->updateStatus(['offline' => false ]);

file_put_contents("rasm.jpg",file_get_contents("https://bekdev.tk/api/logo/api.php?text=$time"));

$rasm = $MadelineProto->photos->uploadProfilePhoto(['file' => "rasm.jpg"]);

if($rasm){
$info = $MadelineProto->get_full_info('me');
$inputPhoto = ['_' => 'inputPhoto', 'id' => $info['User']['photo']['photo_id'], 'access_hash' => $info['User']['access_hash'], 'file_reference' => 'bytes'];
$deletePhoto = $MadelineProto->photos->deletePhotos(['id'=>[$inputPhoto]]);
}

unlink("MadelineProto.log");
unlink("session.madeline");