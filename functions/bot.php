<?php

///////////===[Bot Functions]===///////////
function bot($method,$datas=[]){
    global $config;
    $url = "https://api.telegram.org/bot".$config['botToken']."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function sendaction($chatId, $action){
	bot('sendchataction',[
	'chat_id'=>$chatId,
	'action'=>$action
	]);
}
function microtimeFormat($data)
{
    $duration = microtime(true) - $data;
    $hours = (int)($duration/60/60);
    $minutes = (int)($duration/60)-$hours*60;
    $seconds = $duration-$hours*60*60-$minutes*60;
    return number_format((float)$seconds, 2, '.', '');
}

function reply_to2($chatId,$message_id,$keyboard,$message) {
	global $config;
	$url = "https://api.telegram.org/bot".$config['botToken']."/editMessageText?chat_id=".$chatId."&text=".$message."&message_id=".$message_id."&parse_mode=HTML&reply_markup=".$keyboard."";
	return file_get_contents($url);
}
function reply_to($chatId,$message_id,$keyboard,$message) {
	global $config;
	$url = "https://api.telegram.org/bot".$config['botToken']."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML&reply_markup=".$keyboard."";
	return file_get_contents($url);
	// bot('sendMessage',[
	// 	'chat_id'=>$chatId,
	// 	'message_id'=>$message_id,
	// 	'text'=>$message,
	// 	'reply_markup'=>$keyboard]);
}
function sendMessage($chat_id,$text,$keyboard){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'reply_markup'=>$keyboard]);
}

function editMessage($chat_id,$message_id,$text,$reply_markup){
	bot('editMessageText',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
	'text'=>$text,
	'reply_markup'=>$reply_markup]);
}

function forwardMessage($chatid,$from_chat_id,$message_id){
	bot('forwardMessage',[
	'chat_id'=>$chatid,
	'from_chat_id'=>$from_chat_id,
	'message_id'=>$message_id]);
}

function copyMessage($chatid,$from_chat_id,$message_id){
	bot('copyMessage',[
	'chat_id'=>$chatid,
	'from_chat_id'=>$from_chat_id,
	'message_id'=>$message_id]);
}

function sendPhoto($chat_id,$photo,$keyboard){
	bot('sendPhoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'reply_markup'=>$keyboard]);
}
function clean($string) {
	$text = preg_replace("/\r|\n/", " ", $string);
	$str1 = preg_replace('/\s+/', ' ', $text);
	$str = preg_replace("/[^0-9]/", " ", $str1);
	$string = trim($str, " ");
	$lista = preg_replace('/\s+/', ' ', $string);
	 return $lista; 
  }
?>