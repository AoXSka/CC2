<?php

/*

///==[Me Commands]==///

/me - Returns your info

*/


include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

$date1 = date("Y-m-d");
$time = date("h:i:sa");

////////////====[MUTE]====////////////
if(strpos($message, "/me") === 0 || strpos($message, "!me") === 0){   
    $antispam = antispamCheck($userId);
    addUser($userId);
    
    if($antispam != False){
      bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
      ]);
      return;

    }else{
        $messageidtoedit1 =   bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"≡ <b>User Info</b>
- <ins>User ID:</ins> <code>$userId</code>
- <ins>Full Name:</ins> ".htmlspecialchars($firstname.$lastname)."
- <ins>User Name:</ins> @$username
- <ins>User Type:</ins> <b>Free User</b>
━━━━━━━━━━━━━=
<b>$date1 $time</b>",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id,
          'reply_markup'=>json_encode(['inline_keyboard'=>[
          [['text'=>"Checker Stats",'callback_data'=>"checkerstats"]],[['text'=>"⬅️Back",'callback_data'=>"back4"]]
          ],'resize_keyboard'=>true])
          ]);
        }
}

if($data == "checkerstats"){
        $gStats = fetchGlobalStats();
        $uStats = fetchUserStats($callbackuserid);
        bot('editMessageText',[
          'chat_id'=>$callbackchatid,
          'message_id'=>$callbackmessageid,
          'text'=>"≡ <b>User Stats</b>

- <ins>Total Cards Checked:</ins> ".$uStats['total_checked']."
- <ins>Total CVV Cards:</ins> ".$uStats['total_cvv']."
- <ins>Total CCN Cards:</ins> ".$uStats['total_ccn']."
          
≡ <b>Global Checker Stats</b>

- <ins>Total Cards Checked:</ins> ".$gStats['total_checked']."
- <ins>Total CVV Cards:</ins> ".$gStats['total_cvv']."
- <ins>Total CCN Cards:</ins> ".$gStats['total_ccn']."",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id,
          'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"⬅️Back",'callback_data'=>"backme"]],
            ],'resize_keyboard'=>true])]);
}

if($data == "backme"){
  $gStats = fetchGlobalStats();
  $uStats = fetchUserStats($callbackuserid);
  bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"≡ <b>User Info</b>
- <ins>User ID:</ins> <code>$callbackuserid</code>
- <ins>Full Name:</ins> ".htmlspecialchars($callbackfname.$callbacklname)."
- <ins>User Name:</ins> @$callbackusername
- <ins>User Type:</ins> <b>Free User</b>
━━━━━━━━━━━━━=
<b>$date1 $time</b>",
      'parse_mode'=>'html',
      'reply_to_message_id'=> $message_id,
      'reply_markup'=>json_encode(['inline_keyboard'=>[
      [['text'=>"Checker Stats",'callback_data'=>"checkerstats"]],[['text'=>"⬅️Return",'callback_data'=>"back4"]]
      ],'resize_keyboard'=>true])]);

}
if($data == "back4"){
  bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>━━Other Commands━━</b>
  
<b>/me    | !me</b> - Tu Informacion
<b>/stats | !stats</b> - Estatus Checker
<b>/gen   | !gen</b> - Generate Extrap From Bin✅
<b>/rand  | !rand</b> - Random Details gen✅
<b>/key   | !key</b> - SK Key Checker
<b>/bin   | !bin</b> - Bin Lookup
<b>/iban  | !iban</b> - IBAN Checker
  
  <b>ϟ Sige <a href='https://t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"⬅️Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
}


?>