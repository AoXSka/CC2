<?php
error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

if(strpos($message, '!gen') === 0 or strpos($message, '/gen') === 0 or strpos($message, '.gen') === 0){
    sendaction($chat_id, "typing");
    // $sss = reply_to($chat_id,$message_id,$keyboard,"<b>GENERANDO...</b>");
    $sss = bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>GENERANDO...</b>",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
    ]);
    $message_id_1 = capture(json_encode($sss), '"message_id":', ',');
//    $respon = json_decode($sss, TRUE);
//             $message_id_1 = $respon['result']['message_id'];
	$lista = substr($message, 5);
	// $lista = clean($lista);
    $cc = multiexplode(array(":", "/", " ", "|", ""), $lista)[0];
    $mon = multiexplode(array(":", "/", " ", "|", ""), $lista)[1];
    $year = multiexplode(array(":", "/", " ", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "/", " ", "|", ""), $lista)[3];
    $amou = multiexplode(array(":", "/", " ", "|", ""), $lista)[4];
	$cards = [];
	$cc1 = substr($cc, 0, 1);
	// reply_to($chat_id,$message_id,$keyboard,$cc1);
	$cvvlength = strlen($cvv);
	if(empty($lista)){
	$response = urlencode("<b>INGRESA NUMEROS CORRECTOS🆘
→→→|BIN|MES|AÑO|CVV|CANTIDAD
Ejemplo: 
<code>!gen 407544xxxxxxxxx|xx|2025|xxx|10</code>

→→→El ultimo valor despues de CVV es la cantidad😦</b>");
	//   edit_message($chatId,$message_id_1,$keyboard,$response);
    reply_to2($chat_id,$message_id_1,$keyboard,$response);
    //   bot('editMessageText',[
    //     'chat_id'=>$chat_id,
    //     'message_id'=>$message_id_1,
    //     'text'=>$response,
    //     'parse_mode'=>'html',
    //     'disable_web_page_preview'=>'true'
    // ]);
	exit();
	}
	// if(strlen($cc) >12){
	 // $valid = "";
	  // $response = urlencode("<b>MAXIMUM BIN LENGTH ALLOWED IS 12\n I AM REMOVE LAST 4 DIGIT AND RANDOMISING IT.</b>");
	  // edit_message($chatId,$message_id_1,$keyboard,$response);
	  // $cc = strlen($cc,0,12);
	// }
	// if($mon =='xx' || $mon =='x'){}
	// else{
		if($mon > 12){
		$valid = '';
		$response = urlencode("<b>MES INVALIDO</b>");
			//   edit_message($chatId,$message_id_1,$keyboard,$response);
			reply_to2($chat_id,$message_id_1,$keyboard,$response);
			// bot('editMessageText',[
			//     'chat_id'=>$chat_id,
			//     'message_id'=>$message_id_1,
			//     'text'=>$response,
			//     'parse_mode'=>'html',
			//     'disable_web_page_preview'=>'true'
			// ]);
			exit();
		}
	// }
	if($year > 2029) {
	   $valid = '';
	   $response = urlencode("<b>EL AÑO MAXIMO ES 29</b>");
		//   edit_message($chatId,$message_id_1,$keyboard,$response);
		reply_to2($chat_id,$message_id_1,$keyboard,$response);
		//   bot('editMessageText',[
		//     'chat_id'=>$chat_id,
		//     'message_id'=>$message_id_1,
		//     'text'=>$response,
		//     'parse_mode'=>'html',
		//     'disable_web_page_preview'=>'true'
		// ]);
		exit();
	}
	// sendMessage($chatId,$keyboard,$noregister);
	if(empty($amou)){
	    $amou = '10';
	}

    $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Host: lookup.binlist.net',
            'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '');
            $fim = curl_exec($ch);
            $bank = capture($fim, '"bank":{"name":"', '"');
            $cname = capture($fim, '"name":"', '"');
            $brand = capture($fim, '"brand":"', '"');
            $country = capture($fim, '"country":{"name":"', '"');
            $phone = capture($fim, '"phone":"', '"');
            $scheme = capture($fim, '"scheme":"', '"');
            $type = capture($fim, '"type":"', '"');
            $emoji = capture($fim, '"emoji":"', '"');
            $currency = capture($fim, '"currency":"', '"');
            $binlenth = strlen($bin);
            $schemename = ucfirst("$scheme");
            $typename = ucfirst("$type");
            
            /////////////////////==========[Unavailable if empty]==========////////////////
            
            if (empty($schemename)) {
            	$schemename = "Unavailable";
            }
            if (empty($typename)) {
            	$typename = "Unavailable";
            }
            if (empty($brand)) {
            	$brand = "Unavailable";
            }
            if (empty($bank)) {
            	$bank = "Unavailable";
            }
            if (empty($cname)) {
            	$cname = "Unavailable";
            }
            if (empty($phone)) {
            	$phone = "Unavailable";
            }
            $infoo=$brand." ".$type." ".$country." ".$scheme." ".$bank.":".$emoji;
    $quantity = $amou;
	for($i = 0; $i < $quantity; $i ++){
			$bin = substr($cc, 0, 12);
			
				$digits = 16 - strlen($bin);
				$ccrem = substr(str_shuffle("0123456789"), 0, $digits);
				if($mon == 'xx' or $mon == 'x'){
					$monthdigit = rand(1,12);
				}
				else if (empty($mon)){
					$monthdigit = rand(1,12);
				}
				else{
					$monthdigit = $mon;
				}
			  
				if (strlen($monthdigit) == 1){
					$monthdigit = "0".$monthdigit;
				}

				if($year == 'xxxx' or $year == 'xxx' or $year == 'xx' or $year == 'x'){
					$yeardigit = rand(2021,2029);
				}
				else if (empty($year)){
					$yeardigit = rand(2021,2029);
				}
				else{
					$yeardigit = $year;
				}
				
				if($cvv == 'x' or $cvv == '' or $cvv == 'xx' or $cvv == 'xxx'){
					if($cc1 == 3){
						$cvvdigit = rand(1000,9999);
					}
					else if (empty($cvv)){
						$cvvdigit = rand(100,999);
					}
					else if($cvvlength==3){
						$ranf = rand(0,999);
						if(strlen($ranf)==2){
							$cvvdigit = '0'.$ranf;
						}
						elseif(strlen($ranf)==1){
							$cvvdigit = '00'.$ranf;
						}
						else{
							$cvvdigit = $ranf;
						}
						// $cvvdigit = rand(0,999);
					}
			  	}
			  	else {
					$cvvdigit = $cvv;
			  	}
			$ccgen = $bin.$ccrem;
			
			$cards[]= '<code>'.$ccgen.'|'.$monthdigit.'|'.$yeardigit.'|'.$cvvdigit.'</code>';
			$cards[]= "\n";
		}
		$card = implode ($cards);
		if(empty($mon)){
		$mon = 'xx';
		}
		if(empty($year)){
		$year = 'xxxx';
		}
		if(empty($cvv)){
		$cvv = 'xxx';
		}
// $respo = 	urlencode("<b>••• CC GENERATOR
// •Format Use: $bin|$mon|$year|$cvv
// <code>$card</code>
// ••• Gen By: @Z_tJKkeZQoZlcssuXjVjNerQ
// ••• Bot By: <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code></b>");
		// edit_message($chatId,$message_id_1,$keyboard,$respo);
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id_1,
            'text'=>"<b>🔰 Generador de tarjetas
𝗔𝗺𝗼𝘂𝗻𝘁 ⇾ $amou
• Informacion ($infoo)
•Formato: $bin|$mon|$year|$cvv
━━━━━━━━━━━━━━━━━━━
$card
••• Gen By: @Z_tJKkeZQoZlcssuXjVjNerQ
••• Bot By: <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code>
━━━━━━━━━━━━━━━━━━━</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
'disable_web_page_preview'=>'true'
        ]);
        // reply_to2($chat_id,$message_id_1,$keyboard,$respo);
}

?>