<?php
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";


////////////====[MUTE]====////////////
if(strpos($message, "/key2") === 0 || strpos($message, "!key2") === 0){   
    $time_start = microtime(true);
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
        $messageidtoedit1 = bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"<b>Wait for Result...</b>",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id

        ]);

        $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
        $sk = substr($message, 6);

        // $response = urlencode("<b>sk $sk</b>");
        if(preg_match_all("/sk_(test|live)_[A-Za-z0-9]+/", $sk, $matches)) {
            //   file_put_contents('./tmp/sk.txt', $sk . PHP_EOL, FILE_APPEND);
            $sk = $matches[0][0];
            $skhidden = substr_replace($sk, '',12).preg_replace("/(?!^).(?!$)/", "*", substr($sk, 12));
        

            ###CHECKER PART###  
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5154620061414478&card[exp_month]=01&card[exp_year]=2023&card[cvc]=235");
            curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
            $headers = array();
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            
            $info = curl_getinfo($ch);
            $time = $info['total_time'];
            $time = substr_replace($time, '',4);
            $obj0=json_decode($result,true);
            $code=$obj0['error']['code'];
            
            // sendMessage($chat_id, "$result", $keyboard);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/balance');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
            $headers = array();
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result1 = curl_exec($ch);
            $info = curl_getinfo($ch);
            // $curr=$result1['pending'];
            $obj=json_decode($result1,true);
            $curr=$obj['pending'][0]['currency'];
            $balance=$obj['available'][0]['amount'];
            $pending=$obj['pending'][0]['amount'];
            $instant_available=$obj['instant_available'][0]['amount'];
            // $curr = getStr($result1,'"currency": "','"');
            // $balance = trim(strip_tags(getStr($result1,'{"object": "balance","available": [{"amount":',',')));
            // $pending = trim(strip_tags(getStr($result1,'"livemode": true,"pending": [{"amount":',',')));
            // sendMessage($chat_id, "$pending", $keyboard);
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start);
            if (strpos($result, 'api_key_expired')){
                $response = urlencode("<b>BOTJOSEHN - Status - PUBLIC
━━━━━━━━━━━━━
[ϟ] GATE: SK KEY CHK ⚡️
[ϟ] SK KEY: <code>$sk</code>
[ϟ] STATUS: DEAD KEY
[ϟ] RESPUESTA: <code>$code</code>
━━━━━━━━━━━━━━━
[ϟ] TIEMPO EMPLEADO: $execution_time's 
❌
[ϟ] Revisado por: @$username
[ϟ] UserID: $userId
[ϟ] Premium Activado: SI</b>");
reply_to2($chat_id,$messageidtoedit,$keyboard,$response);
            }elseif (strpos($result, 'Invalid API Key provided')){
                $response = urlencode("<b>BOTJOSEHN - Status - PUBLIC
━━━━━━━━━━━━━
[ϟ] GATE: SK KEY CHK ⚡️
[ϟ] SK KEY: <code>$sk</code>
[ϟ] STATUS: DEAD KEY
[ϟ] RESPUESTA: <code>$code</code>
━━━━━━━━━━━━━━━
[ϟ] TIEMPO EMPLEADO: $execution_time's 
❌ 
[ϟ] Revisado por: @$username
[ϟ] UserID: $userId
[ϟ] Premium Activado: SI
</b>");
reply_to2($chat_id,$messageidtoedit,$keyboard,$response);
            }
            elseif ((strpos($result, 'You did not provide an API key.')) || (strpos($result, 'You need to provide your API key in the Authorization header,'))){
                $response = urlencode("<b>BOTJOSEHN - Status - PUBLIC
━━━━━━━━━━━━━
[ϟ] GATE: SK KEY CHK ⚡️
[ϟ] SK KEY: <code>$sk</code>
[ϟ] ESTADO: MISSING KEY
[ϟ] RESPUESTA: <code>$code</code>
━━━━━━━━━━━━━━━
[ϟ] TIEMPO EMPLEADO: $execution_time's
❌ 
[ϟ] Revisado por: @$username
[ϟ] UserID: $userId
[ϟ] Premium Activado: SI
</b>");
reply_to2($chat_id,$messageidtoedit,$keyboard,$response);
            }
            elseif ((strpos($result, 'rate_limit')) || (strpos($result, 'rate_limit'))){
                $response = urlencode("<b>BOTJOSEHN - Status - PUBLIC
━━━━━━━━━━━━━
[ϟ] GATE: SK KEY CHK ⚡️
[ϟ] SK KEY: <code>$sk</code>
[ϟ] STATUS: VALID SK KEY✅
[ϟ] RESPONSE: RATE LIMIT ⚠️
[ϟ] CURRENCY: $curr
[ϟ] BALANCE: $balance
[ϟ] PENDIENTE CANTIDAD: $pending
[ϟ] TARJETAS PROCESADAS: $pending
━━━━━━━━━━━━━
[ϟ] TIEMPO EMPLEADO: $execution_time's
[ϟ] Revisado por: @$username
[ϟ] UserID: $userId
[ϟ] Premium Activado: SI
</b>");
reply_to2($chat_id,$messageidtoedit,$keyboard,$response);
            }  
            elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
                $response = urlencode("<b>BOTJOSEHN - Status - PUBLIC
━━━━━━━━━━━━━
[ϟ] GATE: SK KEY CHK ⚡️
[ϟ] SK KEY: <code>$sk</code>
[ϟ] STATUS: DEAD KEY
[ϟ] RESPUESTA: <code>$code</code>
━━━━━━━━━━━━━━━
[ϟ] TIEMPO EMPLEADO: $execution_time's
❌
[ϟ] Revisado por: @$username
[ϟ] UserID: $userId
[ϟ] Premium Activado: SI
</b>");
reply_to2($chat_id,$messageidtoedit,$keyboard,$response);
            }else{
                $response = urlencode("<b>BOTJOSEHN - Estado - PUBLIC
━━━━━━━━━━━━━━
[ϟ] GATE: SK KEY CHK ⚡️
[ϟ] SK KEY: <code>$sk</code>
[ϟ] STATUS: VALID SK KEY
[ϟ] RESPUESTA: Provided SK KEY✅ is Live!✅
[ϟ] CURRENCY: $curr
[ϟ] BALANCE: $balance
[ϟ] PENDIENTE CANTIDAD:  $pending 
[ϟ] TARJETAS PROCESADAS: $pending
━━━━━━━━━━━━━
[ϟ] TIEMPO EMPLEADO: $execution_time's
[ϟ] Revisado por: @$username
[ϟ] UserID: $userId
[ϟ] Premium Activado: SI
</b>");
reply_to2($chat_id,$messageidtoedit,$keyboard,$response);
            }
            }
        }   
    }
?>