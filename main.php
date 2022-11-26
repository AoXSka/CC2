<?php

// error_reporting(0);
// ini_set('display_errors', 0);
include __DIR__."/config/config.php";
include __DIR__."/config/variables.php";
include __DIR__."/functions/bot.php";
include __DIR__."/functions/functions.php";
include __DIR__."/functions/db.php";


date_default_timezone_set($config['timeZone']);


////Modules
include __DIR__."/modules/admin.php";
include __DIR__."/modules/skcheck.php";
include __DIR__."/modules/skckeck2.php";
include __DIR__."/modules/binlookup.php";
include __DIR__."/modules/iban.php";
include __DIR__."/modules/stats.php";
include __DIR__."/modules/me.php";
include __DIR__."/modules/apikey.php";
include __DIR__."/modules/rand.php";
include __DIR__."/modules/ccgen.php";


include __DIR__."/modules/checker/ss.php";
// include __DIR__."/modules/checker/sss.php"; FALLO DE REPETICION
include __DIR__."/modules/checker/schk.php";
include __DIR__."/modules/checker/sm.php";
include __DIR__."/modules/checker/test1.php";
include __DIR__."/modules/checker/py.php";
include __DIR__."/modules/checker/sh.php";
include __DIR__."/modules/checker/su.php";
include __DIR__."/modules/checker/spp.php";
include __DIR__."/modules/checker/sx.php";
include __DIR__."/modules/checker/stripeTest.php";


//////////////===[START]===//////////////

if(strpos($message, "/start") === 0){
if(!isBanned($userId) && !isMuted($userId)){

  if($userId == $config['adminID']){
    $messagesec = "<b>Type /admin to know admin commands</b>";
  }

    addUser($userId);
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Hola @$username,

Escribe /cmds para ver mis comandos!</b>

$messagesec",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard' => [
        [
          ['text' => "💠 Creado Por 💠", 'url' => "t.me/Z_tJKkeZQoZlcssuXjVjNerQ"]
        ],
        [
          ['text' => "👨🏻‍💻 Eljose 💎", 'url' => "https://t.me/Z_tJKkeZQoZlcssuXjVjNerQ"]
        ],
      ], 'resize_keyboard' => true])
        
    ]);
  }
}

//////////////===[CMDS]===//////////////

if(strpos($message, "/cmds") === 0 || strpos($message, "!cmds") === 0){

  if(!isBanned($userId) && !isMuted($userId)){
    
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>¿Qué comandos le gustaría comprobar?</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"💳 CC Checker Gates",'callback_data'=>"checkergates"]],[['text'=>"🛠 Otros Comandos",'callback_data'=>"othercmds"]],[['text'=>"⬅️ Volver a Inicio",'callback_data'=>"startHome"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  }
  if($data == "startHome"){
    if($userId == $config['adminID']){
      $messagesec = "<b>Type /admin to know admin commands</b>";
    }
      bot('sendmessage',[
          'chat_id'=>$callbackchatid,
          'text'=>"<b>◤                      Hola De nuevo                      ◥
  Escribe /cmds para ver mis comandos!</b>
◥                                                                          ◤
  $messagesec",
      'parse_mode'=>'html',
      'reply_to_message_id'=> $callbackmessageid,
      'reply_markup'=>json_encode(['inline_keyboard' => [
          [
            ['text' => "💠 Creado Por 💠", 'url' => "t.me/Z_tJKkeZQoZlcssuXjVjNerQ"]
          ],
          [
            ['text' => "👨🏻‍💻 Eljose 💎", 'url' => "https://t.me/Z_tJKkeZQoZlcssuXjVjNerQ"]
          ],
        ], 'resize_keyboard' => true])
          
      ]);
  }
  if($data == "back"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>¿Qué comandos le gustaría comprobar?</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"💳 CC Checker Gates",'callback_data'=>"checkergates"]],[['text'=>"🛠 Otros Comandos",'callback_data'=>"othercmds"]],[['text'=>"⬅️ Volver a Inicio",'callback_data'=>"startHome"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  if($data == "checkergates"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>━━CC Checker Gates━━</b>
  
<b>/ss   | !ss - Stripe [Auth]⛔</b>
<b>/su   | !su - SQUAREUP $1[Auth]🟢</b>
<b>/sm   | !sm - Stripe [Merchant]⛔</b>
<b>/sx   | !sx - Brazil Auth⛔</b>
<b>/s4   | !s4 - Stripe Auth 4</b>
<b>/sh   | !sh - Shopify🟢</b>
<b>/spp  | !spp - Unknown⛔</b>
<b>/py   | !py - Stripe 3⛔</b>
<b>/sss  | !sss- STRIPE - CHARGE 10INR⛔</b>
<b>/ttt  | !ttt - Stripe (NEED SK)⛔</b>
<b>/schk | !schk - User Stripe Merchant [Needs SK]⛔</b>

<b>/apikey sk_live_xxx - Agrega SK Key para /schk gate</b>
<b>/myapikey | !myapikey - Ver SK Key Añadida para /schk gate</b>

<b>ϟ Sige <a href='https://t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"⬅️Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }
  
  
  if($data == "othercmds"){
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
